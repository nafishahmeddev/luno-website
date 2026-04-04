# Client Update Portal — Backend Roadmap
### TypeScript · Hono.js · MongoDB · AWS SES · ImageKit

---

## Overview

| | |
|---|---|
| **Runtime** | Node.js 20 LTS |
| **Framework** | Hono.js (TypeScript-first, edge-compatible) |
| **Language** | TypeScript 5.x (strict mode) |
| **Database** | MongoDB Atlas + Mongoose 8.x |
| **Auth** | JWT (access + refresh tokens) + bcryptjs |
| **File Storage** | ImageKit (upload, CDN, transformations) |
| **Real-time** | Hono WebSocket helpers + ws library |
| **Email** | AWS SES (Simple Email Service) via `@aws-sdk/client-ses` |
| **Deployment** | Railway / Fly.io (Node adapter) |
| **Frontend** | Next.js 15 App Router — separate `apps/web` (no coupling) |
| **Shared Contract** | `packages/types` — TypeScript interfaces only, zero runtime dep |
| **Total Phases** | 5 |
| **Total Duration** | ~32 weeks |

---

## Why Hono over Express

| | Express | Hono |
|---|---|---|
| TypeScript | Needs `@types/express` | Native TS, no extra types |
| Validation | Manual / third-party | Built-in `zValidator` with Zod |
| Performance | ~100k req/s | ~500k req/s (faster router) |
| Edge runtime | No | Yes (Cloudflare Workers, Deno, Bun) |
| Bundle size | Heavy | ~15 KB |
| Middleware | `req, res, next` | `c: Context` — cleaner API |

---

## Folder Structure

```
/server
├── src/
│   ├── index.ts                    # Hono app entry, serve + WS adapter
│   ├── app.ts                      # App factory, middleware registration
│   ├── config/
│   │   ├── db.ts                   # Mongoose connect
│   │   ├── imagekit.ts             # ImageKit SDK init
│   │   ├── ses.ts                  # AWS SES client init
│   │   └── websocket.ts            # WS room manager
│   ├── models/
│   │   ├── User.ts
│   │   ├── Project.ts
│   │   ├── Update.ts
│   │   ├── Comment.ts
│   │   ├── File.ts
│   │   └── Notification.ts
│   ├── routes/
│   │   ├── auth.routes.ts
│   │   ├── project.routes.ts
│   │   ├── update.routes.ts
│   │   ├── comment.routes.ts
│   │   ├── upload.routes.ts
│   │   ├── notification.routes.ts
│   │   └── ws.routes.ts            # WebSocket upgrade route
│   ├── controllers/
│   │   ├── authController.ts
│   │   ├── projectController.ts
│   │   ├── updateController.ts
│   │   ├── commentController.ts
│   │   ├── uploadController.ts
│   │   └── notificationController.ts
│   ├── middleware/
│   │   ├── protectRoute.ts         # JWT verify — Hono middleware
│   │   ├── ownerOnly.ts
│   │   ├── rateLimiter.ts          # hono-rate-limiter
│   │   └── checkPlanLimits.ts
│   ├── services/
│   │   ├── emailService.ts         # AWS SES abstraction
│   │   ├── uploadService.ts        # ImageKit upload/delete
│   │   ├── notificationService.ts
│   │   └── cronService.ts          # node-cron jobs
│   ├── validators/
│   │   ├── auth.validators.ts      # Zod schemas for auth routes
│   │   ├── project.validators.ts
│   │   └── update.validators.ts
│   ├── types/
│   │   ├── index.ts                # Shared type exports
│   │   ├── hono.ts                 # Hono env/variable types
│   │   └── models.ts               # Mongoose document interfaces
│   └── utils/
│       ├── generateSlug.ts
│       ├── generateToken.ts
│       └── ApiError.ts
├── .env
├── .env.example
├── tsconfig.json
├── package.json
└── nodemon.json
```

---

## TypeScript Configuration

```jsonc
// tsconfig.json
{
  "compilerOptions": {
    "target": "ES2022",
    "module": "NodeNext",
    "moduleResolution": "NodeNext",
    "lib": ["ES2022"],
    "outDir": "./dist",
    "rootDir": "./src",
    "strict": true,
    "strictNullChecks": true,
    "noUncheckedIndexedAccess": true,
    "exactOptionalPropertyTypes": true,
    "noImplicitReturns": true,
    "esModuleInterop": true,
    "skipLibCheck": true
  },
  "include": ["src/**/*"],
  "exclude": ["node_modules", "dist"]
}
```

---

## Hono App Setup Pattern

```typescript
// src/app.ts
import { Hono } from 'hono'
import { cors } from 'hono/cors'
import { logger } from 'hono/logger'
import { secureHeaders } from 'hono/secure-headers'
import { rateLimiter } from 'hono-rate-limiter'
import type { AppEnv } from './types/hono.ts'

// Hono typed env — variables available via c.get('user')
export type AppEnv = {
  Variables: {
    user: UserDocument
    project: ProjectDocument
  }
}

export function createApp() {
  const app = new Hono<AppEnv>()

  app.use('*', logger())
  app.use('*', secureHeaders())
  app.use('*', cors({
    origin: [
    process.env.CLIENT_URL!,      // Next.js frontend (http://localhost:3000 dev, https://yourdomain.com prod)
  ],
    credentials: true,
    allowMethods: ['GET','POST','PUT','PATCH','DELETE'],
  }))
  app.use('/api/*', rateLimiter({
    windowMs: 15 * 60 * 1000,
    limit: 200,
    keyGenerator: (c) => c.req.header('x-forwarded-for') ?? 'anon',
  }))

  // Mount routes
  app.route('/api/auth', authRoutes)
  app.route('/api/projects', projectRoutes)
  app.route('/api/updates', updateRoutes)
  app.route('/api/comments', commentRoutes)
  app.route('/api/uploads', uploadRoutes)
  app.route('/api/notifications', notificationRoutes)
  app.route('/api/public', publicRoutes)
  app.get('/ws', wsHandler)
  app.get('/health', (c) => c.json({ ok: true }))

  app.onError((err, c) => {
    if (err instanceof ApiError) {
      return c.json({ success: false, message: err.message }, err.statusCode)
    }
    console.error(err)
    return c.json({ success: false, message: 'Internal server error' }, 500)
  })

  return app
}
```

```typescript
// src/index.ts
import { serve } from '@hono/node-server'
import { createNodeWebSocket } from '@hono/node-ws'
import { createApp } from './app.ts'
import { connectDB } from './config/db.ts'

const app = createApp()
const { injectWebSocket, upgradeWebSocket } = createNodeWebSocket({ app })

await connectDB()

const server = serve({ fetch: app.fetch, port: Number(process.env.PORT) || 5000 })
injectWebSocket(server)

console.log(`Server running on port ${process.env.PORT || 5000}`)
```

---

## Phase 1 — Foundation & Auth
**Duration:** Weeks 1–4
**Goal:** Hono server scaffold with full TypeScript, MongoDB connection, JWT auth system.

---

### Week 1–2 · Project Scaffold & Config

#### Install dependencies
```bash
npm install hono @hono/node-server @hono/node-ws @hono/zod-validator
npm install mongoose bcryptjs jsonwebtoken nanoid cookie-parser
npm install @aws-sdk/client-ses imagekitio-node
npm install hono-rate-limiter node-cron
npm install -D typescript tsx @types/node @types/bcryptjs
npm install -D @types/jsonwebtoken @types/cookie-parser @types/node-cron
npm install -D eslint @typescript-eslint/eslint-plugin @typescript-eslint/parser
npm install -D prettier husky lint-staged nodemon
```

#### Hono middleware pattern
```typescript
// middleware/protectRoute.ts
import { createMiddleware } from 'hono/factory'
import jwt from 'jsonwebtoken'
import { User } from '../models/User.ts'
import { ApiError } from '../utils/ApiError.ts'

export const protectRoute = createMiddleware<AppEnv>(async (c, next) => {
  const authHeader = c.req.header('Authorization')
  if (!authHeader?.startsWith('Bearer ')) {
    throw new ApiError(401, 'No token provided')
  }
  const token = authHeader.slice(7)
  try {
    const payload = jwt.verify(token, process.env.JWT_ACCESS_SECRET!) as { id: string }
    const user = await User.findById(payload.id)
    if (!user) throw new ApiError(401, 'User not found')
    c.set('user', user)
    await next()
  } catch {
    throw new ApiError(401, 'Invalid or expired token')
  }
})
```

#### MongoDB connection
```typescript
// config/db.ts
import mongoose from 'mongoose'

export async function connectDB(): Promise<void> {
  const uri = process.env.MONGO_URI
  if (!uri) throw new Error('MONGO_URI not defined')
  try {
    await mongoose.connect(uri)
    console.log('MongoDB connected')
  } catch (err) {
    console.error('MongoDB connection failed:', err)
    process.exit(1)
  }
}
```

---

### Week 3–4 · Auth System

#### Types (`types/models.ts`)
```typescript
import type { Document, Types } from 'mongoose'

export interface IUser extends Document {
  _id: Types.ObjectId
  name: string
  email: string
  passwordHash: string
  plan: 'free' | 'pro' | 'agency'
  brandColor: string
  logoUrl?: string
  logoFileId?: string        // ImageKit file ID for deletion
  refreshTokens: string[]   // hashed refresh tokens
  stripeCustomerId?: string
  lastActive?: Date
  comparePassword(plain: string): Promise<boolean>
}

export interface IProject extends Document {
  _id: Types.ObjectId
  ownerId: Types.ObjectId
  title: string
  description?: string
  slug: string
  status: 'active' | 'on-hold' | 'in-review' | 'completed'
  clientEmail?: string
  clientLastSeen?: Date
  viewCount: number
  passwordHash?: string
  expiresAt?: Date
  isDeleted: boolean
}

export interface IUpdate extends Document {
  _id: Types.ObjectId
  projectId: Types.ObjectId
  authorId: Types.ObjectId
  content: string
  type: 'text' | 'file' | 'milestone'
  isMilestone: boolean
  milestoneStatus: 'pending' | 'approved' | 'revision'
  files: IFileRef[]
  viewCount: number
  isDeleted: boolean
}

export interface IFileRef {
  url: string
  fileId: string            // ImageKit fileId (for deletion)
  name: string
  size: number
  mimeType: string
}
```

#### User model
```typescript
// models/User.ts
import { Schema, model } from 'mongoose'
import bcrypt from 'bcryptjs'
import type { IUser } from '../types/models.ts'

const UserSchema = new Schema<IUser>({
  name:              { type: String, required: true, trim: true, maxlength: 100 },
  email:             { type: String, required: true, unique: true, lowercase: true, trim: true },
  passwordHash:      { type: String, required: true, select: false },
  plan:              { type: String, enum: ['free','pro','agency'], default: 'free' },
  brandColor:        { type: String, default: '#6366f1' },
  logoUrl:           String,
  logoFileId:        String,
  refreshTokens:     [String],
  stripeCustomerId:  String,
  lastActive:        Date,
}, { timestamps: true })

UserSchema.pre('save', async function () {
  if (this.isModified('passwordHash')) {
    this.passwordHash = await bcrypt.hash(this.passwordHash, 12)
  }
})

UserSchema.methods.comparePassword = function (plain: string) {
  return bcrypt.compare(plain, this.passwordHash)
}

UserSchema.index({ email: 1 }, { unique: true })

export const User = model<IUser>('User', UserSchema)
```

#### Zod validators
```typescript
// validators/auth.validators.ts
import { z } from 'zod'

export const registerSchema = z.object({
  name:     z.string().min(2).max(100),
  email:    z.string().email(),
  password: z.string().min(8)
    .regex(/[A-Z]/, 'Must contain uppercase')
    .regex(/[0-9]/, 'Must contain number'),
})

export const loginSchema = z.object({
  email:    z.string().email(),
  password: z.string().min(1),
})

export type RegisterInput = z.infer<typeof registerSchema>
export type LoginInput    = z.infer<typeof loginSchema>
```

#### Auth routes (Hono pattern)
```typescript
// routes/auth.routes.ts
import { Hono } from 'hono'
import { zValidator } from '@hono/zod-validator'
import { registerSchema, loginSchema } from '../validators/auth.validators.ts'
import * as authController from '../controllers/authController.ts'
import { protectRoute } from '../middleware/protectRoute.ts'

const auth = new Hono<AppEnv>()

auth.post('/register', zValidator('json', registerSchema), authController.register)
auth.post('/login',    zValidator('json', loginSchema),    authController.login)
auth.post('/refresh',                                      authController.refresh)
auth.post('/logout',   protectRoute,                       authController.logout)
auth.get('/me',        protectRoute,                       authController.getMe)

export default auth
```

#### Auth controller
```typescript
// controllers/authController.ts — register handler
export const register = async (c: Context<AppEnv>) => {
  const { name, email, password } = c.req.valid('json')

  const exists = await User.findOne({ email })
  if (exists) throw new ApiError(400, 'Email already in use')

  const user = await User.create({ name, email, passwordHash: password })

  const accessToken  = generateAccessToken(user._id.toString())
  const refreshToken = generateRefreshToken(user._id.toString())
  await User.findByIdAndUpdate(user._id, {
    $push: { refreshTokens: hashToken(refreshToken) }
  })

  setCookie(c, 'refreshToken', refreshToken, {
    httpOnly: true, secure: true, sameSite: 'Strict', maxAge: 7 * 24 * 60 * 60
  })

  return c.json({ success: true, accessToken, user: { id: user._id, name, email, plan: user.plan } }, 201)
}
```

---

## Phase 2 — Core Update Engine
**Duration:** Weeks 5–10
**Goal:** Project CRUD, update posts, ImageKit file uploads, public client portal endpoint.

---

### Week 5–7 · Projects

#### Project model
```typescript
// models/Project.ts
const ProjectSchema = new Schema<IProject>({
  ownerId:       { type: Schema.Types.ObjectId, ref: 'User', required: true },
  title:         { type: String, required: true, trim: true, maxlength: 150 },
  description:   { type: String, trim: true, maxlength: 1000 },
  slug:          { type: String, required: true, unique: true, immutable: true },
  status:        { type: String, enum: ['active','on-hold','in-review','completed'], default: 'active' },
  clientEmail:   { type: String, trim: true, lowercase: true },
  clientLastSeen: Date,
  viewCount:     { type: Number, default: 0 },
  passwordHash:  { type: String, select: false },
  expiresAt:     Date,
  isDeleted:     { type: Boolean, default: false },
}, { timestamps: true })

ProjectSchema.index({ ownerId: 1, isDeleted: 1 })
ProjectSchema.index({ slug: 1 }, { unique: true })
```

#### Project routes
```typescript
// routes/project.routes.ts
const projects = new Hono<AppEnv>()

projects.use('*', protectRoute)

projects.get('/',     projectController.getAll)
projects.post('/',    zValidator('json', createProjectSchema), projectController.create)
projects.get('/:id',  ownerOnly('Project'), projectController.getOne)
projects.put('/:id',  ownerOnly('Project'), zValidator('json', updateProjectSchema), projectController.update)
projects.delete('/:id', ownerOnly('Project'), projectController.remove)

// Updates sub-resource
projects.get('/:id/updates',  projectController.getUpdates)
projects.post('/:id/updates', zValidator('json', createUpdateSchema), updateController.create)
```

#### Public route (no auth)
```typescript
// Separate public router — no protectRoute middleware
const publicRoutes = new Hono()

publicRoutes.use('/api/public/*', rateLimiter({ limit: 100, windowMs: 15 * 60 * 1000, ... }))

publicRoutes.get('/:slug', async (c) => {
  const { slug } = c.req.param()
  const project = await Project.findOne({ slug, isDeleted: false })
  if (!project) return c.json({ success: false, message: 'Not found' }, 404)

  if (project.expiresAt && project.expiresAt < new Date()) {
    return c.json({ success: false, expired: true }, 403)
  }

  await Project.findByIdAndUpdate(project._id, {
    $inc: { viewCount: 1 },
    clientLastSeen: new Date(),
  })

  // Emit WS event to owner
  wsManager.emit(`user:${project.ownerId}`, 'client_viewed', {
    projectId: project._id,
    timestamp: new Date(),
  })

  const updates = await Update.find({ projectId: project._id, isDeleted: false })
    .sort({ createdAt: -1 })
    .limit(20)

  return c.json({ success: true, data: { project, updates } })
})
```

---

### Week 8–10 · ImageKit File Upload

#### ImageKit configuration
```typescript
// config/imagekit.ts
import ImageKit from 'imagekitio-node'

export const imagekit = new ImageKit({
  publicKey:   process.env.IMAGEKIT_PUBLIC_KEY!,
  privateKey:  process.env.IMAGEKIT_PRIVATE_KEY!,
  urlEndpoint: process.env.IMAGEKIT_URL_ENDPOINT!,  // e.g. https://ik.imagekit.io/your_id
})
```

#### Upload service
```typescript
// services/uploadService.ts
import { imagekit } from '../config/imagekit.ts'
import type { IFileRef } from '../types/models.ts'

export async function uploadFile(
  buffer: Buffer,
  fileName: string,
  folder: string = 'client-portal'
): Promise<IFileRef> {
  const result = await imagekit.upload({
    file: buffer.toString('base64'),
    fileName,
    folder,
    useUniqueFileName: true,
    tags: ['client-portal'],
  })

  return {
    url:      result.url,
    fileId:   result.fileId,           // Store for deletion later
    name:     result.name,
    size:     result.size,
    mimeType: result.fileType === 'image' ? 'image/*' : 'application/octet-stream',
  }
}

export async function deleteFile(fileId: string): Promise<void> {
  await imagekit.deleteFile(fileId)
}

// ImageKit URL transformations — generate optimised URLs server-side
export function getTransformedUrl(
  url: string,
  transforms: { width?: number; height?: number; quality?: number; format?: string }
) {
  return imagekit.url({
    src: url,
    transformation: [{ ...transforms }]
  })
}
```

#### Upload route (Hono multipart)
```typescript
// routes/upload.routes.ts
import { Hono } from 'hono'
import { protectRoute } from '../middleware/protectRoute.ts'

const uploads = new Hono<AppEnv>()
uploads.use('*', protectRoute)

uploads.post('/', async (c) => {
  const user = c.get('user')
  const formData = await c.req.formData()
  const files = formData.getAll('files') as File[]

  if (!files.length) throw new ApiError(400, 'No files provided')
  if (files.length > 5) throw new ApiError(400, 'Max 5 files per upload')

  const ALLOWED_TYPES = [
    'image/jpeg','image/png','image/gif','image/webp',
    'application/pdf','application/zip',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
  ]

  const uploaded: IFileRef[] = []

  for (const file of files) {
    if (!ALLOWED_TYPES.includes(file.type)) {
      throw new ApiError(400, `File type ${file.type} not allowed`)
    }
    if (file.size > 10 * 1024 * 1024) {
      throw new ApiError(400, `${file.name} exceeds 10 MB limit`)
    }
    const buffer = Buffer.from(await file.arrayBuffer())
    const fileRef = await uploadService.uploadFile(buffer, file.name)

    // Persist file record
    await FileModel.create({ ownerId: user._id, url: fileRef.url, ...fileRef })
    uploaded.push(fileRef)
  }

  return c.json({ success: true, data: uploaded }, 201)
})

uploads.delete('/:fileId', async (c) => {
  const user = c.get('user')
  const { fileId } = c.req.param()
  const file = await FileModel.findOne({ fileId, ownerId: user._id })
  if (!file) throw new ApiError(404, 'File not found')
  await uploadService.deleteFile(fileId)
  await file.deleteOne()
  return c.json({ success: true })
})
```

---

## Phase 3 — Collaboration Layer
**Duration:** Weeks 11–18
**Goal:** Comments, WebSocket real-time events, AWS SES email notifications.

---

### Week 11–14 · Comments & Approvals

#### Comment model
```typescript
// models/Comment.ts
export interface IComment extends Document {
  updateId:    Types.ObjectId
  projectId:   Types.ObjectId
  authorName:  string
  authorEmail: string
  body:        string
  type:        'comment' | 'approval' | 'revision'
  createdAt:   Date
}

const CommentSchema = new Schema<IComment>({
  updateId:    { type: Schema.Types.ObjectId, ref: 'Update', required: true },
  projectId:   { type: Schema.Types.ObjectId, ref: 'Project', required: true },
  authorName:  { type: String, required: true, trim: true, maxlength: 100 },
  authorEmail: { type: String, required: true, trim: true, lowercase: true },
  body:        { type: String, required: true, trim: true, maxlength: 2000 },
  type:        { type: String, enum: ['comment','approval','revision'], default: 'comment' },
}, { timestamps: true })

CommentSchema.index({ updateId: 1, createdAt: 1 })
```

---

### Week 15–18 · WebSocket & AWS SES

#### WebSocket manager (Hono + ws)
```typescript
// config/websocket.ts
import type { ServerWebSocket } from '@hono/node-ws'

type WSClient = { ws: ServerWebSocket; userId: string; projectIds: Set<string> }

class WebSocketManager {
  private clients = new Map<string, WSClient>()    // key = connectionId

  register(connectionId: string, userId: string, ws: ServerWebSocket) {
    this.clients.set(connectionId, { ws, userId, projectIds: new Set() })
  }

  unregister(connectionId: string) {
    this.clients.delete(connectionId)
  }

  joinProject(connectionId: string, projectId: string) {
    this.clients.get(connectionId)?.projectIds.add(projectId)
  }

  leaveProject(connectionId: string, projectId: string) {
    this.clients.get(connectionId)?.projectIds.delete(projectId)
  }

  // Emit to all connections belonging to a userId
  emit(userId: string, event: string, payload: unknown) {
    for (const client of this.clients.values()) {
      if (client.userId === userId && client.ws.readyState === 1) {
        client.ws.send(JSON.stringify({ event, payload }))
      }
    }
  }

  // Emit to all connections watching a project
  emitToProject(projectId: string, event: string, payload: unknown) {
    for (const client of this.clients.values()) {
      if (client.projectIds.has(projectId) && client.ws.readyState === 1) {
        client.ws.send(JSON.stringify({ event, payload }))
      }
    }
  }
}

export const wsManager = new WebSocketManager()
```

#### WebSocket route
```typescript
// routes/ws.routes.ts
import { createNodeWebSocket } from '@hono/node-ws'

export const wsHandler = upgradeWebSocket((c) => {
  const token = c.req.query('token')
  let userId: string

  return {
    onOpen(_, ws) {
      try {
        const payload = jwt.verify(token!, process.env.JWT_ACCESS_SECRET!) as { id: string }
        userId = payload.id
        const connectionId = nanoid()
        wsManager.register(connectionId, userId, ws)
        ws.send(JSON.stringify({ event: 'connected', payload: { connectionId } }))
      } catch {
        ws.close(1008, 'Unauthorized')
      }
    },
    onMessage(event, ws) {
      const msg = JSON.parse(event.data.toString())
      if (msg.event === 'join_project')  wsManager.joinProject(msg.connectionId, msg.projectId)
      if (msg.event === 'leave_project') wsManager.leaveProject(msg.connectionId, msg.projectId)
    },
    onClose() {
      wsManager.unregister(userId)
    }
  }
})
```

#### AWS SES email service
```typescript
// config/ses.ts
import { SESClient } from '@aws-sdk/client-ses'

export const sesClient = new SESClient({
  region: process.env.AWS_REGION!,          // e.g. 'us-east-1'
  credentials: {
    accessKeyId:     process.env.AWS_ACCESS_KEY_ID!,
    secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY!,
  },
})
```

```typescript
// services/emailService.ts
import { SendEmailCommand } from '@aws-sdk/client-ses'
import { sesClient } from '../config/ses.ts'

interface SendEmailOptions {
  to: string | string[]
  subject: string
  htmlBody: string
  textBody?: string
}

async function send(opts: SendEmailOptions): Promise<void> {
  const toAddresses = Array.isArray(opts.to) ? opts.to : [opts.to]

  await sesClient.send(new SendEmailCommand({
    Source: `${process.env.EMAIL_FROM_NAME} <${process.env.EMAIL_FROM}>`,
    Destination: { ToAddresses: toAddresses },
    Message: {
      Subject: { Data: opts.subject, Charset: 'UTF-8' },
      Body: {
        Html: { Data: opts.htmlBody, Charset: 'UTF-8' },
        Text: { Data: opts.textBody ?? opts.subject, Charset: 'UTF-8' },
      },
    },
  }))
}

// Named email functions used by controllers
export async function sendPortalLink(clientEmail: string, project: IProject) {
  const url = `${process.env.CLIENT_URL}/p/${project.slug}`
  await send({
    to: clientEmail,
    subject: `You have a project update from ${project.title}`,
    htmlBody: portalLinkTemplate(project, url),     // HTML template string
  })
}

export async function sendUpdateNotification(clientEmail: string, project: IProject, update: IUpdate) {
  await send({
    to: clientEmail,
    subject: `New update on "${project.title}"`,
    htmlBody: updateNotificationTemplate(project, update),
  })
}

export async function sendMilestoneStatusEmail(ownerEmail: string, project: IProject, status: string) {
  await send({
    to: ownerEmail,
    subject: `Milestone ${status} on "${project.title}"`,
    htmlBody: milestoneStatusTemplate(project, status),
  })
}

export async function sendWeeklyDigest(ownerEmail: string, stats: DigestStats) {
  await send({
    to: ownerEmail,
    subject: 'Your weekly Client Portal summary',
    htmlBody: weeklyDigestTemplate(stats),
  })
}
```

**AWS SES setup checklist:**
- Verify sender domain in SES console (add DNS TXT + DKIM records)
- Request production access (exit sandbox) — sandbox only sends to verified addresses
- Set up SES identity policy in IAM with `ses:SendEmail` permission
- Store credentials in environment variables — never commit to repo
- Add bounce + complaint SNS topic for delivery health monitoring

---

## Phase 4 — Polish & Power Features
**Duration:** Weeks 19–26
**Goal:** ImageKit branding transforms, analytics, access control, team members.

---

### Week 19–22 · Branding with ImageKit

#### Logo upload & transformation
```typescript
// In settings controller
export const updateBranding = async (c: Context<AppEnv>) => {
  const user = c.get('user')
  const formData = await c.req.formData()
  const logoFile = formData.get('logo') as File | null

  let logoUrl = user.logoUrl
  let logoFileId = user.logoFileId

  if (logoFile) {
    // Delete old logo from ImageKit
    if (logoFileId) await uploadService.deleteFile(logoFileId)

    const buffer = Buffer.from(await logoFile.arrayBuffer())
    const uploaded = await uploadService.uploadFile(buffer, `logo-${user._id}`, 'branding')
    logoUrl = uploaded.url
    logoFileId = uploaded.fileId
  }

  const brandColor = formData.get('brandColor') as string | null

  await User.findByIdAndUpdate(user._id, {
    ...(logoUrl && { logoUrl, logoFileId }),
    ...(brandColor && { brandColor }),
  })

  // Return ImageKit transformation URL for logo display
  // e.g. 80×80 thumbnail, WebP format
  const logoThumbUrl = logoUrl
    ? uploadService.getTransformedUrl(logoUrl, { width: 80, height: 80, format: 'webp' })
    : null

  return c.json({ success: true, data: { logoUrl, logoThumbUrl, brandColor } })
}
```

**ImageKit transformation patterns used:**
```
// Original logo → 80×80 avatar
?tr=w-80,h-80,f-webp,q-80

// File attachment thumbnail (images only)
?tr=w-200,h-150,fo-auto,f-webp

// Portal header logo → max 160px wide, maintain ratio
?tr=w-160,f-webp
```

---

### Week 23–26 · Cron Jobs

```typescript
// services/cronService.ts
import cron from 'node-cron'

// Weekly digest — every Monday 08:00
cron.schedule('0 8 * * 1', async () => {
  const users = await User.find({ plan: { $ne: 'free' } })
  for (const user of users) {
    const stats = await aggregateWeeklyStats(user._id)
    await emailService.sendWeeklyDigest(user.email, stats)
  }
})

// Expired portal cleanup — daily at midnight
cron.schedule('0 0 * * *', async () => {
  await Project.updateMany(
    { expiresAt: { $lt: new Date() }, isDeleted: false },
    { $set: { status: 'completed', isDeleted: true } }
  )
})
```

---

## Phase 5 — Monetisation & Scale
**Duration:** Weeks 27–32
**Goal:** Stripe billing, Redis caching, security hardening, production deploy.

---

### Week 27–29 · Stripe

```typescript
// routes/billing.routes.ts
billing.post('/create-checkout', protectRoute, async (c) => {
  const user = c.get('user')
  const { priceId } = await c.req.json<{ priceId: string }>()

  const session = await stripe.checkout.sessions.create({
    customer_email: user.email,
    mode: 'subscription',
    line_items: [{ price: priceId, quantity: 1 }],
    success_url: `${process.env.CLIENT_URL}/settings/billing?success=true`,
    cancel_url:  `${process.env.CLIENT_URL}/settings/billing`,
    metadata: { userId: user._id.toString() },
  })

  return c.json({ success: true, url: session.url })
})

// Webhook — raw body required
billing.post('/webhook', async (c) => {
  const sig  = c.req.header('stripe-signature')!
  const body = await c.req.raw.arrayBuffer()
  const event = stripe.webhooks.constructEvent(Buffer.from(body), sig, process.env.STRIPE_WEBHOOK_SECRET!)

  switch (event.type) {
    case 'checkout.session.completed':
      await handleCheckoutComplete(event.data.object)
      break
    case 'customer.subscription.deleted':
      await handleSubscriptionDeleted(event.data.object)
      break
  }

  return c.json({ received: true })
})
```

### Week 30–32 · Security & Deploy

**Security middleware additions:**
```typescript
// Mongo sanitize — strip $ and . from keys
app.use('*', async (c, next) => {
  const body = await c.req.json().catch(() => null)
  if (body) sanitizeMongoQuery(body)    // recursive key sanitizer
  await next()
})

// Rate limit auth routes more aggressively
const authLimiter = rateLimiter({ limit: 10, windowMs: 15 * 60 * 1000, ... })
auth.use('/login', authLimiter)
auth.use('/register', authLimiter)
```

**Production checklist:**
- `NODE_ENV=production` — suppresses stack traces in error responses
- All secrets loaded from Railway environment (never `.env` committed)
- MongoDB Atlas network access: whitelist Railway outbound IPs only
- SES in production mode (sandbox exited, domain verified)
- ImageKit webhook URL configured for upload event logging
- Sentry DSN set for exception tracking
- Health check endpoint: `GET /health` returns `200 OK`

---

## Environment Variables Reference

```bash
# Server
PORT=5000
NODE_ENV=development

# Database
MONGO_URI=mongodb+srv://user:pass@cluster.mongodb.net/clientportal

# Auth
JWT_ACCESS_SECRET=long-random-string-64-chars
JWT_REFRESH_SECRET=different-long-random-string
JWT_ACCESS_EXPIRY=15m
JWT_REFRESH_EXPIRY=7d

# ImageKit
IMAGEKIT_PUBLIC_KEY=public_...
IMAGEKIT_PRIVATE_KEY=private_...
IMAGEKIT_URL_ENDPOINT=https://ik.imagekit.io/your_id

# AWS SES
AWS_REGION=us-east-1
AWS_ACCESS_KEY_ID=AKI...
AWS_SECRET_ACCESS_KEY=...
EMAIL_FROM=noreply@yourdomain.com
EMAIL_FROM_NAME=Client Update Portal

# Frontend
CLIENT_URL=http://localhost:3000   # Next.js dev server (was 5173 on Vite)

# Redis (Phase 5)
REDIS_URL=redis://...

# Stripe (Phase 5)
STRIPE_SECRET_KEY=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

---

## API Endpoint Summary

| Method | Route | Auth | Phase |
|---|---|---|---|
| POST | /api/auth/register | public | 1 |
| POST | /api/auth/login | public | 1 |
| POST | /api/auth/refresh | public | 1 |
| POST | /api/auth/logout | JWT | 1 |
| GET | /api/auth/me | JWT | 1 |
| GET | /api/projects | JWT | 2 |
| POST | /api/projects | JWT | 2 |
| GET | /api/projects/:id | JWT | 2 |
| PUT | /api/projects/:id | JWT | 2 |
| DELETE | /api/projects/:id | JWT | 2 |
| GET | /api/public/:slug | public | 2 |
| GET | /api/projects/:id/updates | JWT | 2 |
| POST | /api/projects/:id/updates | JWT | 2 |
| PUT | /api/updates/:id | JWT | 2 |
| DELETE | /api/updates/:id | JWT | 2 |
| PATCH | /api/updates/:id/milestone | public | 2 |
| POST | /api/uploads | JWT | 2 |
| DELETE | /api/uploads/:fileId | JWT | 2 |
| POST | /api/updates/:id/comments | public | 3 |
| GET | /api/updates/:id/comments | public | 3 |
| DELETE | /api/comments/:id | JWT | 3 |
| GET | /api/notifications | JWT | 3 |
| PATCH | /api/notifications/read-all | JWT | 3 |
| PATCH | /api/settings/branding | JWT | 4 |
| GET | /api/projects/:id/analytics | JWT | 4 |
| PATCH | /api/projects/:id/set-password | JWT | 4 |
| POST | /api/workspaces/invite | JWT | 4 |
| POST | /api/billing/create-checkout | JWT | 5 |
| POST | /api/billing/webhook | public | 5 |
| GET | /api/billing/portal | JWT | 5 |
| GET | /ws | token query | 3 |

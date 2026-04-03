# Client Update Portal — Backend Roadmap
### MERN Stack · Node.js + Express + MongoDB

---

## Overview

| | |
|---|---|
| **Runtime** | Node.js 20 LTS |
| **Framework** | Express 4.x |
| **Database** | MongoDB Atlas + Mongoose 8.x |
| **Auth** | JWT (access + refresh tokens) + bcryptjs |
| **File Storage** | Multer + Cloudinary |
| **Real-time** | Socket.io 4.x |
| **Email** | Nodemailer + Resend |
| **Deployment** | Railway (or Render) |
| **Total Phases** | 5 |
| **Total Duration** | ~32 weeks |

---

## Folder Structure

```
/server
├── src/
│   ├── config/
│   │   ├── db.js               # Mongoose connection
│   │   ├── cloudinary.js       # Cloudinary SDK init
│   │   └── socket.js           # Socket.io setup
│   ├── models/
│   │   ├── User.js
│   │   ├── Project.js
│   │   ├── Update.js
│   │   ├── Comment.js
│   │   ├── File.js
│   │   └── Notification.js
│   ├── controllers/
│   │   ├── authController.js
│   │   ├── projectController.js
│   │   ├── updateController.js
│   │   ├── commentController.js
│   │   ├── uploadController.js
│   └── └── notificationController.js
│   ├── routes/
│   │   ├── auth.routes.js
│   │   ├── project.routes.js
│   │   ├── update.routes.js
│   │   ├── comment.routes.js
│   │   ├── upload.routes.js
│   └── └── notification.routes.js
│   ├── middleware/
│   │   ├── protectRoute.js     # JWT verify
│   │   ├── ownerOnly.js        # Resource ownership check
│   │   ├── rateLimiter.js      # express-rate-limit configs
│   │   ├── validate.js         # express-validator wrapper
│   └── └── errorHandler.js     # Centralised error middleware
│   ├── services/
│   │   ├── emailService.js     # Nodemailer/Resend abstraction
│   │   ├── uploadService.js    # Cloudinary upload/delete
│   └── └── notificationService.js
│   └── utils/
│       ├── generateSlug.js     # nanoid slug generator
│       ├── generateToken.js    # JWT sign helpers
│       └── ApiError.js         # Custom error class
├── .env
├── .env.example
├── server.js                   # Express app entry point
└── package.json
```

---

## Phase 1 — Foundation & Auth
**Duration:** Weeks 1–4  
**Goal:** Working server, database connection, complete authentication system, and project CRUD skeleton.

---

### Week 1–2 · Project Scaffold & Config

#### Tasks

**1. Initialise project**
- `npm init -y` inside `/server`
- Install core dependencies:
  ```
  express mongoose dotenv cors helmet morgan express-rate-limit
  bcryptjs jsonwebtoken nanoid cookie-parser
  ```
- Install dev dependencies:
  ```
  nodemon eslint prettier eslint-config-prettier husky lint-staged
  ```
- Set up `.eslintrc.json` and `.prettierrc`
- Configure Husky pre-commit hook to run `eslint` and `prettier --check`

**2. Express app setup (`server.js`)**
- Create Express app instance
- Register middleware in order:
  1. `helmet()` — security headers
  2. `cors({ origin: process.env.CLIENT_URL, credentials: true })` — allow frontend
  3. `express.json()` and `express.urlencoded({ extended: true })` — body parsing
  4. `morgan('dev')` — request logging (development only)
  5. Global rate limiter: `express-rate-limit` — 200 req / 15 min per IP
  6. Cookie parser for refresh token cookie
- Mount route files (placeholder at this stage)
- Register error handler middleware last

**3. MongoDB connection (`config/db.js`)**
- `mongoose.connect(process.env.MONGO_URI)` with retry logic on failure
- Log connection success/failure
- Call `connectDB()` from `server.js` before `app.listen()`
- Set up MongoDB Atlas cluster, create `clientportal` database
- Create `.env` with:
  ```
  PORT=5000
  MONGO_URI=mongodb+srv://...
  JWT_ACCESS_SECRET=...
  JWT_REFRESH_SECRET=...
  CLIENT_URL=http://localhost:5173
  NODE_ENV=development
  ```

**4. Error handling infrastructure**
- Create `utils/ApiError.js` — custom error class with `statusCode`, `message`, `isOperational`
- Create `middleware/errorHandler.js`:
  - Catch `ApiError` instances → send structured JSON response
  - Catch Mongoose `ValidationError` → 400
  - Catch Mongoose `CastError` (bad ObjectId) → 404
  - Catch JWT errors → 401
  - All others → 500 with generic message (don't leak stack in production)

**5. CI pipeline**
- GitHub Actions workflow: `.github/workflows/ci.yml`
- Trigger on pull requests to `main`
- Jobs: install deps, run ESLint, run tests (placeholder for now)

---

### Week 3–4 · Authentication System

#### Models

**User model (`models/User.js`)**
```
Fields:
  name          String    required, trim, maxLength 100
  email         String    required, unique, lowercase, trim
  passwordHash  String    required, select: false
  plan          String    enum: ['free', 'pro', 'agency'], default: 'free'
  brandColor    String    default: '#6366f1'
  logoUrl       String
  refreshTokens [String]  array of active refresh token hashes
  stripeCustomerId String
  createdAt     Date      auto (timestamps: true)
  updatedAt     Date      auto

Mongoose hooks:
  pre('save') → if passwordHash modified, bcrypt.hash(12 rounds)

Instance methods:
  comparePassword(plain) → bcrypt.compare
  
Indexes:
  email: unique
```

#### Controllers & Routes

**Auth controller (`controllers/authController.js`)**

`POST /api/auth/register`
- Validate: name (required), email (valid format), password (min 8 chars, 1 uppercase, 1 number)
- Check email not already taken → `ApiError(400, 'Email already in use')`
- Create user document (passwordHash set via pre-save hook)
- Generate access token (15 min expiry) + refresh token (7 days expiry)
- Store hashed refresh token in `user.refreshTokens[]`
- Set refresh token as `httpOnly; Secure; SameSite=Strict` cookie
- Return `{ success: true, user: { id, name, email, plan }, accessToken }`

`POST /api/auth/login`
- Find user by email, include `passwordHash` (override `select: false`)
- If not found or password mismatch → `ApiError(401, 'Invalid credentials')` (same message for both — prevents user enumeration)
- Clear expired refresh tokens from array
- Generate new token pair
- Return same shape as register

`POST /api/auth/refresh`
- Read refresh token from `req.cookies.refreshToken`
- Verify JWT signature with `JWT_REFRESH_SECRET`
- Find user by id from token payload
- Check hashed token exists in `user.refreshTokens[]`
- Rotate: remove old token hash, generate new pair, store new hash
- Return new `{ accessToken }`

`POST /api/auth/logout`
- Requires `protectRoute` middleware
- Remove current refresh token hash from `user.refreshTokens[]`
- Clear cookie
- Return `{ success: true }`

`GET /api/auth/me`
- Requires `protectRoute`
- Return `req.user` (attached by middleware)

**protectRoute middleware (`middleware/protectRoute.js`)**
- Extract `Authorization: Bearer <token>` header
- `jwt.verify(token, JWT_ACCESS_SECRET)` — throw 401 on failure
- Find user by `payload.id`, attach to `req.user`
- Call `next()`

#### Token Utilities (`utils/generateToken.js`)
```javascript
generateAccessToken(userId)  → jwt.sign({ id }, ACCESS_SECRET, { expiresIn: '15m' })
generateRefreshToken(userId) → jwt.sign({ id }, REFRESH_SECRET, { expiresIn: '7d' })
hashToken(token)             → crypto.createHash('sha256').update(token).digest('hex')
```

#### Validation
- Use `express-validator` for all input
- Create reusable validation chains: `validateRegister`, `validateLogin`
- `middleware/validate.js` runs `validationResult(req)` and throws `ApiError(400)` with field errors array

---

## Phase 2 — Core Update Engine
**Duration:** Weeks 5–10  
**Goal:** Project CRUD with public slug access, update posting, file uploads to Cloudinary, and the client-facing public endpoint.

---

### Week 5–7 · Projects

#### Models

**Project model (`models/Project.js`)**
```
Fields:
  ownerId       ObjectId  required, ref: 'User'
  title         String    required, trim, maxLength 150
  description   String    trim, maxLength 1000
  slug          String    required, unique, immutable after creation
  status        String    enum: ['active', 'on-hold', 'in-review', 'completed'], default: 'active'
  clientEmail   String    trim, lowercase
  clientLastSeen Date
  viewCount     Number    default: 0
  passwordHash  String    select: false  (portal password protection — Phase 4)
  expiresAt     Date      (portal expiry — Phase 4)
  isDeleted     Boolean   default: false
  
Indexes:
  { ownerId: 1, isDeleted: 1 }    (list user projects)
  { slug: 1 }                      (unique, public route)
```

**Slug generation (`utils/generateSlug.js`)**
```javascript
// Use nanoid for URL-safe 10-char slugs
// Check uniqueness with retry loop (max 5 attempts)
async function generateUniqueSlug() {
  for (let i = 0; i < 5; i++) {
    const slug = nanoid(10);
    const exists = await Project.findOne({ slug });
    if (!exists) return slug;
  }
  throw new ApiError(500, 'Could not generate unique slug');
}
```

#### Controllers & Routes

`GET /api/projects`
- `protectRoute`
- Query: `{ ownerId: req.user._id, isDeleted: false }`
- Sort: `createdAt: -1`
- Select: all fields except `passwordHash`
- Return array of projects

`POST /api/projects`
- `protectRoute`
- Validate: title required, clientEmail optional valid email
- Generate slug via `generateUniqueSlug()`
- Create project document
- Return created project

`GET /api/projects/:id`
- `protectRoute` + `ownerOnly`
- Populate owner name
- Return project

`PUT /api/projects/:id`
- `protectRoute` + `ownerOnly`
- Allow updating: title, description, status, clientEmail
- Prevent updating: slug, ownerId
- Return updated project

`DELETE /api/projects/:id`
- `protectRoute` + `ownerOnly`
- Soft delete: `isDeleted: true`
- Also soft-delete all associated updates
- Return `{ success: true }`

`GET /api/public/:slug`
- No auth
- Rate limit: 100 req / 15 min per IP (separate limiter for public routes)
- Find project by slug where `isDeleted: false`
- If `expiresAt` is set and past → return `{ expired: true }` (Phase 4)
- Increment `viewCount`
- Set `clientLastSeen: new Date()`
- Fetch associated updates (published, sorted `createdAt: -1`, paginated)
- Return `{ project, updates, pagination }`

**ownerOnly middleware**
- Find resource by `req.params.id`
- Check `resource.ownerId.equals(req.user._id)`
- Attach resource to `req.resource` for controller reuse

---

### Week 8–10 · Updates & File Uploads

#### Models

**Update model (`models/Update.js`)**
```
Fields:
  projectId       ObjectId  required, ref: 'Project'
  authorId        ObjectId  required, ref: 'User'
  content         String    required, trim, maxLength 5000
  type            String    enum: ['text', 'file', 'milestone'], default: 'text'
  isMilestone     Boolean   default: false
  milestoneStatus String    enum: ['pending', 'approved', 'revision'], default: 'pending'
  files           [{ url, publicId, name, size, mimeType }]  (embedded sub-docs)
  viewCount       Number    default: 0
  isDeleted       Boolean   default: false
  
Indexes:
  { projectId: 1, isDeleted: 1, createdAt: -1 }   (paginated update list)
```

**File model (`models/File.js`)**
```
Fields:
  ownerId       ObjectId  ref: 'User'
  projectId     ObjectId  ref: 'Project'
  url           String    required  (Cloudinary CDN URL)
  publicId      String    required  (Cloudinary public_id for deletion)
  originalName  String
  mimeType      String
  size          Number    (bytes)
  
Indexes:
  { projectId: 1 }
  { ownerId: 1 }
```

#### File Upload Service (`services/uploadService.js`)

**Multer configuration**
```javascript
// Memory storage — pipe buffer directly to Cloudinary
const storage = multer.memoryStorage();
const upload = multer({
  storage,
  limits: { fileSize: 10 * 1024 * 1024 },  // 10MB per file
  fileFilter: (req, file, cb) => {
    const allowed = ['image/jpeg','image/png','image/gif','image/webp',
                     'application/pdf','application/zip',
                     'application/msword',
                     'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    cb(null, allowed.includes(file.mimetype));
  }
});
```

**Cloudinary upload**
```javascript
async function uploadToCloudinary(buffer, originalname, mimetype) {
  return new Promise((resolve, reject) => {
    const uploadStream = cloudinary.uploader.upload_stream(
      { folder: 'client-portal', resource_type: 'auto' },
      (error, result) => error ? reject(error) : resolve(result)
    );
    streamifier.createReadStream(buffer).pipe(uploadStream);
  });
}

async function deleteFromCloudinary(publicId) {
  return cloudinary.uploader.destroy(publicId);
}
```

#### Upload Routes

`POST /api/uploads`
- `protectRoute`
- `upload.array('files', 5)` middleware (max 5 files per request)
- For each file: upload to Cloudinary, save File document to DB
- Return array of `{ fileId, url, name, size, mimeType }`

`DELETE /api/uploads/:id`
- `protectRoute`
- Find File document, verify `ownerId === req.user._id`
- `deleteFromCloudinary(file.publicId)`
- Delete File document from DB
- Return `{ success: true }`

#### Update Routes

`GET /api/projects/:id/updates`
- `protectRoute` + verify project ownership
- Query params: `page` (default 1), `limit` (default 10), `type` filter
- Mongoose `.find({ projectId, isDeleted: false }).sort({ createdAt: -1 }).skip().limit()`
- Return `{ updates, pagination: { page, pages, total } }`

`POST /api/projects/:id/updates`
- `protectRoute` + verify project ownership
- Validate: content required, type in enum
- Create update document with `files[]` from uploaded file IDs
- If `isMilestone: true`, set `type: 'milestone'`
- Trigger email to `project.clientEmail` via `emailService.sendUpdateNotification()`
- Return created update

`PUT /api/updates/:id`
- `protectRoute` + `ownerOnly`
- Allow updating: content only (not files after posting — keep audit trail)
- Return updated update

`DELETE /api/updates/:id`
- `protectRoute` + `ownerOnly`
- Soft delete
- Return `{ success: true }`

`PATCH /api/updates/:id/milestone`
- Public (no auth) — client action
- Body: `{ status: 'approved' | 'revision', authorName, authorEmail }`
- Update `milestoneStatus` field
- Trigger `emailService.sendMilestoneStatusEmail()` to project owner
- Emit socket event `milestone_status_changed` to owner's room (Phase 3)
- Return updated milestone status

---

## Phase 3 — Collaboration Layer
**Duration:** Weeks 11–18  
**Goal:** Comment system, real-time notifications via Socket.io, and email event triggers.

---

### Week 11–14 · Comments

#### Models

**Comment model (`models/Comment.js`)**
```
Fields:
  updateId      ObjectId  required, ref: 'Update'
  projectId     ObjectId  required, ref: 'Project'
  authorName    String    required, trim, maxLength 100
  authorEmail   String    required, trim, lowercase
  body          String    required, trim, maxLength 2000
  type          String    enum: ['comment', 'approval', 'revision'], default: 'comment'
  
Indexes:
  { updateId: 1, createdAt: 1 }
  { projectId: 1, createdAt: -1 }
```

#### Routes

`POST /api/updates/:id/comments`
- No auth required
- Validate: authorName, authorEmail (valid format), body (min 1 char, max 2000)
- Find update, get associated project
- Create comment document
- Notify project owner: `notificationService.notify()` + email if owner offline
- Emit socket event `comment_added` to project room
- Return created comment

`GET /api/updates/:id/comments`
- No auth
- Sort: `createdAt: 1` (oldest first — conversation order)
- No pagination (comments expected to be few per update; if >50 add cursor pagination)
- Return comment array

`DELETE /api/comments/:id`
- `protectRoute`
- Find comment, verify associated project is owned by `req.user._id`
- Hard delete (comments are not business records like updates)
- Return `{ success: true }`

---

### Week 15–18 · Socket.io & Notifications

#### Socket.io Setup (`config/socket.js`)

```javascript
// Attach Socket.io to HTTP server
const io = new Server(httpServer, {
  cors: { origin: process.env.CLIENT_URL, credentials: true }
});

// Auth middleware for socket connections
io.use((socket, next) => {
  const token = socket.handshake.auth.token;
  try {
    const payload = jwt.verify(token, JWT_ACCESS_SECRET);
    socket.userId = payload.id;
    next();
  } catch (err) {
    next(new Error('Unauthorized'));
  }
});

io.on('connection', (socket) => {
  // Provider joins their own user room
  socket.join(`user:${socket.userId}`);

  // Provider joins a specific project room when viewing it
  socket.on('join_project', (projectId) => {
    socket.join(`project:${projectId}`);
  });

  socket.on('leave_project', (projectId) => {
    socket.leave(`project:${projectId}`);
  });
});

// Export io for use in controllers/services
module.exports = io;
```

#### Notification Model (`models/Notification.js`)
```
Fields:
  userId    ObjectId  required, ref: 'User'
  type      String    enum: ['client_viewed', 'comment_added', 'milestone_approved',
                             'milestone_revision', 'team_invite']
  message   String    required
  read      Boolean   default: false
  refId     ObjectId  (points to project or update)
  refType   String    enum: ['Project', 'Update', 'Comment']
  
Indexes:
  { userId: 1, read: 1, createdAt: -1 }
```

#### Notification Service (`services/notificationService.js`)

```javascript
async function notify(userId, type, message, refId, refType) {
  // 1. Persist notification to DB
  const notification = await Notification.create({ userId, type, message, refId, refType });

  // 2. Emit to user's socket room (if online, they receive it immediately)
  io.to(`user:${userId}`).emit('new_notification', notification);

  // 3. Check if user has been online in last 5 minutes (via lastActive timestamp)
  //    If not → send email fallback
  const user = await User.findById(userId).select('email lastActive');
  const isOnline = user.lastActive && (Date.now() - user.lastActive) < 5 * 60 * 1000;
  if (!isOnline) {
    await emailService.sendNotificationEmail(user.email, type, message);
  }

  return notification;
}
```

#### Socket events emitted by backend

| Event | Payload | Emitted when |
|---|---|---|
| `new_notification` | notification object | Any notifiable event |
| `client_viewed` | `{ projectId, timestamp }` | Client hits `GET /api/public/:slug` |
| `comment_added` | `{ updateId, comment }` | New comment created |
| `milestone_status_changed` | `{ updateId, status }` | Client approves/revises |
| `update_posted` | `{ projectId, update }` | New update created (for team members) |

#### Notification Routes

`GET /api/notifications`
- `protectRoute`
- Query: `{ userId: req.user._id }`, sort `createdAt: -1`
- Pagination: `page`, `limit` (default 20)
- Return `{ notifications, unreadCount, pagination }`

`PATCH /api/notifications/read-all`
- `protectRoute`
- `Notification.updateMany({ userId: req.user._id, read: false }, { read: true })`
- Return `{ success: true, updated: count }`

`PATCH /api/notifications/:id/read`
- `protectRoute`
- Find notification, verify `userId === req.user._id`
- Set `read: true`
- Return updated notification

#### Email Service (`services/emailService.js`)

```javascript
// Abstract over Nodemailer (dev) / Resend (production)
async function sendUpdateNotification(clientEmail, project, update) { ... }
async function sendPortalLink(clientEmail, project) { ... }
async function sendMilestoneStatusEmail(ownerEmail, project, status) { ... }
async function sendNotificationEmail(ownerEmail, type, message) { ... }
async function sendTeamInvite(email, workspace, inviteToken) { ... }  // Phase 4
```

---

## Phase 4 — Polish & Power Features
**Duration:** Weeks 19–26  
**Goal:** Branding, analytics, access control, team members, email templates, and project templates.

---

### Week 19–22 · Branding & Analytics

#### New routes

`PATCH /api/settings/branding`
- `protectRoute`
- Body: `{ brandColor, logoFile }`
- If logo file: upload to Cloudinary via `uploadService`, store URL on user document
- Update `user.brandColor`, `user.logoUrl`
- Return updated user

`GET /api/projects/:id/analytics`
- `protectRoute` + `ownerOnly`
- Aggregate: total update views, comment count, time-to-first-approval per milestone
- Return analytics object

#### Cron jobs (`services/cronService.js`)
- Weekly digest email: every Monday 08:00 — aggregate last-week stats per user, send summary
- Expired portal cleanup: daily — find projects where `expiresAt < now`, set `status: 'expired'`
- Use `node-cron` library

---

### Week 23–26 · Access Control & Team

#### Portal access control

`PATCH /api/projects/:id/set-password`
- `protectRoute` + `ownerOnly`
- Hash portal password with bcrypt
- Store as `project.passwordHash`

`POST /api/public/:slug/unlock`
- No auth
- Body: `{ password }`
- Compare against `project.passwordHash`
- On success: return short-lived portal access token (signed JWT, 1 hour, project-scoped)
- Client includes this token on subsequent public requests

`PATCH /api/projects/:id/expire`
- Set `expiresAt` to given date
- Set `isDeleted: true` to immediately disable

#### Team members

`POST /api/workspaces/invite`
- `protectRoute`
- Body: `{ email, role: 'member' | 'admin' }`
- Generate invite token (crypto.randomBytes), store hashed on user with expiry
- Send invite email with link `?inviteToken=...`
- Return `{ success: true }`

`POST /api/workspaces/accept-invite`
- No auth
- Body: `{ inviteToken, name, password }` (if new user) or `{ inviteToken }` (existing)
- Verify token, add user to workspace's `members[]` with role
- Return access token

---

## Phase 5 — Monetisation & Scale
**Duration:** Weeks 27–32  
**Goal:** Stripe billing, Redis caching, security hardening, and production deployment.

---

### Week 27–29 · Stripe Billing

#### Plan tiers

| Plan | Projects | Storage | Team Members | Branding |
|---|---|---|---|---|
| Free | 3 | 500 MB | Solo only | "Powered by" shown |
| Pro ($12/mo) | 25 | 5 GB | Up to 3 | Custom colours + logo |
| Agency ($29/mo) | Unlimited | 20 GB | Up to 15 | Full white-label |

#### Routes

`POST /api/billing/create-checkout`
- `protectRoute`
- Body: `{ priceId }` (Stripe Price ID for plan)
- Create or retrieve Stripe Customer for user
- Create Stripe Checkout Session with `success_url`, `cancel_url`
- Return `{ url }` for frontend redirect

`POST /api/billing/webhook`
- Raw body (no JSON parser — Stripe requires raw for signature verification)
- Verify webhook signature with `stripe.webhooks.constructEvent()`
- Handle events:
  - `checkout.session.completed` → update user plan, store `stripeSubscriptionId`
  - `customer.subscription.updated` → sync plan changes
  - `customer.subscription.deleted` → downgrade to free
- Return `{ received: true }`

`GET /api/billing/portal`
- `protectRoute`
- Create Stripe Customer Portal session
- Return `{ url }` for redirect

#### Plan enforcement middleware (`middleware/checkPlanLimits.js`)
- Check `req.user.plan` against resource counts before creating
- Example: before `POST /api/projects` → count user's projects, compare to plan limit
- Throw `ApiError(403, 'Project limit reached. Upgrade to Pro.')` if exceeded

---

### Week 30–32 · Performance, Security & Deploy

#### Redis caching

```javascript
// Cache public project endpoint (most-read, rarely-written)
// GET /api/public/:slug → cache for 60 seconds
// Invalidate cache on: new update posted, project settings changed

const redis = new Redis(process.env.REDIS_URL);

async function getCachedOrFetch(key, ttl, fetchFn) {
  const cached = await redis.get(key);
  if (cached) return JSON.parse(cached);
  const fresh = await fetchFn();
  await redis.set(key, JSON.stringify(fresh), 'EX', ttl);
  return fresh;
}
```

#### Security hardening checklist

- `express-mongo-sanitize` — prevent NoSQL injection (`$` and `.` in keys)
- `xss-clean` — sanitise HTML in request bodies
- `hpp` — HTTP parameter pollution prevention
- `helmet` — sets 11 security-related HTTP headers
- CORS restricted to explicit origin list (no wildcard in production)
- All ObjectIds validated as valid Mongoose ObjectIds before DB queries
- Rate limit authentication routes more aggressively: 10 req / 15 min
- Refresh tokens rotated on every use (detect theft via token reuse detection)
- File upload: validate MIME type server-side (not just extension)
- No stack traces in error responses in production (`NODE_ENV=production`)

#### Mongoose indexes (final list)
```javascript
// Add to each model after final schema confirmation
UserSchema.index({ email: 1 }, { unique: true });
ProjectSchema.index({ ownerId: 1, isDeleted: 1 });
ProjectSchema.index({ slug: 1 }, { unique: true });
UpdateSchema.index({ projectId: 1, isDeleted: 1, createdAt: -1 });
CommentSchema.index({ updateId: 1, createdAt: 1 });
NotificationSchema.index({ userId: 1, read: 1, createdAt: -1 });
FileSchema.index({ projectId: 1 });
```

#### Production deployment (Railway)
1. Set all environment variables in Railway dashboard
2. Add `Procfile`: `web: node server.js`
3. Configure `NODE_ENV=production`
4. Enable Railway health check endpoint: `GET /health → 200 OK`
5. Connect MongoDB Atlas IP whitelist to Railway outbound IPs
6. Set up Sentry DSN for error tracking
7. Configure log drain to external service (Papertrail or Logtail)

---

## Environment Variables Reference

```bash
# Server
PORT=5000
NODE_ENV=development

# Database
MONGO_URI=mongodb+srv://user:pass@cluster.mongodb.net/clientportal

# Auth
JWT_ACCESS_SECRET=long-random-string-access
JWT_REFRESH_SECRET=long-random-string-refresh
JWT_ACCESS_EXPIRY=15m
JWT_REFRESH_EXPIRY=7d

# Cloudinary
CLOUDINARY_CLOUD_NAME=...
CLOUDINARY_API_KEY=...
CLOUDINARY_API_SECRET=...

# Email
RESEND_API_KEY=...
EMAIL_FROM=noreply@yourdomain.com

# Frontend
CLIENT_URL=http://localhost:5173

# Redis (Phase 5)
REDIS_URL=redis://...

# Stripe (Phase 5)
STRIPE_SECRET_KEY=sk_...
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
| DELETE | /api/uploads/:id | JWT | 2 |
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

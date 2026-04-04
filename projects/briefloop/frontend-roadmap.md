# Client Update Portal — Frontend Roadmap
### Next.js 15 · App Router · TypeScript · Zustand · TanStack Query · Tailwind CSS v4

---

## Overview

| | |
|---|---|
| **Framework** | Next.js 15 (App Router) |
| **Language** | TypeScript 5.x (strict mode) |
| **Runtime** | Node.js 20 LTS |
| **Rendering** | RSC for reads · Server Actions for mutations · ISR for public portal · SSG for static |
| **Styling** | Tailwind CSS v4 |
| **Forms** | react-hook-form + zod |
| **Client State** | Zustand (auth token only — 1 store, ~50 lines) |
| **Client Data** | TanStack Query v5 (WebSocket-invalidated data only) |
| **Real-time** | Native WebSocket client hook (`"use client"`) |
| **Images** | `next/image` + ImageKit CDN URL params |
| **Toasts** | sonner |
| **Deployment** | Vercel |
| **Total Phases** | 5 |
| **Total Duration** | ~32 weeks |

---

## What Changed from Vite SPA

| Concern | Old (Vite SPA) | New (Next.js App Router) |
|---|---|---|
| Data reads | `useEffect` + Axios | RSC `async` component → `fetch()` Hono API |
| Mutations | Axios POST from client | Server Action → Hono API → `revalidateTag` |
| Auth state | TanStack Store | Zustand (token in memory, refresh in httpOnly cookie) |
| Client data cache | TanStack Query everywhere | TanStack Query only for WS-invalidated live data |
| Routing | React Router v7 | Next.js App Router (file = route, zero config) |
| Auth guard | Client-side `<ProtectedRoute>` | Edge `middleware.ts` — runs before page loads |
| Public portal `/p/:slug` | CSR (blank screen on load) | ISR + on-demand `revalidateTag` |
| Landing page `/` | CSR | SSG — built at deploy time |
| Dashboard pages | CSR + loading spinners | RSC → `loading.tsx` skeletons |
| HTTP client | Axios instance | Native `fetch()` — no library |
| File uploads | Server Actions | Direct `fetch()` to Hono (abortable — SA can't abort) |

---

## Rendering Model Per Route

```
app/
  page.tsx                       → SSG   landing page, built at deploy
  (auth)/
    login/page.tsx               → SSG   static form
    register/page.tsx            → SSG   static form
  (dashboard)/
    layout.tsx                   → RSC   sidebar shell — fetches user server-side
    dashboard/page.tsx           → RSC   fetch projects + stats server-side
    projects/page.tsx            → RSC   fetch project list
    projects/[id]/page.tsx       → RSC   fetch project + updates in parallel
    projects/[id]/settings/      → RSC   fetch project config
    notifications/page.tsx       → RSC   fetch notifications
    settings/page.tsx            → RSC   fetch user profile
    settings/billing/page.tsx    → RSC   fetch plan info
  p/
    [slug]/page.tsx              → ISR   revalidate:60 + on-demand revalidateTag
    [slug]/unlock/page.tsx       → SSG   static password form
```

---

## Monorepo Structure

The Hono backend is **completely independent**. The only shared artefact is `packages/types` — plain TypeScript interfaces with zero runtime code. Both `apps/server` and `apps/web` import from `@portal/types`. No tRPC, no shared runtime.

```
/ (root)
├── apps/
│   ├── server/                  # Hono backend — no changes except CORS origin
│   └── web/                     # Next.js 15 — this roadmap
├── packages/
│   └── types/                   # Shared TypeScript interfaces only
│       ├── src/
│       │   ├── models.ts
│       │   ├── api.ts
│       │   └── index.ts
│       ├── package.json
│       └── tsconfig.json
├── pnpm-workspace.yaml
├── turbo.json
└── package.json
```

```yaml
# pnpm-workspace.yaml
packages:
  - 'apps/*'
  - 'packages/*'
```

### Shared types package

```typescript
// packages/types/src/models.ts
export type ProjectStatus  = 'active' | 'on-hold' | 'in-review' | 'completed'
export type MilestoneStatus = 'pending' | 'approved' | 'revision'
export type UserPlan       = 'free' | 'pro' | 'agency'

export interface User {
  id: string
  name: string
  email: string
  plan: UserPlan
  brandColor: string
  logoUrl?: string
}

export interface Project {
  _id: string
  ownerId: string
  title: string
  description?: string
  slug: string
  status: ProjectStatus
  clientEmail?: string
  clientLastSeen?: string
  viewCount: number
  expiresAt?: string
  createdAt: string
  updatedAt: string
}

export interface FileRef {
  url: string
  fileId: string
  name: string
  size: number
  mimeType: string
}

export interface Update {
  _id: string
  projectId: string
  authorId: string
  content: string
  type: 'text' | 'file' | 'milestone'
  isMilestone: boolean
  milestoneStatus: MilestoneStatus
  files: FileRef[]
  viewCount: number
  createdAt: string
}

export interface Comment {
  _id: string
  updateId: string
  authorName: string
  authorEmail: string
  body: string
  type: 'comment' | 'approval' | 'revision'
  createdAt: string
}

export interface Notification {
  _id: string
  type: 'client_viewed' | 'comment_added' | 'milestone_approved' | 'milestone_revision'
  message: string
  read: boolean
  refId: string
  refType: 'Project' | 'Update' | 'Comment'
  createdAt: string
}
```

```typescript
// packages/types/src/api.ts
export interface ApiResponse<T> {
  success: boolean
  data: T
  message?: string
}

export interface PaginatedResponse<T> extends ApiResponse<T[]> {
  pagination: { page: number; limit: number; total: number; hasMore: boolean }
}
```

```json
// packages/types/package.json
{
  "name": "@portal/types",
  "version": "1.0.0",
  "exports": { ".": "./src/index.ts" }
}
```

---

## App Folder Structure

```
apps/web/
├── src/
│   ├── app/
│   │   ├── layout.tsx                      # Root layout — fonts, Providers
│   │   ├── page.tsx                        # Landing (SSG)
│   │   ├── not-found.tsx
│   │   ├── error.tsx
│   │   ├── (auth)/
│   │   │   ├── login/page.tsx
│   │   │   └── register/page.tsx
│   │   ├── (dashboard)/
│   │   │   ├── layout.tsx                  # RSC — fetches user, renders sidebar
│   │   │   ├── dashboard/
│   │   │   │   ├── page.tsx
│   │   │   │   └── loading.tsx
│   │   │   ├── projects/
│   │   │   │   ├── page.tsx
│   │   │   │   ├── loading.tsx
│   │   │   │   └── [id]/
│   │   │   │       ├── page.tsx
│   │   │   │       ├── loading.tsx
│   │   │   │       └── settings/page.tsx
│   │   │   ├── notifications/
│   │   │   │   ├── page.tsx
│   │   │   │   └── loading.tsx
│   │   │   └── settings/
│   │   │       ├── page.tsx
│   │   │       └── billing/page.tsx
│   │   └── p/
│   │       └── [slug]/
│   │           ├── page.tsx                # ISR public portal
│   │           ├── loading.tsx
│   │           └── unlock/page.tsx         # SSG password gate
│   ├── actions/                            # Server Actions — mutations only
│   │   ├── auth.actions.ts
│   │   ├── project.actions.ts
│   │   ├── update.actions.ts
│   │   ├── comment.actions.ts
│   │   ├── notification.actions.ts
│   │   └── billing.actions.ts
│   ├── components/
│   │   ├── layout/
│   │   │   ├── Sidebar.tsx                 # "use client" — active link state
│   │   │   ├── Topbar.tsx                  # "use client" — notification bell
│   │   │   └── PublicLayout.tsx
│   │   ├── ui/
│   │   │   ├── Button.tsx
│   │   │   ├── Input.tsx
│   │   │   ├── Modal.tsx                   # "use client"
│   │   │   ├── Badge.tsx
│   │   │   ├── Spinner.tsx
│   │   │   └── EmptyState.tsx
│   │   ├── auth/
│   │   │   ├── LoginForm.tsx               # "use client" + useActionState
│   │   │   └── RegisterForm.tsx
│   │   ├── project/
│   │   │   ├── ProjectCard.tsx
│   │   │   ├── ProjectStatusBadge.tsx
│   │   │   └── CreateProjectForm.tsx       # "use client" + useActionState
│   │   ├── update/
│   │   │   ├── UpdateCard.tsx
│   │   │   ├── UpdateComposer.tsx          # "use client" — form + file upload
│   │   │   ├── UpdateTimeline.tsx
│   │   │   ├── MilestoneBadge.tsx
│   │   │   └── FileAttachment.tsx
│   │   ├── comment/
│   │   │   ├── CommentThread.tsx           # "use client" — TanStack Query
│   │   │   └── GuestCommentForm.tsx        # "use client" + useActionState
│   │   ├── notifications/
│   │   │   ├── NotificationBell.tsx        # "use client" — Zustand + WS
│   │   │   └── NotificationItem.tsx
│   │   └── Providers.tsx                   # "use client" — TQ + Zustand bootstrap
│   ├── hooks/
│   │   ├── useWebSocket.ts                 # WS singleton, dispatches TQ invalidations
│   │   ├── useComments.ts                  # TanStack Query — WS invalidated
│   │   └── useUpload.ts                    # Direct fetch to Hono — abortable
│   ├── lib/
│   │   ├── api.ts                          # fetch() wrapper — server-side only
│   │   ├── queryClient.ts                  # TanStack Query client singleton
│   │   └── websocket.ts                    # WS singleton (client-side)
│   ├── stores/
│   │   └── authStore.ts                    # Zustand — token + user only
│   └── middleware.ts                       # Edge auth guard
├── next.config.ts
├── tailwind.config.ts
├── tsconfig.json
└── package.json
```

---

## TypeScript Configuration

```jsonc
// tsconfig.json
{
  "compilerOptions": {
    "target": "ES2022",
    "lib": ["ES2022", "DOM", "DOM.Iterable"],
    "module": "ESNext",
    "moduleResolution": "Bundler",
    "jsx": "preserve",
    "strict": true,
    "strictNullChecks": true,
    "noUncheckedIndexedAccess": true,
    "exactOptionalPropertyTypes": true,
    "noImplicitReturns": true,
    "skipLibCheck": true,
    "baseUrl": ".",
    "paths": {
      "@/*": ["./src/*"],
      "@portal/types": ["../../packages/types/src/index.ts"]
    },
    "plugins": [{ "name": "next" }]
  },
  "include": ["next-env.d.ts", "**/*.ts", "**/*.tsx", ".next/types/**/*.ts"],
  "exclude": ["node_modules"]
}
```

```typescript
// next.config.ts
import type { NextConfig } from 'next'

const config: NextConfig = {
  experimental: {
    typedRoutes: true,          // compile-time check on all <Link href>
  },
  images: {
    remotePatterns: [
      { protocol: 'https', hostname: 'ik.imagekit.io' },
    ],
  },
}

export default config
```

---

## Core Patterns

### 1. Server-side fetch helper (`lib/api.ts`)

```typescript
// lib/api.ts — runs on server only (RSC pages + Server Actions)
import { cookies } from 'next/headers'

const API_URL = process.env.HONO_API_URL!  // server-only, never in browser

interface FetchOptions extends RequestInit {
  tags?: string[]
  revalidate?: number | false
}

export async function apiFetch<T>(
  path: string,
  options: FetchOptions = {}
): Promise<T> {
  const { tags, revalidate, ...init } = options
  const cookieStore = await cookies()
  const token = cookieStore.get('accessToken')?.value

  const res = await fetch(`${API_URL}${path}`, {
    ...init,
    headers: {
      'Content-Type': 'application/json',
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      ...init.headers,
    },
    next: {
      ...(tags     ? { tags }       : {}),
      ...(revalidate !== undefined ? { revalidate } : {}),
    },
  })

  if (!res.ok) {
    const err = await res.json().catch(() => ({ message: 'Request failed' }))
    throw new Error((err as { message?: string }).message ?? 'Request failed')
  }

  return res.json() as Promise<T>
}
```

### 2. RSC page pattern

```typescript
// app/(dashboard)/projects/page.tsx
import { apiFetch } from '@/lib/api'
import { ProjectCard } from '@/components/project/ProjectCard'
import { CreateProjectForm } from '@/components/project/CreateProjectForm'
import type { ApiResponse, Project } from '@portal/types'

export default async function ProjectListPage() {
  const { data: projects } = await apiFetch<ApiResponse<Project[]>>(
    '/api/projects',
    { tags: ['projects'] }
  )

  return (
    <div className="space-y-4">
      <CreateProjectForm />   {/* "use client" island */}
      <div className="grid gap-4">
        {projects.map((p) => (
          <ProjectCard key={p._id} project={p} />
        ))}
      </div>
    </div>
  )
}
```

```typescript
// app/(dashboard)/projects/loading.tsx
export default function Loading() {
  return (
    <div className="grid gap-4">
      {Array.from({ length: 3 }).map((_, i) => (
        <div key={i} className="h-24 rounded-lg bg-surface animate-pulse" />
      ))}
    </div>
  )
}
```

### 3. Server Action pattern

```typescript
// actions/project.actions.ts
'use server'
import { revalidateTag } from 'next/cache'
import { redirect } from 'next/navigation'
import { apiFetch } from '@/lib/api'
import { z } from 'zod'
import type { ApiResponse, Project } from '@portal/types'

const createProjectSchema = z.object({
  title:       z.string().min(2).max(150),
  description: z.string().max(1000).optional(),
  clientEmail: z.string().email().optional(),
})

export type ProjectActionState = {
  error?: string
  fieldErrors?: Record<string, string[]>
}

export async function createProject(
  _prev: ProjectActionState,
  formData: FormData
): Promise<ProjectActionState> {
  const parsed = createProjectSchema.safeParse(Object.fromEntries(formData))
  if (!parsed.success) return { fieldErrors: parsed.error.flatten().fieldErrors }

  try {
    await apiFetch<ApiResponse<Project>>('/api/projects', {
      method: 'POST',
      body: JSON.stringify(parsed.data),
    })
    revalidateTag('projects')   // RSC page refetches fresh data
    return {}
  } catch (err) {
    return { error: err instanceof Error ? err.message : 'Failed to create project' }
  }
}

export async function deleteProject(projectId: string): Promise<void> {
  await apiFetch(`/api/projects/${projectId}`, { method: 'DELETE' })
  revalidateTag('projects')
  redirect('/projects')
}
```

```typescript
// components/project/CreateProjectForm.tsx
'use client'
import { useActionState } from 'react'
import { createProject, type ProjectActionState } from '@/actions/project.actions'

export function CreateProjectForm() {
  const [state, action, isPending] = useActionState<ProjectActionState, FormData>(
    createProject,
    {}
  )

  return (
    <form action={action} className="space-y-3">
      <input name="title" placeholder="Project title" className="input w-full" />
      {state.fieldErrors?.title && (
        <p className="text-sm text-red-500">{state.fieldErrors.title[0]}</p>
      )}
      {state.error && <p className="text-sm text-red-500">{state.error}</p>}
      <button type="submit" disabled={isPending} className="btn-primary">
        {isPending ? 'Creating…' : 'New Project'}
      </button>
    </form>
  )
}
```

### 4. ISR public portal

```typescript
// app/p/[slug]/page.tsx
import { apiFetch } from '@/lib/api'
import type { ApiResponse, Project, Update } from '@portal/types'
import { notFound } from 'next/navigation'
import type { Metadata } from 'next'
import { UpdateTimeline } from '@/components/update/UpdateTimeline'
import { CommentThread } from '@/components/comment/CommentThread'

interface Props { params: Promise<{ slug: string }> }

export const revalidate = 60   // passive: refresh every 60s
// Active: revalidateTag(`portal:${slug}`) fires in update.actions.ts when provider posts

export async function generateMetadata({ params }: Props): Promise<Metadata> {
  const { slug } = await params
  try {
    const res = await apiFetch<ApiResponse<{ project: Project; updates: Update[] }>>(
      `/api/public/${slug}`,
      { tags: [`portal:${slug}`] }
    )
    return { title: res.data.project.title }
  } catch {
    return { title: 'Project Portal' }
  }
}

export default async function ClientPortalPage({ params }: Props) {
  const { slug } = await params

  let project: Project
  let updates: Update[]

  try {
    const res = await apiFetch<ApiResponse<{ project: Project; updates: Update[] }>>(
      `/api/public/${slug}`,
      { tags: [`portal:${slug}`] }
    )
    project = res.data.project
    updates = res.data.updates
  } catch {
    notFound()
  }

  return (
    <main>
      <header
        className="px-6 py-4"
        style={{ background: project.brandColor ?? '#6366f1' }}
      >
        <h1 className="text-white text-xl font-bold">{project.title}</h1>
      </header>
      <div className="max-w-3xl mx-auto py-8 px-4 space-y-6">
        <UpdateTimeline updates={updates} />
        <CommentThread projectSlug={slug} />  {/* "use client" — TanStack Query */}
      </div>
    </main>
  )
}
```

```typescript
// actions/update.actions.ts — on-demand ISR bust
'use server'
import { revalidateTag } from 'next/cache'

export async function createUpdate(_prev: unknown, formData: FormData) {
  const projectId = formData.get('projectId') as string
  const slug      = formData.get('slug') as string

  await apiFetch(`/api/projects/${projectId}/updates`, {
    method: 'POST',
    body: JSON.stringify(Object.fromEntries(formData)),
  })

  revalidateTag(`updates:${projectId}`)
  revalidateTag(`portal:${slug}`)   // client portal ISR page refreshes immediately
  return {}
}
```

### 5. Edge middleware auth guard

```typescript
// src/middleware.ts
import { type NextRequest, NextResponse } from 'next/server'

const PROTECTED = ['/dashboard', '/projects', '/notifications', '/settings']
const AUTH_ONLY  = ['/login', '/register']

export function middleware(req: NextRequest) {
  const token      = req.cookies.get('accessToken')?.value
  const { pathname } = req.nextUrl

  const isProtected = PROTECTED.some((p) => pathname.startsWith(p))
  const isAuthOnly  = AUTH_ONLY.some((p) => pathname.startsWith(p))

  if (isProtected && !token) {
    return NextResponse.redirect(new URL('/login', req.url))
  }
  if (isAuthOnly && token) {
    return NextResponse.redirect(new URL('/dashboard', req.url))
  }

  return NextResponse.next()
}

export const config = {
  // Skip Next.js internals, static files, public portal
  matcher: ['/((?!_next/static|_next/image|favicon.ico|p/).*)'],
}
```

### 6. Zustand auth store

```typescript
// stores/authStore.ts
import { create } from 'zustand'
import type { User } from '@portal/types'

interface AuthState {
  user:         User | null
  accessToken:  string
  setAuth:      (user: User, token: string) => void
  clearAuth:    () => void
}

export const useAuthStore = create<AuthState>()((set) => ({
  user:        null,
  accessToken: '',
  setAuth:     (user, accessToken) => set({ user, accessToken }),
  clearAuth:   () => set({ user: null, accessToken: '' }),
}))
```

### 7. TanStack Query — WS-invalidated data only

```typescript
// hooks/useComments.ts
'use client'
import { useQuery, useQueryClient } from '@tanstack/react-query'
import type { Comment } from '@portal/types'

export function useComments(projectSlug: string) {
  const qc = useQueryClient()

  const query = useQuery({
    queryKey: ['comments', projectSlug],
    queryFn: () =>
      fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/public/${projectSlug}/comments`)
        .then((r) => r.json())
        .then((r) => r.data as Comment[]),
    staleTime: 0,
  })

  const invalidate = () =>
    qc.invalidateQueries({ queryKey: ['comments', projectSlug] })

  return { ...query, invalidate }
}
```

```typescript
// hooks/useWebSocket.ts
'use client'
import { useEffect, useRef } from 'react'
import { useQueryClient } from '@tanstack/react-query'
import { useAuthStore } from '@/stores/authStore'
import { toast } from 'sonner'

type WSMessage =
  | { event: 'comment_added';      payload: { projectSlug: string } }
  | { event: 'client_viewed';      payload: { projectId: string } }
  | { event: 'milestone_approved'; payload: { projectId: string } }
  | { event: 'milestone_revision'; payload: { projectId: string } }

export function useWebSocket() {
  const token = useAuthStore((s) => s.accessToken)
  const qc    = useQueryClient()
  const wsRef = useRef<WebSocket | null>(null)

  useEffect(() => {
    if (!token) return

    const ws = new WebSocket(`${process.env.NEXT_PUBLIC_WS_URL}?token=${token}`)
    wsRef.current = ws

    ws.onmessage = (e: MessageEvent<string>) => {
      const msg = JSON.parse(e.data) as WSMessage
      switch (msg.event) {
        case 'comment_added':
          qc.invalidateQueries({ queryKey: ['comments', msg.payload.projectSlug] })
          break
        case 'client_viewed':
          qc.invalidateQueries({ queryKey: ['projects'] })
          toast.info('Client viewed the portal')
          break
        case 'milestone_approved':
          qc.invalidateQueries({ queryKey: ['projects'] })
          toast.success('Milestone approved!')
          break
        case 'milestone_revision':
          qc.invalidateQueries({ queryKey: ['projects'] })
          toast.warning('Revision requested')
          break
      }
    }

    return () => ws.close()
  }, [token, qc])
}
```

### 8. File upload — direct to Hono (abortable)

```typescript
// hooks/useUpload.ts
'use client'
// Server Actions cannot be aborted — multi-file uploads MUST go direct to Hono
import { useState, useRef } from 'react'
import { useAuthStore } from '@/stores/authStore'
import type { FileRef } from '@portal/types'

export function useUpload() {
  const [uploading, setUploading] = useState(false)
  const controllerRef = useRef<AbortController | null>(null)
  const token = useAuthStore((s) => s.accessToken)

  const upload = async (files: File[]): Promise<FileRef[]> => {
    const controller = new AbortController()
    controllerRef.current = controller
    setUploading(true)

    const fd = new FormData()
    files.forEach((f) => fd.append('files', f))

    const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/uploads`, {
      method: 'POST',
      headers: { Authorization: `Bearer ${token}` },
      body: fd,
      signal: controller.signal,
    })

    setUploading(false)
    const json = await res.json()
    return json.data as FileRef[]
  }

  const cancel = () => {
    controllerRef.current?.abort()
    setUploading(false)
  }

  return { upload, cancel, uploading }
}
```

---

## Phase 1 — Foundation & Auth
**Duration:** Weeks 1–4
**Goal:** Next.js 15 scaffold, monorepo, edge middleware, login/register Server Actions, dashboard RSC shell.

---

### Week 1–2 · Scaffold

```bash
# Root monorepo
pnpm init
pnpm add -D turbo typescript

# Shared types
mkdir -p packages/types/src

# Next.js app
cd apps
npx create-next-app@latest web \
  --typescript --tailwind --app --src-dir \
  --no-eslint --import-alias "@/*"

cd web

# Core
pnpm add zustand @tanstack/react-query sonner dayjs clsx tailwind-merge

# Forms + validation
pnpm add react-hook-form zod @hookform/resolvers

# Link shared types workspace package
pnpm add @portal/types --workspace
```

```typescript
// app/layout.tsx
import type { Metadata } from 'next'
import { Geist } from 'next/font/google'
import { Toaster } from 'sonner'
import { Providers } from '@/components/Providers'
import './globals.css'

const font = Geist({ subsets: ['latin'] })

export const metadata: Metadata = {
  title: { default: 'Client Portal', template: '%s | Client Portal' },
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en">
      <body className={font.className}>
        <Providers>
          {children}
          <Toaster position="top-right" richColors />
        </Providers>
      </body>
    </html>
  )
}
```

```typescript
// components/Providers.tsx
'use client'
import { QueryClientProvider } from '@tanstack/react-query'
import { queryClient } from '@/lib/queryClient'

export function Providers({ children }: { children: React.ReactNode }) {
  return (
    <QueryClientProvider client={queryClient}>{children}</QueryClientProvider>
  )
}
```

---

### Week 3–4 · Auth

```typescript
// actions/auth.actions.ts
'use server'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'
import { z } from 'zod'

const loginSchema = z.object({
  email:    z.string().email(),
  password: z.string().min(1),
})

export type AuthState = { error?: string; fieldErrors?: Record<string, string[]> }

export async function loginAction(
  _prev: AuthState,
  formData: FormData
): Promise<AuthState> {
  const parsed = loginSchema.safeParse(Object.fromEntries(formData))
  if (!parsed.success) return { fieldErrors: parsed.error.flatten().fieldErrors }

  const res = await fetch(`${process.env.HONO_API_URL}/api/auth/login`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(parsed.data),
  })

  if (!res.ok) {
    const err = await res.json()
    return { error: (err as { message?: string }).message ?? 'Invalid credentials' }
  }

  const { accessToken } = await res.json() as { accessToken: string }
  const jar = await cookies()

  jar.set('accessToken', accessToken, {
    httpOnly: true,
    secure:   process.env.NODE_ENV === 'production',
    sameSite: 'lax',
    maxAge:   15 * 60,
    path:     '/',
  })

  redirect('/dashboard')
}

export async function logoutAction(): Promise<void> {
  const jar = await cookies()
  jar.delete('accessToken')
  redirect('/login')
}
```

```typescript
// app/(dashboard)/layout.tsx
import { apiFetch } from '@/lib/api'
import { Sidebar } from '@/components/layout/Sidebar'
import { Topbar } from '@/components/layout/Topbar'
import { redirect } from 'next/navigation'
import type { ApiResponse, User } from '@portal/types'

export default async function DashboardLayout({
  children,
}: {
  children: React.ReactNode
}) {
  let user: User

  try {
    const res = await apiFetch<ApiResponse<User>>('/api/auth/me', { tags: ['user'] })
    user = res.data
  } catch {
    redirect('/login')
  }

  return (
    <div className="flex h-screen bg-bg">
      <Sidebar user={user} />
      <div className="flex flex-col flex-1 overflow-hidden">
        <Topbar user={user} />
        <main className="flex-1 overflow-y-auto p-6">{children}</main>
      </div>
    </div>
  )
}
```

---

## Phase 2 — Core Update Engine
**Duration:** Weeks 5–10
**Goal:** Project CRUD (RSC + Server Actions), update timeline, file uploads direct to Hono, ISR public portal.

---

### Week 5–7 · Projects

```typescript
// app/(dashboard)/projects/[id]/page.tsx
import { apiFetch } from '@/lib/api'
import { UpdateTimeline } from '@/components/update/UpdateTimeline'
import { UpdateComposer } from '@/components/update/UpdateComposer'
import type { ApiResponse, Project, Update } from '@portal/types'
import { notFound } from 'next/navigation'

interface Props { params: Promise<{ id: string }> }

export default async function ProjectDetailPage({ params }: Props) {
  const { id } = await params

  // Parallel fetches — RSC runs these concurrently, no waterfall
  const [projectRes, updatesRes] = await Promise.all([
    apiFetch<ApiResponse<Project>>(`/api/projects/${id}`, {
      tags: ['projects', `project:${id}`],
    }),
    apiFetch<ApiResponse<Update[]>>(`/api/projects/${id}/updates`, {
      tags: [`updates:${id}`],
    }),
  ])

  if (!projectRes.data) notFound()

  return (
    <div className="space-y-6">
      <h1 className="text-2xl font-bold">{projectRes.data.title}</h1>
      <UpdateComposer projectId={id} slug={projectRes.data.slug} />
      <UpdateTimeline updates={updatesRes.data} />
    </div>
  )
}
```

### Week 8–10 · File upload composer

```typescript
// components/update/UpdateComposer.tsx
'use client'
import { useActionState, useState } from 'react'
import { useUpload } from '@/hooks/useUpload'
import { createUpdate } from '@/actions/update.actions'
import type { FileRef } from '@portal/types'

interface Props { projectId: string; slug: string }

export function UpdateComposer({ projectId, slug }: Props) {
  const [state, action, isPending] = useActionState(createUpdate, {})
  const { upload, cancel, uploading } = useUpload()
  const [uploadedFiles, setUploadedFiles] = useState<FileRef[]>([])

  const handleFiles = async (e: React.ChangeEvent<HTMLInputElement>) => {
    const files = Array.from(e.target.files ?? [])
    if (!files.length) return
    const refs = await upload(files)
    setUploadedFiles((prev) => [...prev, ...refs])
  }

  return (
    <form action={action} className="space-y-3 rounded-lg border p-4">
      <input type="hidden" name="projectId" value={projectId} />
      <input type="hidden" name="slug"      value={slug} />
      <input type="hidden" name="files"     value={JSON.stringify(uploadedFiles)} />
      <textarea name="content" placeholder="Write an update…" className="input w-full" rows={3} />
      <div className="flex gap-2 items-center">
        <input type="file" multiple onChange={handleFiles} disabled={uploading} />
        {uploading && <button type="button" onClick={cancel}>Cancel</button>}
        <button type="submit" disabled={isPending || uploading} className="btn-primary ml-auto">
          {isPending ? 'Posting…' : 'Post Update'}
        </button>
      </div>
      {state.error && <p className="text-sm text-red-500">{state.error}</p>}
    </form>
  )
}
```

---

## Phase 3 — Collaboration Layer
**Duration:** Weeks 11–18
**Goal:** Comments (TanStack Query + WS), WebSocket hook wired to Zustand/TQ, notification bell.

Full patterns covered in Core Patterns section above (`useComments`, `useWebSocket`, `CommentThread`).

---

## Phase 4 — Polish & Power Features
**Duration:** Weeks 19–26
**Goal:** Branding (logo upload via Hono, `next/image`), analytics RSC with Recharts, portal access control.

```typescript
// app/(dashboard)/settings/page.tsx — logo via next/image + IK URL params
import Image from 'next/image'
import { apiFetch } from '@/lib/api'
import { BrandingForm } from '@/components/settings/BrandingForm'
import type { ApiResponse, User } from '@portal/types'

export default async function SettingsPage() {
  const { data: user } = await apiFetch<ApiResponse<User>>('/api/auth/me', {
    tags: ['user'],
  })

  return (
    <div className="space-y-8">
      {user.logoUrl && (
        // ImageKit transformation appended to URL — no SDK needed client-side
        <Image
          src={`${user.logoUrl}?tr=w-80,h-80,f-webp,q-80`}
          alt="Brand logo"
          width={80} height={80}
          className="rounded-lg"
        />
      )}
      <BrandingForm currentColor={user.brandColor} />
    </div>
  )
}
```

```typescript
// app/(dashboard)/projects/[id]/page.tsx — analytics parallel fetch (Phase 4 addition)
const [projectRes, updatesRes, analyticsRes] = await Promise.all([
  apiFetch<ApiResponse<Project>>(`/api/projects/${id}`,          { tags: [`project:${id}`] }),
  apiFetch<ApiResponse<Update[]>>(`/api/projects/${id}/updates`, { tags: [`updates:${id}`] }),
  apiFetch<ApiResponse<AnalyticsData>>(`/api/projects/${id}/analytics`, { tags: [`analytics:${id}`] }),
])

// Recharts is "use client" — receives typed data as props from RSC
<AnalyticsChart data={analyticsRes.data} />
```

---

## Phase 5 — Monetisation & Scale
**Duration:** Weeks 27–32
**Goal:** Stripe via Server Actions, plan gates, production deploy.

```typescript
// actions/billing.actions.ts
'use server'
import { redirect } from 'next/navigation'
import { apiFetch } from '@/lib/api'

export async function createCheckout(priceId: string): Promise<never> {
  const res = await apiFetch<{ data: { url: string } }>('/api/billing/create-checkout', {
    method: 'POST',
    body: JSON.stringify({ priceId }),
  })
  redirect(res.data.url)
}

export async function openBillingPortal(): Promise<never> {
  const res = await apiFetch<{ data: { url: string } }>('/api/billing/portal')
  redirect(res.data.url)
}
```

```typescript
// app/(dashboard)/settings/billing/page.tsx
// No client JS needed — Server Actions handle the redirect to Stripe
import { createCheckout, openBillingPortal } from '@/actions/billing.actions'
import { apiFetch } from '@/lib/api'
import type { ApiResponse, User } from '@portal/types'

export default async function BillingPage() {
  const { data: user } = await apiFetch<ApiResponse<User>>('/api/auth/me', { tags: ['user'] })

  return (
    <div className="space-y-6">
      <p>Current plan: <strong className="capitalize">{user.plan}</strong></p>

      {user.plan === 'free' && (
        <form action={createCheckout.bind(null, process.env.NEXT_PUBLIC_PRO_PRICE_ID!)}>
          <button type="submit" className="btn-primary">Upgrade to Pro</button>
        </form>
      )}

      <form action={openBillingPortal}>
        <button type="submit" className="btn-secondary">Manage subscription</button>
      </form>
    </div>
  )
}
```

---

## Environment Variables

```bash
# apps/web/.env.local

# Server-only — never sent to browser (no NEXT_PUBLIC_ prefix)
HONO_API_URL=http://localhost:5000

# Browser-accessible
NEXT_PUBLIC_API_URL=http://localhost:5000
NEXT_PUBLIC_WS_URL=ws://localhost:5000/ws
NEXT_PUBLIC_PRO_PRICE_ID=price_...
NEXT_PUBLIC_AGENCY_PRICE_ID=price_...
```

> Only `NEXT_PUBLIC_*` vars reach the browser. `HONO_API_URL` is server-only and never exposed.

---

## Hono Backend Changes Required (minimal)

The Hono server stays architecturally unchanged. Only two additions needed:

```typescript
// server/src/app.ts — add Next.js origin to CORS
app.use('*', cors({
  origin: [
    process.env.CLIENT_URL!,                 // was: http://localhost:5173
    process.env.NEXT_PUBLIC_WEB_URL ?? '',   // add: http://localhost:3000
  ],
  credentials: true,
  allowMethods: ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
}))
```

```bash
# server/.env — add Next.js origin
NEXT_WEB_URL=http://localhost:3000    # dev
# NEXT_WEB_URL=https://yourdomain.com # prod
```

That is the **only change to the backend**. No routes change. No auth changes. No models change.

---

## Production Checklist

- `HONO_API_URL` in Vercel env vars — server-only, never `NEXT_PUBLIC_`
- `typedRoutes: true` — CI fails on invalid `<Link href>`
- `tsc --noEmit` runs in CI (`turbo run type-check`)
- `next/image` remotePatterns includes `ik.imagekit.io`
- Hono CORS whitelist includes `https://yourdomain.com`
- `middleware.ts` matcher excludes `_next/static`, `_next/image`, `p/` (public portal)
- Vercel: zero config — App Router handles all routing, no `vercel.json` needed

---

## What Was Removed vs Old Vite Plan

| Removed | Replaced with | Reason |
|---|---|---|
| `axios` | `fetch()` native | RSC + Server Actions use native fetch — no library overhead |
| `react-router-dom` | Next.js App Router | File = route, zero config |
| `@tanstack/store` | `zustand` | One store, 50 lines, 330× more community support |
| TanStack Query everywhere | RSC reads + TQ for WS only | RSC eliminates client-side data fetching for server data |
| `vite.config.ts` | `next.config.ts` | Next.js handles bundling, SSR, ISR |
| `imagekitio-react` | `next/image` + IK URL params | `next/image` is superior, IK transforms via URL query string |
| `<ProtectedRoute>` component | `middleware.ts` edge guard | Runs before page load — no flash of protected content |
| loading spinners | `loading.tsx` + RSC streaming | Skeleton shown instantly, no JS-driven spinner |
| `nodemon.json` | `next dev` | Next.js has built-in dev server with HMR |

---

## Pages Summary

| Page | Route | Rendering | Auth |
|---|---|---|---|
| Landing | `/` | SSG | public |
| Register | `/register` | SSG | public |
| Login | `/login` | SSG | public |
| Dashboard | `/dashboard` | RSC | JWT cookie |
| Project List | `/projects` | RSC | JWT cookie |
| Project Detail | `/projects/[id]` | RSC | JWT cookie |
| Project Settings | `/projects/[id]/settings` | RSC | JWT cookie |
| Notifications | `/notifications` | RSC | JWT cookie |
| Settings | `/settings` | RSC | JWT cookie |
| Billing | `/settings/billing` | RSC | JWT cookie |
| Client Portal | `/p/[slug]` | ISR (60s + on-demand) | public |
| Portal Unlock | `/p/[slug]/unlock` | SSG | public |

# Client Update Portal — Frontend Roadmap
### TypeScript · React 19 · TanStack Store · TanStack Query · ImageKit · Tailwind CSS

---

## Overview

| | |
|---|---|
| **Framework** | React 19 (stable) |
| **Language** | TypeScript 5.x (strict mode) |
| **Build Tool** | Vite 5 |
| **Routing** | React Router v7 (or TanStack Router v1) |
| **Global State** | TanStack Store |
| **Server State** | TanStack Query v5 |
| **Styling** | Tailwind CSS v3 |
| **Forms** | react-hook-form + zod |
| **HTTP** | Axios with interceptors |
| **Real-time** | Native WebSocket (Hono WS) |
| **Images** | ImageKit React SDK (`imagekitio-react`) |
| **Notifications** | sonner (toast library) |
| **Charts** | Recharts (Phase 4) |
| **Deployment** | Vercel |
| **Total Phases** | 5 |
| **Total Duration** | ~32 weeks |

---

## React 19 Key Changes Leveraged

| Feature | How we use it |
|---|---|
| `use()` hook | Unwrap promises and context in render — data fetching in Suspense |
| Actions | Form submissions as async functions — no manual `isPending` state |
| `useActionState` | Form state + errors from server actions |
| `useOptimistic` | Optimistic UI for posting updates without TanStack Query mutation boilerplate |
| `useTransition` | Wrap non-urgent state updates (filter changes, search) |
| `ref` as prop | No more `forwardRef` wrapper on components |
| Improved Suspense | Sibling components no longer throttle each other |

---

## Folder Structure

```
/client
├── public/
│   └── favicon.svg
├── src/
│   ├── api/
│   │   ├── axios.ts              # Axios instance + interceptors
│   │   ├── auth.api.ts
│   │   ├── project.api.ts
│   │   ├── update.api.ts
│   │   ├── comment.api.ts
│   │   ├── upload.api.ts
│   │   └── notification.api.ts
│   ├── components/
│   │   ├── layout/
│   │   │   ├── AppLayout.tsx
│   │   │   ├── Sidebar.tsx
│   │   │   ├── Topbar.tsx
│   │   │   └── PublicLayout.tsx
│   │   ├── ui/
│   │   │   ├── Button.tsx
│   │   │   ├── Input.tsx
│   │   │   ├── Modal.tsx
│   │   │   ├── Badge.tsx
│   │   │   ├── Avatar.tsx
│   │   │   ├── Spinner.tsx
│   │   │   ├── EmptyState.tsx
│   │   │   └── ProgressBar.tsx
│   │   ├── project/
│   │   │   ├── ProjectCard.tsx
│   │   │   ├── ProjectStatusBadge.tsx
│   │   │   └── CreateProjectModal.tsx
│   │   ├── update/
│   │   │   ├── UpdateCard.tsx
│   │   │   ├── UpdateComposer.tsx
│   │   │   ├── UpdateTimeline.tsx
│   │   │   ├── MilestoneBadge.tsx
│   │   │   └── FileAttachment.tsx
│   │   ├── comment/
│   │   │   ├── CommentThread.tsx
│   │   │   └── GuestCommentForm.tsx
│   │   └── notifications/
│   │       ├── NotificationBell.tsx
│   │       └── NotificationItem.tsx
│   ├── pages/
│   │   ├── auth/
│   │   │   ├── RegisterPage.tsx
│   │   │   └── LoginPage.tsx
│   │   ├── dashboard/
│   │   │   └── DashboardPage.tsx
│   │   ├── projects/
│   │   │   ├── ProjectListPage.tsx
│   │   │   ├── ProjectDetailPage.tsx
│   │   │   └── ProjectSettingsPage.tsx
│   │   ├── portal/
│   │   │   ├── ClientPortalPage.tsx
│   │   │   └── PortalUnlockPage.tsx
│   │   ├── notifications/
│   │   │   └── NotificationsPage.tsx
│   │   ├── settings/
│   │   │   ├── SettingsPage.tsx
│   │   │   └── BillingPage.tsx
│   │   └── LandingPage.tsx
│   ├── stores/
│   │   ├── authStore.ts          # TanStack Store
│   │   └── notificationStore.ts  # TanStack Store
│   ├── hooks/
│   │   ├── useProjects.ts        # TanStack Query hooks
│   │   ├── useUpdates.ts
│   │   ├── useComments.ts
│   │   ├── useWebSocket.ts
│   │   └── useUpload.ts
│   ├── lib/
│   │   ├── queryClient.ts        # TanStack Query client
│   │   └── websocket.ts          # WS singleton
│   ├── types/
│   │   ├── index.ts              # Shared type exports
│   │   ├── api.ts                # API response shapes
│   │   └── models.ts             # Domain model interfaces
│   ├── utils/
│   │   ├── formatDate.ts
│   │   ├── formatFileSize.ts
│   │   └── getFileIcon.ts
│   ├── router/
│   │   └── index.tsx
│   ├── App.tsx
│   └── main.tsx
├── index.html
├── vite.config.ts
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
    "jsx": "react-jsx",
    "strict": true,
    "strictNullChecks": true,
    "noUncheckedIndexedAccess": true,
    "exactOptionalPropertyTypes": true,
    "noImplicitReturns": true,
    "skipLibCheck": true,
    "baseUrl": ".",
    "paths": { "@/*": ["./src/*"] }
  },
  "include": ["src"]
}
```

---

## Shared Types (`types/models.ts`)

```typescript
export type ProjectStatus = 'active' | 'on-hold' | 'in-review' | 'completed'
export type MilestoneStatus = 'pending' | 'approved' | 'revision'
export type UserPlan = 'free' | 'pro' | 'agency'

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

---

## Phase 1 — Foundation & Auth
**Duration:** Weeks 1–4
**Goal:** Vite + React 19 scaffold, TanStack Store auth, Axios interceptors, auth pages, dashboard shell.

---

### Week 1–2 · Project Scaffold

#### Install dependencies
```bash
npm create vite@latest client -- --template react-ts
cd client && npm install

# TanStack
npm install @tanstack/react-query@5 @tanstack/store

# Routing
npm install react-router-dom@7

# Forms & validation
npm install react-hook-form zod @hookform/resolvers

# HTTP
npm install axios

# ImageKit
npm install imagekitio-react

# UI utilities
npm install sonner dayjs clsx tailwind-merge

# Tailwind
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

# Dev
npm install -D vitest @testing-library/react @testing-library/user-event
```

> **No `@types/react` or `@types/react-dom`** — React 19 ships its own TypeScript declarations. Installing the legacy `@types/react` packages alongside React 19 causes duplicate type conflicts. `react` and `react-dom` are already fully typed out of the box.

#### Axios instance (`api/axios.ts`)
```typescript
import axios from 'axios'
import { authStore } from '../stores/authStore.ts'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true,
})

api.interceptors.request.use((config) => {
  const token = authStore.state.accessToken
  if (token) config.headers.Authorization = `Bearer ${token}`
  return config
})

let isRefreshing = false
let failedQueue: Array<{ resolve: (t: string) => void; reject: (e: unknown) => void }> = []

api.interceptors.response.use(
  (res) => res,
  async (error) => {
    const original = error.config

    if (error.response?.status === 401 && !original._retry) {
      original._retry = true

      if (isRefreshing) {
        return new Promise((resolve, reject) => {
          failedQueue.push({ resolve, reject })
        }).then((token) => {
          original.headers.Authorization = `Bearer ${token}`
          return api(original)
        })
      }

      isRefreshing = true
      try {
        const { data } = await axios.post(
          `${import.meta.env.VITE_API_URL}/auth/refresh`,
          {},
          { withCredentials: true }
        )
        const newToken: string = data.accessToken
        authStore.setState((s) => ({ ...s, accessToken: newToken }))
        failedQueue.forEach((p) => p.resolve(newToken))
        failedQueue = []
        original.headers.Authorization = `Bearer ${newToken}`
        return api(original)
      } catch (refreshErr) {
        failedQueue.forEach((p) => p.reject(refreshErr))
        failedQueue = []
        authStore.setState((s) => ({ ...s, user: null, accessToken: '' }))
        window.location.href = '/login'
        return Promise.reject(refreshErr)
      } finally {
        isRefreshing = false
      }
    }

    return Promise.reject(error)
  }
)

export { api }
```

#### TanStack Query client (`lib/queryClient.ts`)
```typescript
import { QueryClient } from '@tanstack/react-query'

export const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      staleTime:            60_000,    // 1 min
      gcTime:               5 * 60_000,
      retry:                1,
      refetchOnWindowFocus: false,
    },
    mutations: {
      onError: (err) => console.error('Mutation error:', err),
    }
  }
})
```

---

### Week 3–4 · TanStack Store Auth & Auth Pages

#### Auth Store (`stores/authStore.ts`)
```typescript
import { Store } from '@tanstack/store'
import { api } from '../api/axios.ts'
import { queryClient } from '../lib/queryClient.ts'
import type { User } from '../types/models.ts'

interface AuthState {
  user: User | null
  accessToken: string
  isLoading: boolean   // true during initial silent refresh on app boot
}

export const authStore = new Store<AuthState>({
  user: null,
  accessToken: '',
  isLoading: true,
})

// Actions (plain async functions — TanStack Store has no built-in actions)
export const authActions = {
  async login(email: string, password: string) {
    const { data } = await api.post('/auth/login', { email, password })
    authStore.setState(() => ({
      user: data.user,
      accessToken: data.accessToken,
      isLoading: false,
    }))
  },

  async register(name: string, email: string, password: string) {
    const { data } = await api.post('/auth/register', { name, email, password })
    authStore.setState(() => ({
      user: data.user,
      accessToken: data.accessToken,
      isLoading: false,
    }))
  },

  async logout() {
    await api.post('/auth/logout').catch(() => {})
    authStore.setState(() => ({ user: null, accessToken: '', isLoading: false }))
    queryClient.clear()
  },

  async initAuth() {
    // Called once on app boot — attempt silent token refresh
    try {
      const { data } = await api.post('/auth/refresh')
      authStore.setState((s) => ({ ...s, accessToken: data.accessToken }))
      const meRes = await api.get('/auth/me')
      authStore.setState((s) => ({ ...s, user: meRes.data.user, isLoading: false }))
    } catch {
      authStore.setState((s) => ({ ...s, isLoading: false }))
    }
  }
}
```

#### Using TanStack Store in components
```typescript
// Reading state — useStore is the React adapter
import { useStore } from '@tanstack/react-store'
import { authStore } from '../stores/authStore.ts'

function Topbar() {
  // Selector — only re-renders when `user` changes
  const user = useStore(authStore, (s) => s.user)
  return <span>{user?.name}</span>
}

// Reading multiple fields with one subscription
function ProtectedRoute() {
  const { user, isLoading } = useStore(authStore)
  if (isLoading) return <Spinner />
  return user ? <Outlet /> : <Navigate to="/login" replace />
}
```

#### Notification Store (`stores/notificationStore.ts`)
```typescript
import { Store } from '@tanstack/store'
import type { Notification } from '../types/models.ts'

interface NotificationState {
  notifications: Notification[]
  unreadCount: number
}

export const notificationStore = new Store<NotificationState>({
  notifications: [],
  unreadCount: 0,
})

export const notificationActions = {
  add(n: Notification) {
    notificationStore.setState((s) => ({
      notifications: [n, ...s.notifications],
      unreadCount: s.unreadCount + 1,
    }))
  },

  setAll(list: Notification[]) {
    notificationStore.setState(() => ({
      notifications: list,
      unreadCount: list.filter((n) => !n.read).length,
    }))
  },

  markAllRead() {
    notificationStore.setState((s) => ({
      notifications: s.notifications.map((n) => ({ ...n, read: true })),
      unreadCount: 0,
    }))
  },
}
```

#### Register Page (`pages/auth/RegisterPage.tsx`)
```typescript
// Using React 19 Actions + useActionState for form handling
import { useActionState } from 'react'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { authActions } from '../../stores/authStore.ts'

const schema = z.object({
  name:            z.string().min(2).max(100),
  email:           z.string().email(),
  password:        z.string().min(8)
                     .regex(/[A-Z]/, 'Must contain uppercase')
                     .regex(/[0-9]/, 'Must contain number'),
  confirmPassword: z.string(),
}).refine((d) => d.password === d.confirmPassword, {
  message: 'Passwords do not match',
  path: ['confirmPassword'],
})

type FormValues = z.infer<typeof schema>

export function RegisterPage() {
  const { register, handleSubmit, formState: { errors } } = useForm<FormValues>({
    resolver: zodResolver(schema),
  })

  // React 19 useActionState — manages isPending, error from the action
  const [error, submitAction, isPending] = useActionState(
    async (_prev: string | null, formData: FormValues) => {
      try {
        await authActions.register(formData.name, formData.email, formData.password)
        return null
      } catch (err: unknown) {
        return (err as { response?: { data?: { message?: string } } })
          .response?.data?.message ?? 'Registration failed'
      }
    },
    null
  )

  return (
    <form onSubmit={handleSubmit((data) => submitAction(data))}>
      {/* fields... */}
      {error && <p className="text-red-500 text-sm">{error}</p>}
      <button type="submit" disabled={isPending}>
        {isPending ? 'Creating account...' : 'Create account'}
      </button>
    </form>
  )
}
```

---

## Phase 2 — Core Update Engine
**Duration:** Weeks 5–10
**Goal:** TanStack Query project/update hooks, update composer, ImageKit uploads, client portal page.

---

### Week 5–7 · Projects with TanStack Query

#### API layer (`api/project.api.ts`)
```typescript
import { api } from './axios.ts'
import type { Project, Update } from '../types/models.ts'

export const projectApi = {
  getAll:    ()           => api.get<{ data: Project[] }>('/projects').then(r => r.data.data),
  getById:   (id: string) => api.get<{ data: Project }>(`/projects/${id}`).then(r => r.data.data),
  create:    (body: Omit<Project, '_id' | 'ownerId' | 'slug' | 'viewCount' | 'createdAt' | 'updatedAt'>) =>
                            api.post<{ data: Project }>('/projects', body).then(r => r.data.data),
  update:    (id: string, body: Partial<Project>) =>
                            api.put<{ data: Project }>(`/projects/${id}`, body).then(r => r.data.data),
  remove:    (id: string) => api.delete(`/projects/${id}`),
  getPublic: (slug: string) => api.get<{ data: { project: Project; updates: Update[] } }>(`/public/${slug}`).then(r => r.data.data),
}
```

#### TanStack Query v5 hooks (`hooks/useProjects.ts`)
```typescript
import { useQuery, useMutation, useQueryClient, useInfiniteQuery } from '@tanstack/react-query'
import { projectApi } from '../api/project.api.ts'
import { toast } from 'sonner'

// Query key factory — centralised, type-safe
export const projectKeys = {
  all:    ()  => ['projects']                    as const,
  detail: (id: string) => ['projects', id]       as const,
  portal: (slug: string) => ['portal', slug]     as const,
}

export function useProjects() {
  return useQuery({
    queryKey: projectKeys.all(),
    queryFn:  projectApi.getAll,
  })
}

export function useProject(id: string) {
  return useQuery({
    queryKey: projectKeys.detail(id),
    queryFn:  () => projectApi.getById(id),
    enabled:  !!id,
  })
}

export function usePublicProject(slug: string) {
  return useQuery({
    queryKey: projectKeys.portal(slug),
    queryFn:  () => projectApi.getPublic(slug),
    staleTime: 0,    // always fresh for client portal
  })
}

export function useCreateProject() {
  const qc = useQueryClient()
  return useMutation({
    mutationFn: projectApi.create,
    onSuccess:  (newProject) => {
      qc.setQueryData(projectKeys.all(), (old: Project[] = []) => [newProject, ...old])
      toast.success('Project created')
    },
    onError: (err) => toast.error('Failed to create project'),
  })
}

export function useDeleteProject() {
  const qc = useQueryClient()
  return useMutation({
    mutationFn: projectApi.remove,
    onMutate: async (id) => {
      await qc.cancelQueries({ queryKey: projectKeys.all() })
      const prev = qc.getQueryData<Project[]>(projectKeys.all())
      qc.setQueryData(projectKeys.all(), (old: Project[] = []) => old.filter(p => p._id !== id))
      return { prev }
    },
    onError: (_err, _id, ctx) => {
      if (ctx?.prev) qc.setQueryData(projectKeys.all(), ctx.prev)
      toast.error('Failed to delete project')
    },
    onSettled: () => qc.invalidateQueries({ queryKey: projectKeys.all() }),
  })
}
```

---

### Week 8–10 · Updates, ImageKit & Client Portal

#### Update hooks with infinite query
```typescript
// hooks/useUpdates.ts
export const updateKeys = {
  byProject: (projectId: string) => ['updates', projectId] as const,
}

export function useInfiniteUpdates(projectId: string) {
  return useInfiniteQuery({
    queryKey: updateKeys.byProject(projectId),
    queryFn:  ({ pageParam = 1 }) =>
                updateApi.getByProject(projectId, { page: pageParam, limit: 10 }),
    initialPageParam: 1,
    getNextPageParam: (lastPage) =>
      lastPage.pagination.page < lastPage.pagination.pages
        ? lastPage.pagination.page + 1
        : undefined,
  })
}
```

#### Update Composer with React 19 `useOptimistic`
```typescript
// components/update/UpdateComposer.tsx
import { useOptimistic, useTransition, useRef } from 'react'
import { useQueryClient } from '@tanstack/react-query'
import { updateApi } from '../../api/update.api.ts'
import { uploadApi } from '../../api/upload.api.ts'
import { updateKeys } from '../../hooks/useUpdates.ts'
import type { Update, FileRef } from '../../types/models.ts'

export function UpdateComposer({ projectId }: { projectId: string }) {
  const qc = useQueryClient()
  const [isPending, startTransition] = useTransition()
  const formRef = useRef<HTMLFormElement>(null)

  const [optimisticUpdates, addOptimistic] = useOptimistic(
    qc.getQueryData<{ pages: { updates: Update[] }[] }>(updateKeys.byProject(projectId))
      ?.pages.flatMap(p => p.updates) ?? [],
    (state, newUpdate: Update) => [newUpdate, ...state]
  )

  const handleSubmit = async (formData: FormData) => {
    const content    = formData.get('content') as string
    const files      = formData.getAll('files') as File[]
    const isMilestone = formData.get('isMilestone') === 'on'

    if (!content.trim() && !files.length) return

    // Optimistic update
    const tempUpdate: Update = {
      _id: `temp-${Date.now()}`,
      projectId,
      authorId: '',
      content,
      type: isMilestone ? 'milestone' : files.length ? 'file' : 'text',
      isMilestone,
      milestoneStatus: 'pending',
      files: [],
      viewCount: 0,
      createdAt: new Date().toISOString(),
    }

    startTransition(async () => {
      addOptimistic(tempUpdate)

      try {
        let uploadedFiles: FileRef[] = []
        if (files.length) {
          const fd = new FormData()
          files.forEach(f => fd.append('files', f))
          uploadedFiles = await uploadApi.upload(fd)
        }

        await updateApi.create(projectId, { content, isMilestone, files: uploadedFiles })
        qc.invalidateQueries({ queryKey: updateKeys.byProject(projectId) })
        formRef.current?.reset()
      } catch {
        toast.error('Failed to post update')
        qc.invalidateQueries({ queryKey: updateKeys.byProject(projectId) })
      }
    })
  }

  return (
    <form ref={formRef} action={handleSubmit}>
      {/* textarea, file drop, milestone toggle, submit button */}
      <button type="submit" disabled={isPending}>
        {isPending ? 'Posting...' : 'Post Update'}
      </button>
    </form>
  )
}
```

#### ImageKit integration (`components/update/FileAttachment.tsx`)
```typescript
import { IKImage } from 'imagekitio-react'
import type { FileRef } from '../../types/models.ts'

interface Props {
  file: FileRef
}

const IMAGEKIT_ENDPOINT = import.meta.env.VITE_IMAGEKIT_URL_ENDPOINT

export function FileAttachment({ file }: Props) {
  const isImage = file.mimeType.startsWith('image/')

  if (isImage) {
    return (
      <div className="relative group">
        {/* IKImage applies transformations via URL params automatically */}
        <IKImage
          urlEndpoint={IMAGEKIT_ENDPOINT}
          src={file.url}
          transformation={[{ width: '200', height: '150', crop: 'at_max', format: 'webp' }]}
          lqip={{ active: true, quality: 10 }}   // low-quality placeholder while loading
          loading="lazy"
          alt={file.name}
          className="w-48 h-36 object-cover rounded-lg"
        />
        <a
          href={file.url}
          download={file.name}
          className="absolute inset-0 flex items-center justify-center
                     bg-black/50 opacity-0 group-hover:opacity-100
                     rounded-lg transition-opacity"
        >
          <span className="text-white text-xs">Download</span>
        </a>
      </div>
    )
  }

  return (
    <a
      href={file.url}
      download={file.name}
      className="flex items-center gap-2 p-2 border rounded-lg hover:bg-gray-50"
    >
      <FileIcon mimeType={file.mimeType} />
      <div>
        <p className="text-sm font-medium truncate max-w-[160px]">{file.name}</p>
        <p className="text-xs text-gray-500">{formatFileSize(file.size)}</p>
      </div>
    </a>
  )
}
```

#### ImageKit provider setup (`main.tsx`)
```typescript
import { IKContext } from 'imagekitio-react'

root.render(
  <IKContext
    urlEndpoint={import.meta.env.VITE_IMAGEKIT_URL_ENDPOINT}
    publicKey={import.meta.env.VITE_IMAGEKIT_PUBLIC_KEY}
    authenticator={async () => {
      // Fetch auth signature from backend for client-side uploads
      const res = await api.get('/uploads/imagekit-auth')
      return res.data   // { token, expire, signature }
    }}
  >
    <QueryClientProvider client={queryClient}>
      <App />
    </QueryClientProvider>
  </IKContext>
)
```

#### Client Portal Page (`pages/portal/ClientPortalPage.tsx`)
```typescript
import { use, Suspense } from 'react'
import { useParams } from 'react-router-dom'
import { usePublicProject } from '../../hooks/useProjects.ts'
import { IKImage } from 'imagekitio-react'

export function ClientPortalPage() {
  const { slug } = useParams<{ slug: string }>()
  const { data, isLoading, error } = usePublicProject(slug!)

  // Track "seen" on mount
  useEffect(() => {
    api.patch(`/public/${slug}/seen`).catch(() => {})
  }, [slug])

  if (isLoading) return <PortalSkeleton />
  if (error)    return <PortalError />

  const { project, updates } = data!

  return (
    <PublicLayout brandColor={project.brandColor} logoUrl={project.logoUrl}>
      <PortalHeader project={project} />
      <UpdateTimeline updates={updates} isReadOnly />
    </PublicLayout>
  )
}

// PublicLayout applies provider's brand colour via CSS custom property
function PublicLayout({ children, brandColor, logoUrl }: PublicLayoutProps) {
  return (
    <div style={{ '--brand': brandColor } as React.CSSProperties}>
      <header className="border-b p-4 flex items-center gap-3">
        {logoUrl && (
          <IKImage
            src={logoUrl}
            transformation={[{ width: '40', height: '40', format: 'webp' }]}
            alt="Provider logo"
            className="w-10 h-10 rounded object-cover"
          />
        )}
      </header>
      <main className="max-w-2xl mx-auto px-4 py-8">{children}</main>
    </div>
  )
}
```

---

## Phase 3 — Collaboration Layer
**Duration:** Weeks 11–18
**Goal:** Comments, approval UI, Hono WebSocket client, notification store.

---

### Week 11–14 · Comments & Approvals

#### Comment hooks
```typescript
// hooks/useComments.ts
export const commentKeys = {
  byUpdate: (updateId: string) => ['comments', updateId] as const,
}

export function useComments(updateId: string) {
  return useQuery({
    queryKey: commentKeys.byUpdate(updateId),
    queryFn:  () => commentApi.getByUpdate(updateId),
  })
}

export function useAddComment(updateId: string) {
  const qc = useQueryClient()
  return useMutation({
    mutationFn: (body: { authorName: string; authorEmail: string; body: string }) =>
                  commentApi.create(updateId, body),
    onSuccess: (newComment) => {
      qc.setQueryData(commentKeys.byUpdate(updateId), (old: Comment[] = []) => [...old, newComment])
    },
  })
}
```

#### GuestCommentForm — localStorage persistence
```typescript
// components/comment/GuestCommentForm.tsx
export function GuestCommentForm({ updateId }: { updateId: string }) {
  const addComment = useAddComment(updateId)

  const { register, handleSubmit, formState: { errors } } = useForm<CommentValues>({
    resolver: zodResolver(commentSchema),
    defaultValues: {
      authorName:  localStorage.getItem('guestName')  ?? '',
      authorEmail: localStorage.getItem('guestEmail') ?? '',
      body: '',
    }
  })

  const [error, submitAction, isPending] = useActionState(
    async (_prev: string | null, values: CommentValues) => {
      try {
        await addComment.mutateAsync(values)
        localStorage.setItem('guestName',  values.authorName)
        localStorage.setItem('guestEmail', values.authorEmail)
        return null
      } catch {
        return 'Failed to post comment'
      }
    },
    null
  )

  return <form onSubmit={handleSubmit((d) => submitAction(d))}>...</form>
}
```

---

### Week 15–18 · WebSocket Client

#### WebSocket singleton (`lib/websocket.ts`)
```typescript
type WSEvent = {
  event: 'new_notification' | 'client_viewed' | 'comment_added' | 'milestone_status_changed'
  payload: unknown
}

type Listener = (payload: unknown) => void

class WebSocketClient {
  private ws:         WebSocket | null = null
  private listeners:  Map<string, Set<Listener>> = new Map()
  private connectionId: string | null = null

  connect(accessToken: string) {
    const url = `${import.meta.env.VITE_WS_URL}?token=${accessToken}`
    this.ws = new WebSocket(url)

    this.ws.onmessage = (e) => {
      const msg: WSEvent = JSON.parse(e.data)
      if (msg.event === 'connected') {
        this.connectionId = (msg.payload as { connectionId: string }).connectionId
      }
      this.listeners.get(msg.event)?.forEach(fn => fn(msg.payload))
    }

    this.ws.onclose = () => {
      // Reconnect after 2s if connection dropped unexpectedly
      setTimeout(() => this.connect(accessToken), 2000)
    }
  }

  joinProject(projectId: string) {
    this.send({ event: 'join_project', connectionId: this.connectionId, projectId })
  }

  leaveProject(projectId: string) {
    this.send({ event: 'leave_project', connectionId: this.connectionId, projectId })
  }

  on(event: string, listener: Listener) {
    if (!this.listeners.has(event)) this.listeners.set(event, new Set())
    this.listeners.get(event)!.add(listener)
    return () => this.listeners.get(event)?.delete(listener)   // returns cleanup fn
  }

  private send(data: unknown) {
    if (this.ws?.readyState === WebSocket.OPEN) {
      this.ws.send(JSON.stringify(data))
    }
  }

  disconnect() {
    this.ws?.close()
    this.ws = null
  }
}

export const wsClient = new WebSocketClient()
```

#### useWebSocket hook
```typescript
// hooks/useWebSocket.ts
import { useEffect } from 'react'
import { useStore } from '@tanstack/react-store'
import { authStore } from '../stores/authStore.ts'
import { notificationActions } from '../stores/notificationStore.ts'
import { wsClient } from '../lib/websocket.ts'
import { queryClient } from '../lib/queryClient.ts'
import { projectKeys } from './useProjects.ts'
import { toast } from 'sonner'
import type { Notification } from '../types/models.ts'

export function useWebSocket() {
  const accessToken = useStore(authStore, (s) => s.accessToken)

  useEffect(() => {
    if (!accessToken) return

    wsClient.connect(accessToken)

    const unsubNotif = wsClient.on('new_notification', (payload) => {
      const n = payload as Notification
      notificationActions.add(n)
      toast(n.message, { duration: 4000 })
    })

    const unsubViewed = wsClient.on('client_viewed', (payload) => {
      const { projectId } = payload as { projectId: string; timestamp: string }
      queryClient.invalidateQueries({ queryKey: projectKeys.detail(projectId) })
    })

    return () => {
      unsubNotif()
      unsubViewed()
      wsClient.disconnect()
    }
  }, [accessToken])
}

// In ProjectDetailPage — join/leave project room
export function useProjectRoom(projectId: string) {
  useEffect(() => {
    wsClient.joinProject(projectId)
    return () => wsClient.leaveProject(projectId)
  }, [projectId])
}
```

**Call `useWebSocket()` once in `AppLayout.tsx` — it runs for the lifetime of the authenticated session.**

---

## Phase 4 — Polish & Power Features
**Duration:** Weeks 19–26
**Goal:** ImageKit branding UI, analytics, portal access control, project settings.

---

### Week 19–22 · Branding with ImageKit Upload

#### Logo uploader component
```typescript
// In SettingsPage.tsx — branding tab
import { IKUpload } from 'imagekitio-react'

export function BrandingSettings() {
  const [logoUrl, setLogoUrl] = useState(user?.logoUrl)
  const [brandColor, setBrandColor] = useState(user?.brandColor ?? '#6366f1')

  return (
    <div className="space-y-6">
      <div>
        <label className="block text-sm font-medium mb-2">Logo</label>

        {/* Current logo preview using IKImage */}
        {logoUrl && (
          <IKImage
            src={logoUrl}
            transformation={[{ width: '80', height: '80', format: 'webp', crop: 'at_max' }]}
            className="w-20 h-20 rounded-lg object-cover mb-3"
            alt="Current logo"
          />
        )}

        {/* IKUpload handles auth signature automatically via IKContext authenticator */}
        <IKUpload
          fileName="logo"
          folder="/branding"
          tags={['logo', 'branding']}
          onSuccess={(res) => {
            setLogoUrl(res.url)
            // Also persist to backend
            api.patch('/settings/branding', { logoUrl: res.url, logoFileId: res.fileId })
          }}
          onError={(err) => toast.error('Logo upload failed')}
          accept="image/*"
          className="hidden"
          id="logo-upload"
        />
        <label htmlFor="logo-upload" className="btn-secondary cursor-pointer">
          Upload Logo
        </label>
      </div>

      <div>
        <label className="block text-sm font-medium mb-2">Brand Colour</label>
        <div className="flex items-center gap-3">
          <input
            type="color"
            value={brandColor}
            onChange={(e) => setBrandColor(e.target.value)}
            className="w-12 h-10 cursor-pointer rounded border"
          />
          <input
            type="text"
            value={brandColor}
            onChange={(e) => setBrandColor(e.target.value)}
            className="input font-mono text-sm w-28"
            pattern="^#[0-9A-Fa-f]{6}$"
          />
          {/* Live preview of portal header */}
          <div
            className="flex items-center gap-2 px-4 py-2 rounded text-white text-sm"
            style={{ background: brandColor }}
          >
            {logoUrl && (
              <IKImage
                src={logoUrl}
                transformation={[{ width: '20', height: '20', format: 'webp' }]}
                className="w-5 h-5 rounded"
                alt=""
              />
            )}
            <span>Portal preview</span>
          </div>
        </div>
      </div>

      <button onClick={() => api.patch('/settings/branding', { brandColor })} className="btn-primary">
        Save Branding
      </button>
    </div>
  )
}
```

---

### Week 23–26 · Project Settings

#### Portal access control UI
```typescript
// pages/projects/ProjectSettingsPage.tsx — Portal Access tab
export function PortalAccessSettings({ project }: { project: Project }) {
  const [password, setPassword] = useState('')
  const [expiryDate, setExpiryDate] = useState('')

  const portalUrl = `${window.location.origin}/p/${project.slug}`

  return (
    <div className="space-y-6">
      {/* Portal link */}
      <div>
        <label className="block text-sm font-medium mb-1">Portal link</label>
        <div className="flex gap-2">
          <input readOnly value={portalUrl} className="input flex-1 font-mono text-sm" />
          <button onClick={() => navigator.clipboard.writeText(portalUrl)} className="btn-secondary">
            Copy
          </button>
          <button onClick={() => window.open(portalUrl)} className="btn-secondary">
            Open ↗
          </button>
        </div>
      </div>

      {/* Send link via email */}
      <SendPortalLinkForm projectId={project._id} />

      {/* Password protection */}
      <div>
        <label className="block text-sm font-medium mb-1">Password protection</label>
        <div className="flex gap-2">
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="Set a portal password"
            className="input flex-1"
          />
          <button
            onClick={() => api.patch(`/projects/${project._id}/set-password`, { password })}
            className="btn-secondary"
          >
            Set
          </button>
        </div>
      </div>

      {/* Expiry date */}
      <div>
        <label className="block text-sm font-medium mb-1">Expiry date</label>
        <input
          type="date"
          value={expiryDate}
          onChange={(e) => setExpiryDate(e.target.value)}
          min={new Date().toISOString().split('T')[0]}
          className="input"
        />
        <button
          onClick={() => api.patch(`/projects/${project._id}`, { expiresAt: expiryDate })}
          className="btn-secondary mt-2"
        >
          Set Expiry
        </button>
      </div>
    </div>
  )
}
```

---

## Phase 5 — Monetisation & Scale
**Duration:** Weeks 27–32
**Goal:** Stripe billing, plan gates, performance, production polish.

---

### Week 27–29 · Billing Page

```typescript
// pages/settings/BillingPage.tsx
const PLAN_LIMITS = {
  free:   { projects: 3,         storage: '500 MB', team: 1,  branding: false },
  pro:    { projects: 25,        storage: '5 GB',   team: 3,  branding: true },
  agency: { projects: Infinity,  storage: '20 GB',  team: 15, branding: true },
} as const satisfies Record<string, { projects: number; storage: string; team: number; branding: boolean }>

export function BillingPage() {
  const user = useStore(authStore, (s) => s.user)
  const currentPlan = user?.plan ?? 'free'

  const handleUpgrade = async (priceId: string) => {
    const { data } = await api.post('/billing/create-checkout', { priceId })
    window.location.href = data.url
  }

  const handleManage = async () => {
    const { data } = await api.get('/billing/portal')
    window.location.href = data.url
  }

  return (
    <div>
      <h2>Current plan: <span className="capitalize font-semibold">{currentPlan}</span></h2>
      {/* Plan cards... */}
      <button onClick={handleManage}>Manage subscription</button>
    </div>
  )
}
```

#### Plan limit hook
```typescript
// hooks/usePlanLimit.ts
import { useStore } from '@tanstack/react-store'
import { authStore } from '../stores/authStore.ts'

const PLAN_LIMITS = {
  free:   { projects: 3,        storage: 500,  team: 1  },
  pro:    { projects: 25,       storage: 5000, team: 3  },
  agency: { projects: Infinity, storage: 20000, team: 15 },
}

export function usePlanLimit(key: keyof typeof PLAN_LIMITS['free']) {
  const plan = useStore(authStore, (s) => s.user?.plan ?? 'free')
  const limit = PLAN_LIMITS[plan][key]
  return {
    limit,
    isAtLimit: (current: number) => current >= limit,
    plan,
  }
}
```

---

### Week 30–32 · Performance & Production

#### Code splitting
```typescript
// router/index.tsx — all pages lazy-loaded
import { lazy, Suspense } from 'react'

const DashboardPage       = lazy(() => import('../pages/dashboard/DashboardPage.tsx'))
const ProjectDetailPage   = lazy(() => import('../pages/projects/ProjectDetailPage.tsx'))
const ClientPortalPage    = lazy(() => import('../pages/portal/ClientPortalPage.tsx'))
const BillingPage         = lazy(() => import('../pages/settings/BillingPage.tsx'))

// Wrap all routes in Suspense
<Suspense fallback={<PageSpinner />}>
  <Routes>...</Routes>
</Suspense>
```

#### Performance checklist

- Prefetch project detail on ProjectCard hover:
  ```typescript
  onMouseEnter={() =>
    queryClient.prefetchQuery({
      queryKey: projectKeys.detail(id),
      queryFn:  () => projectApi.getById(id),
    })
  }
  ```
- Virtualise long timelines with `@tanstack/react-virtual` (>50 updates)
- Debounce search with `useTransition` (React 19 — no `useDebounce` needed for filtering)
- `staleTime` tuning: notifications `0`, project detail `60s`, portal `0`
- ImageKit LQIP (low-quality placeholder) on all images — set `lqip={{ active: true }}`
- `loading="lazy"` on all `IKImage` below the fold

#### Error boundaries
```typescript
// React 19: error boundaries still use class components
// But React 19 adds `onCaughtError` and `onUncaughtError` props to root

root.render(
  <ErrorBoundary fallback={<ErrorFallback />}>
    <App />
  </ErrorBoundary>
)
```

#### Vercel deployment
1. Connect GitHub repo → Vercel project
2. Set environment variables:
   ```
   VITE_API_URL=https://api.yourdomain.com
   VITE_WS_URL=wss://api.yourdomain.com/ws
   VITE_IMAGEKIT_URL_ENDPOINT=https://ik.imagekit.io/your_id
   VITE_IMAGEKIT_PUBLIC_KEY=public_...
   ```
3. Build: `npm run build`, output: `dist`
4. `vercel.json` for SPA:
   ```json
   { "rewrites": [{ "source": "/(.*)", "destination": "/index.html" }] }
   ```

---

## TanStack Query Key Convention

```typescript
// All query keys defined as factory functions — colocated with their hooks
projectKeys.all()               → ['projects']
projectKeys.detail(id)          → ['projects', id]
projectKeys.portal(slug)        → ['portal', slug]
updateKeys.byProject(projectId) → ['updates', projectId]
commentKeys.byUpdate(updateId)  → ['comments', updateId]
notificationKeys.all()          → ['notifications']
analyticsKeys.byProject(id)     → ['analytics', id]
```

---

## Environment Variables Reference

```bash
VITE_API_URL=http://localhost:5000
VITE_WS_URL=ws://localhost:5000/ws
VITE_IMAGEKIT_URL_ENDPOINT=https://ik.imagekit.io/your_id
VITE_IMAGEKIT_PUBLIC_KEY=public_...
```

---

## Pages Summary

| Page | Route | Auth | Phase |
|---|---|---|---|
| Landing | `/` | public | 1 |
| Register | `/register` | public | 1 |
| Login | `/login` | public | 1 |
| Dashboard | `/dashboard` | JWT | 1 |
| Project List | `/projects` | JWT | 2 |
| Project Detail | `/projects/:id` | JWT | 2 |
| Client Portal | `/p/:slug` | public | 2 |
| Portal Unlock | `/p/:slug/unlock` | public | 4 |
| Notifications | `/notifications` | JWT | 3 |
| Project Settings | `/projects/:id/settings` | JWT | 4 |
| Settings | `/settings` | JWT | 4 |
| Billing | `/settings/billing` | JWT | 5 |

---

## React 19 Migration Notes

If upgrading from React 18:
- Replace `forwardRef` wrappers with plain `ref` prop (supported natively in R19)
- Replace `useCallback` for form handlers with `action` prop pattern where applicable
- Replace manual `isPending` + `setError` state with `useActionState`
- Replace optimistic update patterns using `setState` callback with `useOptimistic`
- `ReactDOM.render` → `ReactDOM.createRoot` (already required from R18)
- `use(promise)` replaces `useEffect` + `useState` for one-off async reads in Suspense

# Client Update Portal — Frontend Roadmap
### MERN Stack · React 18 + Vite + Tailwind CSS

---

## Overview

| | |
|---|---|
| **Framework** | React 18 |
| **Build Tool** | Vite 5 |
| **Routing** | React Router v6 |
| **State** | Zustand (global) + React Query (server state) |
| **Styling** | Tailwind CSS v3 |
| **Forms** | react-hook-form + zod |
| **HTTP** | Axios with interceptors |
| **Real-time** | socket.io-client |
| **Notifications** | react-hot-toast |
| **Charts** | Recharts (Phase 4) |
| **Deployment** | Vercel |
| **Total Phases** | 5 |
| **Total Duration** | ~32 weeks |

---

## Folder Structure

```
/client
├── public/
│   └── favicon.svg
├── src/
│   ├── api/
│   │   ├── axios.js            # Axios instance + interceptors
│   │   ├── auth.api.js
│   │   ├── project.api.js
│   │   ├── update.api.js
│   │   ├── comment.api.js
│   │   ├── upload.api.js
│   │   └── notification.api.js
│   ├── components/
│   │   ├── layout/
│   │   │   ├── AppLayout.jsx       # Sidebar + topbar shell
│   │   │   ├── Sidebar.jsx
│   │   │   ├── Topbar.jsx
│   │   │   └── PublicLayout.jsx    # Minimal layout for client portal
│   │   ├── ui/
│   │   │   ├── Button.jsx
│   │   │   ├── Input.jsx
│   │   │   ├── Modal.jsx
│   │   │   ├── Badge.jsx
│   │   │   ├── Avatar.jsx
│   │   │   ├── Spinner.jsx
│   │   │   ├── EmptyState.jsx
│   │   │   └── ProgressBar.jsx
│   │   ├── project/
│   │   │   ├── ProjectCard.jsx
│   │   │   ├── ProjectStatusBadge.jsx
│   │   │   └── CreateProjectModal.jsx
│   │   ├── update/
│   │   │   ├── UpdateCard.jsx
│   │   │   ├── UpdateComposer.jsx
│   │   │   ├── UpdateTimeline.jsx
│   │   │   ├── MilestoneBadge.jsx
│   │   │   └── FileAttachment.jsx
│   │   ├── comment/
│   │   │   ├── CommentThread.jsx
│   │   │   └── GuestCommentForm.jsx
│   │   └── notifications/
│   │       ├── NotificationBell.jsx
│   │       └── NotificationItem.jsx
│   ├── pages/
│   │   ├── auth/
│   │   │   ├── RegisterPage.jsx
│   │   │   └── LoginPage.jsx
│   │   ├── dashboard/
│   │   │   └── DashboardPage.jsx
│   │   ├── projects/
│   │   │   ├── ProjectListPage.jsx
│   │   │   ├── ProjectDetailPage.jsx
│   │   │   └── ProjectSettingsPage.jsx
│   │   ├── portal/
│   │   │   ├── ClientPortalPage.jsx
│   │   │   └── PortalUnlockPage.jsx
│   │   ├── notifications/
│   │   │   └── NotificationsPage.jsx
│   │   ├── settings/
│   │   │   ├── SettingsPage.jsx
│   │   │   └── BillingPage.jsx
│   │   └── LandingPage.jsx
│   ├── stores/
│   │   ├── authStore.js
│   │   └── notificationStore.js
│   ├── hooks/
│   │   ├── useProjects.js
│   │   ├── useUpdates.js
│   │   ├── useComments.js
│   │   ├── useSocket.js
│   │   └── useUpload.js
│   ├── lib/
│   │   ├── queryClient.js      # React Query client config
│   │   └── socket.js           # Socket.io client instance
│   ├── utils/
│   │   ├── formatDate.js       # day.js helpers
│   │   ├── formatFileSize.js
│   │   └── getFileIcon.js
│   ├── router/
│   │   └── index.jsx           # Route definitions
│   ├── App.jsx
│   └── main.jsx
├── index.html
├── vite.config.js
├── tailwind.config.js
├── postcss.config.js
└── package.json
```

---

## Phase 1 — Foundation & Auth
**Duration:** Weeks 1–4  
**Goal:** Vite + React scaffold, Axios + React Query setup, complete auth flow, and dashboard shell.

---

### Week 1–2 · Project Scaffold

#### Tasks

**1. Initialise Vite project**
```bash
npm create vite@latest client -- --template react
cd client && npm install
```

**2. Install all Phase 1 dependencies**
```bash
npm install react-router-dom@6 axios zustand @tanstack/react-query
npm install react-hook-form zod @hookform/resolvers
npm install dayjs react-hot-toast clsx
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

**3. Tailwind configuration (`tailwind.config.js`)**
```javascript
export default {
  content: ['./index.html', './src/**/*.{js,jsx}'],
  theme: {
    extend: {
      colors: {
        brand: {
          50: '#f0fdf4', 500: '#22c55e', 600: '#16a34a', 900: '#14532d'
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace']
      }
    }
  }
}
```

**4. Axios instance (`api/axios.js`)**
```javascript
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true,   // send cookies (refresh token)
});

// Request interceptor: attach access token from Zustand store
api.interceptors.request.use((config) => {
  const token = useAuthStore.getState().accessToken;
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

// Response interceptor: on 401, attempt token refresh, retry original request
api.interceptors.response.use(
  (res) => res,
  async (error) => {
    const original = error.config;
    if (error.response?.status === 401 && !original._retry) {
      original._retry = true;
      const newToken = await useAuthStore.getState().refreshAccessToken();
      original.headers.Authorization = `Bearer ${newToken}`;
      return api(original);
    }
    return Promise.reject(error);
  }
);
```

**5. React Query client (`lib/queryClient.js`)**
```javascript
export const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      staleTime: 1000 * 60,        // 1 minute
      retry: 1,
      refetchOnWindowFocus: false,
    }
  }
});
```

**6. Router setup (`router/index.jsx`)**
```jsx
// All routes defined in one place
// Protected routes wrapped in <ProtectedRoute>
// Public client portal at /p/:slug — always accessible

<Routes>
  <Route path="/" element={<LandingPage />} />
  <Route path="/login" element={<LoginPage />} />
  <Route path="/register" element={<RegisterPage />} />
  <Route path="/p/:slug" element={<ClientPortalPage />} />
  <Route path="/p/:slug/unlock" element={<PortalUnlockPage />} />
  <Route element={<ProtectedRoute />}>
    <Route element={<AppLayout />}>
      <Route path="/dashboard" element={<DashboardPage />} />
      <Route path="/projects" element={<ProjectListPage />} />
      <Route path="/projects/:id" element={<ProjectDetailPage />} />
      <Route path="/projects/:id/settings" element={<ProjectSettingsPage />} />
      <Route path="/notifications" element={<NotificationsPage />} />
      <Route path="/settings" element={<SettingsPage />} />
      <Route path="/settings/billing" element={<BillingPage />} />
    </Route>
  </Route>
  <Route path="*" element={<Navigate to="/dashboard" replace />} />
</Routes>
```

**7. ProtectedRoute component**
```jsx
// Checks Zustand auth store
// If no accessToken → redirect to /login
// Attempts silent refresh on mount if token missing but refreshToken cookie exists
function ProtectedRoute() {
  const { accessToken, isLoading } = useAuthStore();
  if (isLoading) return <FullPageSpinner />;
  return accessToken ? <Outlet /> : <Navigate to="/login" replace />;
}
```

---

### Week 3–4 · Auth Pages & Dashboard Shell

#### Auth Store (`stores/authStore.js`)
```javascript
// Zustand slice
{
  user: null,
  accessToken: '',
  isLoading: true,           // true on initial app load while checking auth

  login: async (email, password) => {
    const { data } = await authApi.login({ email, password });
    set({ user: data.user, accessToken: data.accessToken });
  },

  register: async (name, email, password) => { ... },

  logout: async () => {
    await authApi.logout();
    set({ user: null, accessToken: '' });
    queryClient.clear();       // clear all cached server state
  },

  refreshAccessToken: async () => {
    const { data } = await authApi.refresh();
    set({ accessToken: data.accessToken });
    return data.accessToken;
  },

  initAuth: async () => {
    // Called once in App.jsx on mount
    // Try to refresh access token silently using httpOnly cookie
    // If succeeds → user is logged in; if fails → remain logged out
    try {
      await get().refreshAccessToken();
      const { data } = await authApi.getMe();
      set({ user: data.user, isLoading: false });
    } catch {
      set({ isLoading: false });
    }
  }
}
```

#### Register Page (`pages/auth/RegisterPage.jsx`)

**Form fields:** Full name, Email, Password, Confirm password

**Validation schema (zod):**
```javascript
z.object({
  name: z.string().min(2).max(100),
  email: z.string().email(),
  password: z.string().min(8)
    .regex(/[A-Z]/, 'Must contain uppercase')
    .regex(/[0-9]/, 'Must contain number'),
  confirmPassword: z.string()
}).refine(d => d.password === d.confirmPassword, {
  message: 'Passwords do not match',
  path: ['confirmPassword']
});
```

**UI details:**
- Show/hide password toggle button
- Loading spinner on submit button while API in flight
- On success → navigate to `/dashboard`
- Show server-side errors inline under relevant fields
- Link to `/login` for existing users

#### Login Page (`pages/auth/LoginPage.jsx`)

**Form fields:** Email, Password

**UI details:**
- Remember email with localStorage (checkbox)
- "Forgot password?" link (placeholder — Phase 4)
- On success → navigate to redirect URL (stored before auth redirect) or `/dashboard`
- Generic error message on 401 (don't reveal which field is wrong)

#### App Layout (`components/layout/AppLayout.jsx`)

**Structure:**
```
<div class="flex h-screen">
  <Sidebar />                     ← fixed left, 240px wide
  <div class="flex-1 flex flex-col overflow-hidden">
    <Topbar />                    ← fixed top, 56px
    <main class="flex-1 overflow-y-auto p-6">
      <Outlet />                  ← page content rendered here
    </main>
  </div>
</div>
```

**Sidebar content:**
- App logo + name at top
- Nav links: Dashboard, Projects, Notifications
- User avatar + name at bottom
- Logout button
- Collapse to icon-only on mobile

**Topbar content:**
- Page title (from route context)
- Notification bell with unread count
- User avatar dropdown (profile, settings, logout)

#### Dashboard Page (`pages/dashboard/DashboardPage.jsx`)

**Sections:**
- Stats strip: total projects, active projects, pending approvals, updates this week
- Recent projects grid (last 6, showing status badge, client email, update count)
- "Create Project" button → opens `CreateProjectModal`
- Empty state if no projects yet

---

## Phase 2 — Core Update Engine
**Duration:** Weeks 5–10  
**Goal:** Projects CRUD, update composer with file uploads, update timeline, and client portal page.

---

### Week 5–7 · Projects

#### API layer (`api/project.api.js`)
```javascript
export const projectApi = {
  getAll: () => api.get('/projects'),
  getById: (id) => api.get(`/projects/${id}`),
  create: (data) => api.post('/projects', data),
  update: (id, data) => api.put(`/projects/${id}`, data),
  delete: (id) => api.delete(`/projects/${id}`),
  getPublic: (slug) => api.get(`/public/${slug}`),
};
```

#### useProjects hook (`hooks/useProjects.js`)
```javascript
// Wraps React Query queries and mutations
export function useProjects() {
  return useQuery({ queryKey: ['projects'], queryFn: projectApi.getAll });
}

export function useCreateProject() {
  return useMutation({
    mutationFn: projectApi.create,
    onSuccess: () => queryClient.invalidateQueries(['projects']),
    onError: (err) => toast.error(err.response?.data?.message),
  });
}

export function useDeleteProject() {
  return useMutation({
    mutationFn: projectApi.delete,
    onMutate: async (id) => {
      // Optimistic update: remove from cache immediately
      await queryClient.cancelQueries(['projects']);
      const prev = queryClient.getQueryData(['projects']);
      queryClient.setQueryData(['projects'], old =>
        old.filter(p => p._id !== id)
      );
      return { prev };
    },
    onError: (err, id, ctx) => queryClient.setQueryData(['projects'], ctx.prev),
    onSettled: () => queryClient.invalidateQueries(['projects']),
  });
}
```

#### CreateProjectModal (`components/project/CreateProjectModal.jsx`)

**Fields:** Project title (required), Client email (optional), Description (optional)

**Behaviour:**
- Opens as a centered modal with backdrop
- Uses `react-hook-form` + `zod` validation
- On submit → `useCreateProject()` mutation
- On success → close modal + toast "Project created" + navigate to new project
- Close on backdrop click or Escape key

#### Project List Page (`pages/projects/ProjectListPage.jsx`)

**Layout:**
- Filter tabs: All · Active · In Review · Completed
- Search input (client-side filter on project titles)
- Grid of `ProjectCard` components (2 columns on desktop, 1 on mobile)
- "New Project" button in top-right

#### ProjectCard (`components/project/ProjectCard.jsx`)

**Displays:**
- Project title
- `ProjectStatusBadge` (colour-coded pill)
- Client email (if set)
- Last update timestamp ("Updated 2 days ago")
- Update count
- Copy portal link button (copies `window.location.origin/p/:slug` to clipboard)
- Dropdown menu: Edit, Settings, Delete

---

### Week 8–10 · Updates & File Uploads

#### Project Detail Page (`pages/projects/ProjectDetailPage.jsx`)

**Structure:**
```
<div class="max-w-3xl mx-auto">
  <ProjectHeader />           ← title, status selector, portal link button
  <UpdateComposer />          ← always visible at top
  <UpdateTimeline />          ← scrollable list of updates
</div>
```

#### UpdateComposer (`components/update/UpdateComposer.jsx`)

**State:**
- `content` — textarea value
- `files` — array of File objects (before upload)
- `isMilestone` — boolean toggle
- `isUploading` — boolean
- `uploadProgress` — 0–100

**UI elements:**
- Textarea (auto-resizing with `react-textarea-autosize`)
- File drop zone (using `react-dropzone`):
  - Accepts: images, PDF, zip, docx
  - Max 5 files, 10 MB each
  - Shows file thumbnail/icon preview after selection
  - Individual remove button on each file preview
- "Mark as milestone" toggle (star icon, changes composer border to amber when on)
- Submit button: "Post Update" — disabled when content empty and no files

**Submit flow:**
1. If files selected → `POST /api/uploads` (multipart), receive file URLs
2. `POST /api/projects/:id/updates` with content + file references + isMilestone
3. Optimistic update: prepend new update to timeline immediately
4. On error: rollback optimistic update + show error toast
5. On success: clear composer, show "Update posted" toast

**Upload progress:**
- Axios `onUploadProgress` callback → update `uploadProgress` state
- Show progress bar below file previews during upload

#### UpdateTimeline (`components/update/UpdateTimeline.jsx`)

**Behaviour:**
- Infinite scroll using `useInfiniteQuery` (React Query)
- Intersection Observer on last item → fetch next page
- Each update renders as `UpdateCard`

#### UpdateCard (`components/update/UpdateCard.jsx`)

**Displays:**
- Author avatar (initials) + name + timestamp
- Milestone badge (if `isMilestone: true`) with status colour:
  - Pending → gray pill "Awaiting approval"
  - Approved → green pill "Approved"
  - Revision → amber pill "Revision requested"
- Update content (text, line breaks preserved)
- File attachments row (using `FileAttachment` component)
- Comment count badge ("3 comments")
- Edit / Delete dropdown (owner only — check `req.user._id`)

#### FileAttachment (`components/update/FileAttachment.jsx`)

**Per file displays:**
- File type icon (PDF, ZIP, image thumbnail, generic doc)
- Original filename (truncated at 30 chars)
- File size (formatted: "2.4 MB")
- Download button → opens Cloudinary URL in new tab
- Image files: show 80×80 thumbnail with lightbox on click

#### Client Portal Page (`pages/portal/ClientPortalPage.jsx`)

**Route:** `/p/:slug` — completely public, no auth

**Data fetching:**
- `useQuery({ queryKey: ['portal', slug], queryFn: () => projectApi.getPublic(slug) })`
- No token attached (public axios instance without interceptors)

**UI structure:**
```
<PublicLayout>
  <PortalHeader>               ← project title, status badge, progress bar, provider branding
  <UpdateTimeline>             ← read-only, no edit/delete actions
    <UpdateCard readonly />    ← no edit controls, comments visible
      <CommentThread />        ← visible, with GuestCommentForm
        <ApprovalButtons />    ← on milestone cards only
</PublicLayout>
```

**Seen tracking:**
- `useEffect` on mount → `PATCH /api/public/:slug/seen` (silent fire-and-forget)

**PublicLayout:**
- Minimal header: provider logo (if set) + provider name
- No sidebar, no topbar nav
- Footer: "Powered by Client Update Portal" (removable on paid plan — Phase 5)

---

## Phase 3 — Collaboration Layer
**Duration:** Weeks 11–18  
**Goal:** Comments UI, guest comment form, approval buttons, Socket.io integration, and notification bell.

---

### Week 11–14 · Comments & Approvals

#### CommentThread (`components/comment/CommentThread.jsx`)

**Props:** `updateId`, `projectId`, `isReadOnly` (false for portal, owner can delete)

**Behaviour:**
- `useQuery` to fetch comments on mount
- Mutation on submit → optimistic append → invalidate on settle
- Renders list of comment bubbles
- Each comment shows: avatar (initials from name), author name, timestamp, body
- Type badge for approvals: ✓ Approved (green), ↩ Revision Requested (amber)
- Owner can delete comments (trash icon on hover)

#### GuestCommentForm (`components/comment/GuestCommentForm.jsx`)

**Shown on:** Client portal page (always) and project detail page (for team comments — Phase 4)

**Fields:**
- Name (required, remembered in localStorage after first submit)
- Email (required, remembered in localStorage)
- Comment body textarea
- Submit button: "Add Comment"

**Zod schema:**
```javascript
z.object({
  authorName: z.string().min(1).max(100),
  authorEmail: z.string().email(),
  body: z.string().min(1).max(2000),
})
```

#### Approval Buttons (`components/update/MilestoneApproval.jsx`)

**Shown on:** Milestone update cards in client portal only

**States:**
- `pending` → Show "Approve" (green) + "Request Revision" (amber) buttons
- `approved` → Show locked green "Approved" badge, no buttons
- `revision` → Show locked amber "Revision Requested" badge + "Undo" (owner only)

**Approve flow:**
1. Click "Approve" → show confirmation modal
2. Guest enters name + email (pre-filled from localStorage)
3. `PATCH /api/updates/:id/milestone` with `{ status: 'approved', authorName, authorEmail }`
4. Optimistic update of milestone status in cache
5. Toast: "Milestone approved!"

---

### Week 15–18 · Socket.io & Notifications

#### Socket client (`lib/socket.js`)
```javascript
// Single socket instance, created after login
let socket = null;

export function connectSocket(accessToken) {
  socket = io(import.meta.env.VITE_API_URL, {
    auth: { token: accessToken },
    reconnection: true,
    reconnectionAttempts: 5,
    reconnectionDelay: 2000,
  });
  return socket;
}

export function getSocket() { return socket; }
export function disconnectSocket() { socket?.disconnect(); socket = null; }
```

#### useSocket hook (`hooks/useSocket.js`)
```javascript
export function useSocket() {
  const { accessToken } = useAuthStore();
  const addNotification = useNotificationStore(s => s.addNotification);

  useEffect(() => {
    if (!accessToken) return;
    const socket = connectSocket(accessToken);

    socket.on('new_notification', (notification) => {
      addNotification(notification);
      toast.custom(<NotificationToast notification={notification} />);
    });

    socket.on('client_viewed', ({ projectId, timestamp }) => {
      // Invalidate project query to refresh "last seen" field
      queryClient.invalidateQueries(['project', projectId]);
    });

    socket.on('connect_error', (err) => console.warn('Socket error:', err.message));

    return () => disconnectSocket();
  }, [accessToken]);
}
```

**Call `useSocket()` once at the top level in `AppLayout.jsx`.**

#### Join project room on project detail page
```javascript
// In ProjectDetailPage.jsx
useEffect(() => {
  const socket = getSocket();
  socket?.emit('join_project', projectId);
  return () => socket?.emit('leave_project', projectId);
}, [projectId]);
```

#### Notification Store (`stores/notificationStore.js`)
```javascript
{
  notifications: [],
  unreadCount: 0,

  addNotification: (n) => set(s => ({
    notifications: [n, ...s.notifications],
    unreadCount: s.unreadCount + 1,
  })),

  setNotifications: (list) => set({
    notifications: list,
    unreadCount: list.filter(n => !n.read).length,
  }),

  markAllRead: () => set(s => ({
    notifications: s.notifications.map(n => ({ ...n, read: true })),
    unreadCount: 0,
  })),
}
```

#### NotificationBell (`components/notifications/NotificationBell.jsx`)

**Behaviour:**
- Shows bell icon in Topbar
- Red badge with `unreadCount` (hidden if 0)
- Click → opens dropdown panel (max 5 recent notifications)
- "Mark all read" button at top of dropdown
- "See all" link → `/notifications`
- Each item: icon for type + message text + relative time
- Click notification → navigate to relevant project/update
- Pulse animation on bell when new notification arrives (CSS keyframe, 1 second)

#### Notifications Page (`pages/notifications/NotificationsPage.jsx`)

**Behaviour:**
- Fetches full paginated notification list via `GET /api/notifications`
- Groups by date: "Today", "Yesterday", "Earlier"
- Marks all as read on page mount (`PATCH /api/notifications/read-all`)
- Empty state: "No notifications yet"

---

## Phase 4 — Polish & Power Features
**Duration:** Weeks 19–26  
**Goal:** Branding settings, analytics dashboard, access control UI, and team management.

---

### Week 19–22 · Branding & Analytics

#### Settings Page (`pages/settings/SettingsPage.jsx`)

**Tabs:** Profile · Branding · Notifications · Security

**Profile tab:**
- Update name, email
- Change password (current + new + confirm)

**Branding tab:**
- Logo upload (image only, max 2 MB):
  - `react-dropzone` with preview
  - Shows current logo if set
  - Upload → `POST /api/uploads` → `PATCH /api/settings/branding`
- Brand colour picker:
  - Native `<input type="color">` + hex text input (synced)
  - Live preview: shows how client portal header will look with selected colour
- "Save Branding" button with loading state

#### Analytics section in Project Detail

**Added below project header, above composer:**

```jsx
<ProjectAnalytics projectId={id} />
```

**Displays:**
- Total views (update-level)
- Unique commenters count
- Milestone approval rate (X of Y approved)
- Last client activity: "Client last viewed 2 hours ago" (or "Client hasn't viewed yet")
- Small sparkline chart (Recharts `LineChart`) showing view activity over last 14 days

---

### Week 23–26 · Access Control & Project Settings

#### Project Settings Page (`pages/projects/ProjectSettingsPage.jsx`)

**Tabs:** General · Portal Access · Danger Zone

**General tab:**
- Edit project title, description
- Change project status
- Update client email

**Portal Access tab:**
- Portal link display with copy button + open-in-new-tab icon
- Send link via email form (enter client email → triggers backend email)
- Password protection toggle:
  - Off by default
  - Toggle on → text input for portal password → "Set Password" button
  - Password stored hashed on backend
- Expiry date picker:
  - Optional date input
  - If set, portal auto-locks on that date
- Regenerate link button (creates new slug — old link breaks, confirm modal required)

**Danger Zone tab:**
- Delete project button → confirmation modal requiring user to type project title
- Archive project (soft-delete, recoverable — Phase 5 feature)

---

## Phase 5 — Monetisation & Scale
**Duration:** Weeks 27–32  
**Goal:** Stripe billing UI, plan gates, performance optimisations, and production-ready polish.

---

### Week 27–29 · Billing

#### Billing Page (`pages/settings/BillingPage.jsx`)

**Sections:**
- Current plan card (name, renewal date, features list)
- Plan comparison table:

| Feature | Free | Pro | Agency |
|---|---|---|---|
| Projects | 3 | 25 | Unlimited |
| Storage | 500 MB | 5 GB | 20 GB |
| Team members | 1 | 3 | 15 |
| Branding | No | Yes | Yes |
| Remove "Powered by" | No | No | Yes |

- Upgrade/Downgrade buttons → `POST /api/billing/create-checkout` → redirect to Stripe Checkout
- "Manage Subscription" button → `GET /api/billing/portal` → redirect to Stripe Customer Portal

#### Plan limit gates (throughout app)

```jsx
// usePlanLimit hook
export function usePlanLimit(limitKey) {
  const { user } = useAuthStore();
  const limits = PLAN_LIMITS[user.plan];  // defined in constants
  return { limit: limits[limitKey], isAtLimit: (current) => current >= limits[limitKey] };
}

// Usage in ProjectListPage
const { isAtLimit } = usePlanLimit('projects');
const { data: projects } = useProjects();
const atLimit = isAtLimit(projects?.length ?? 0);

// "New Project" button
<Button disabled={atLimit} onClick={openModal}>
  {atLimit ? 'Upgrade to add more' : 'New Project'}
</Button>
{atLimit && <UpgradePrompt feature="more projects" />}
```

**UpgradePrompt component:**
- Small banner with plan limit explanation
- "Upgrade" button linking to `/settings/billing`

---

### Week 30–32 · Performance & Production Polish

#### Code splitting
```javascript
// All pages loaded lazily — bundle only what the current route needs
const DashboardPage = lazy(() => import('./pages/dashboard/DashboardPage'));
const ProjectDetailPage = lazy(() => import('./pages/projects/ProjectDetailPage'));
const ClientPortalPage = lazy(() => import('./pages/portal/ClientPortalPage'));
// etc.

// Wrap router in <Suspense fallback={<PageSpinner />}>
```

#### Performance checklist

- Images: use `loading="lazy"` on all non-critical images
- Virtualize long update timelines with `@tanstack/react-virtual` if >100 items
- Debounce search inputs (300ms) with `useDebounce` hook
- Avoid unnecessary React Query refetches:
  - `staleTime: 60_000` for project data (changes infrequently)
  - `staleTime: 0` for notifications (always fresh)
- Memoize expensive renders with `React.memo` and `useMemo` for ProjectCard and UpdateCard lists
- Prefetch project detail on hover over ProjectCard:
  ```javascript
  onMouseEnter={() => queryClient.prefetchQuery(['project', id], () => projectApi.getById(id))
  ```

#### Error boundaries

```jsx
// Wrap each page in an ErrorBoundary
// Shows friendly "Something went wrong" UI instead of white screen
// Logs to Sentry

class ErrorBoundary extends React.Component {
  state = { hasError: false };
  static getDerivedStateFromError() { return { hasError: true }; }
  componentDidCatch(err) { Sentry.captureException(err); }
  render() {
    return this.state.hasError
      ? <ErrorFallback onReset={() => this.setState({ hasError: false })} />
      : this.props.children;
  }
}
```

#### Accessibility

- All interactive elements have `aria-label` or visible label
- Modals trap focus (use `focus-trap-react`)
- Skip-to-content link at top of document
- Colour contrast ratio ≥ 4.5:1 for all text
- Keyboard navigation tested for all flows: create project, post update, comment, approve milestone

#### Vercel deployment

1. Connect GitHub repo to Vercel
2. Set environment variables:
   ```
   VITE_API_URL=https://your-backend.railway.app
   VITE_SOCKET_URL=https://your-backend.railway.app
   ```
3. Build command: `npm run build`
4. Output directory: `dist`
5. Configure `vercel.json` for SPA fallback:
   ```json
   { "rewrites": [{ "source": "/(.*)", "destination": "/index.html" }] }
   ```

---

## React Query Key Conventions

```javascript
// Consistent cache keys across the app
['projects']                         // all user projects
['project', id]                      // single project by id
['portal', slug]                     // public project (no auth)
['updates', projectId]               // updates for a project
['updates', projectId, { page }]     // paginated
['comments', updateId]               // comments for an update
['notifications']                    // user notifications
['analytics', projectId]             // project analytics
```

---

## Component Props Reference

| Component | Key Props |
|---|---|
| `UpdateCard` | `update`, `isOwner`, `isReadOnly`, `onDelete`, `onEdit` |
| `UpdateComposer` | `projectId`, `onSuccess` |
| `FileAttachment` | `file: { url, name, size, mimeType }`, `onRemove?` |
| `CommentThread` | `updateId`, `projectId`, `isReadOnly` |
| `GuestCommentForm` | `updateId`, `onSuccess` |
| `ProjectCard` | `project`, `onDelete` |
| `ProjectStatusBadge` | `status: 'active' \| 'on-hold' \| 'in-review' \| 'completed'` |
| `NotificationBell` | _(no props — reads from notificationStore)_ |
| `MilestoneBadge` | `status`, `isMilestone` |
| `ProgressBar` | `value: number (0–100)`, `label?` |
| `Modal` | `isOpen`, `onClose`, `title`, `children`, `size?` |
| `EmptyState` | `title`, `description`, `action?` |
| `UpgradePrompt` | `feature: string` |

---

## Environment Variables Reference

```bash
VITE_API_URL=http://localhost:5000
VITE_SOCKET_URL=http://localhost:5000
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

# Fintraq Website — Claude Context

## What this project is
Marketing website for **Fintraq** — a privacy-first, local-first personal finance app for iOS & Android.
Built by **Nafish Ahmed** (solo indie dev). App on Google Play: `me.nafish.fintraq`.

## Stack
- **Vite 6** + **React 19** + **React Router v7** + **Tailwind CSS v4** + **TypeScript**
- **SSG only** — `ssr: false` + `prerender: true` — pure static HTML output to `build/client/`
- **Phosphor Icons** (React components, no CDN)
- **Google Fonts** (Google Sans Flex, ROND axis, CDN)
- **ESLint** + **tsc --noEmit** for code quality
- **GitHub Actions** for CI/CD — deploys via rsync over SSH

## File structure
```
fintraq.idexa.app/
├── app/
│   ├── root.tsx                    # HTML shell, meta, GA, theme init, Nav + Footer toggle
│   ├── routes.ts                   # Route definitions
│   ├── routes/
│   │   ├── home.tsx                # Homepage (hero + features + insights + cta)
│   │   ├── privacy.tsx             # Public Privacy Policy
│   │   ├── terms.tsx               # Public Terms of Service
│   │   ├── in-app.tsx              # In-app layout (no nav/footer)
│   │   ├── in-app.privacy.tsx      # In-app Privacy Policy
│   │   ├── in-app.terms.tsx        # In-app Terms of Service
│   │   └── $.tsx                   # 404 catch-all
│   ├── components/
│   │   ├── nav.tsx                 # Navigation bar (full-width glass)
│   │   ├── footer.tsx              # Footer
│   │   ├── hero.tsx                # Hero section (centered, text-only)
│   │   ├── features.tsx            # Features bento grid
│   │   ├── insights.tsx            # Pro insights section
│   │   ├── cta.tsx                 # Call to action
│   │   ├── scroll-progress.tsx     # Scroll progress bar
│   │   └── legal-layout.tsx        # Legal page wrapper
│   ├── hooks/
│   │   ├── use-theme.tsx           # Dark/light/system theme (localStorage)
│   │   └── use-scroll-reveal.tsx   # IntersectionObserver scroll animations
│   ├── data/
│   │   ├── privacy-content.tsx     # Shared privacy content
│   │   └── terms-content.tsx       # Shared terms content
│   ├── lib/constants.ts            # Site metadata, URLs, GA ID
│   └── styles/app.css              # Tailwind v4 + design tokens + all styles
├── public/
│   ├── favicon.png                 # Site icon + OG image
│   └── images/                     # App screenshots
├── .github/workflows/deploy.yml    # CI/CD — lint, typecheck, build, rsync deploy
├── .htaccess                       # Apache — security headers, caching, SPA fallback
├── react-router.config.ts          # SSG config (ssr: false, prerender: true)
├── vite.config.ts                  # Vite + Tailwind + React Router plugins
├── tsconfig.json                   # TypeScript config
├── eslint.config.js                # ESLint config
└── package.json                    # Dependencies + scripts
```

## Routing (React Router v7)
- `/` → homepage
- `/privacy` → public privacy policy
- `/terms` → public terms of service
- `/in-app/privacy` → in-app privacy (no nav/footer, for mobile WebView)
- `/in-app/terms` → in-app terms (no nav/footer)
- anything else → 404 (SPA fallback)

## URL helpers
All site constants in `app/lib/constants.ts`:
```ts
SITE.name          // 'Fintraq'
SITE.url           // 'https://fintraq.idexa.app'
SITE.googlePlayUrl // Google Play store link
SITE.gaId          // 'G-L39J4VVHHC'
META.title         // 'Fintraq — Personal Finance Manager'
META.description   // 'Local-first personal finance tracking application'
```

## Design tokens
CSS custom properties in `app/styles/app.css` `:root`:
- **Primary**: emerald green `#059669` (dark) / `#047857` (light)
- **Background**: `#0D0D0F` (dark) / `#FCFCF9` (light)
- **Text**: `#F5F5F5` (dark) / `#171717` (light)
- **Muted**: `#A3A3A3` (dark) / `#737373` (light)
- Glass cards with `backdrop-filter`
- Dot grid backgrounds with radial masks
- Typography: Google Sans Flex (ROND axis)

## Theme system
- `localStorage` key: `luno-theme`
- Values: `system` / `dark` / `light`
- Applied as `dark`/`light` class on `<html>`
- Theme toggle cycles through system → dark → light
- OS preference listener for auto-switching

## In-app layout
- `/in-app/*` routes render without Nav/Footer (detected via `useLocation` in root.tsx)
- Same legal content as public pages, shared via `app/data/`
- Supports `?platform=ios|android` query param for platform-specific styling

## App details (for writing copy)
- **Name:** Fintraq
- **Tagline:** "Free = Tracking. Premium = Insights + Control."
- **Version:** 1.1.1
- **Website:** fintraq.idexa.app
- **Privacy model:** 100% local — SQLite on-device, no servers, no account
- **Pricing:** Lifetime one-time purchase. No subscriptions.
- **Stack (app):** React Native + Expo + TypeScript + SQLite + Drizzle ORM + TanStack React Query
- **Platforms:** iOS & Android
- **Developer:** Nafish Ahmed (solo, indie)

## Commands
```
npm run dev        # Dev server at localhost:5173
npm run build      # SSG build → build/client/
npm run preview    # Preview production build
npm run lint       # ESLint
npm run typecheck  # tsc --noEmit
```

## Deployment
- GitHub Actions workflow triggered on push to `main`
- Builds, lints, typechecks, then rsyncs `build/client/` to server
- Secrets: `SSH_PRIVATE_KEY`, `SSH_HOST`, `SSH_USER`, `DEPLOY_PATH`
- Static files served by Apache with `.htaccess` SPA fallback

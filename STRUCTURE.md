# Code Structure — Keeep Website

## File Organization

```
keeep.idexa.app/
├── app/
│   ├── root.tsx                    # HTML shell — <head>, meta, GA, theme init
│   │                               # Root component: Nav (conditional), Outlet, Footer
│   ├── routes.ts                   # Route config — index, privacy, terms, in-app, 404
│   ├── routes/
│   │   ├── home.tsx                # Homepage composition
│   │   ├── privacy.tsx             # Public privacy policy
│   │   ├── terms.tsx               # Public terms of service
│   │   ├── in-app.tsx              # In-app layout wrapper (no nav/footer)
│   │   ├── in-app.privacy.tsx      # In-app privacy policy
│   │   ├── in-app.terms.tsx        # In-app terms of service
│   │   └── $.tsx                   # 404 catch-all
│   ├── components/
│   │   ├── nav.tsx                 # Full-width glass nav bar
│   │   ├── footer.tsx              # Site footer
│   │   ├── hero.tsx                # Centered hero (text + stats, no screenshots)
│   │   ├── features.tsx            # Bento grid of feature cards
│   │   ├── insights.tsx            # Pro insights with example cards
│   │   ├── cta.tsx                 # Download call-to-action
│   │   ├── scroll-progress.tsx     # Fixed gradient progress bar
│   │   └── legal-layout.tsx        # Reusable legal page wrapper + sections
│   ├── hooks/
│   │   ├── use-theme.tsx           # Theme context + localStorage persistence
│   │   └── use-scroll-reveal.tsx   # Generic IntersectionObserver hook
│   ├── data/
│   │   ├── privacy-content.tsx     # Shared privacy content (used by both routes)
│   │   └── terms-content.tsx       # Shared terms content
│   ├── lib/
│   │   └── constants.ts            # SITE metadata, META defaults, URLs
│   └── styles/
│       └── app.css                 # Tailwind v4 + design tokens + component styles
├── public/                         # Static assets served at /
├── .github/workflows/deploy.yml    # CI/CD pipeline
├── .htaccess                       # Apache config
├── package.json                    # Dependencies + npm scripts
├── vite.config.ts                  # Vite + Tailwind + React Router plugins
├── react-router.config.ts          # SSG: ssr=false, prerender=true
├── tsconfig.json                   # TypeScript strict mode
└── eslint.config.js                # Type-aware linting
```

## Design Principles

### 1. Component Reuse
- `LegalLayout` + `LegalSection` used by all 4 legal routes
- `PrivacyContent` / `TermsContent` shared between public and in-app routes
- `useScrollReveal` generic hook used across all sections
- Nav/Footer conditionally rendered based on route (in-app vs public)

### 2. Single Source of Truth
- Design tokens in `app.css` `:root`
- Site constants in `lib/constants.ts`
- Route meta in `root.tsx` (per-path title/description mapping)
- Theme state in `ThemeContext`

### 3. SSG Architecture
- `react-router.config.ts`: `ssr: false`, `prerender: true`
- All 5 static routes pre-rendered at build time
- SPA fallback (`__spa-fallback.html`) for 404s and client-side routing
- No runtime server needed — deploy static files anywhere

## Data Flow

```
Browser → Apache (.htaccess SPA fallback) → Static HTML
                                                   ↓
                                          React Router hydrates
                                                   ↓
                                          Client-side navigation (SPA)
```

## Route Meta System

Per-page `<title>`, `<meta>`, OG tags via `useLocation()` in `root.tsx` Layout:

```
ROUTE_META = {
  '/'           → 'Keeep — Personal Finance Manager'
  '/privacy'    → 'Privacy Policy — Keeep'
  '/terms'      → 'Terms of Service — Keeep'
  '/in-app/*'   → Same as public counterparts
  '*'           → 'Page Not Found — Keeep' (noindex)
}
```

## Adding a New Page

1. Create route file in `app/routes/`
2. Add route in `app/routes.ts`
3. Add meta entry in `ROUTE_META` in `root.tsx`
4. Rebuild — page auto-pre-rendered

## Build Output

```
build/client/
├── index.html                    # / homepage
├── privacy/index.html            # /privacy
├── terms/index.html              # /terms
├── in-app/privacy/index.html     # /in-app/privacy
├── in-app/terms/index.html       # /in-app/terms
├── __spa-fallback.html           # 404 / SPA fallback
├── favicon.png
├── images/                       # App screenshots
└── assets/                       # Bundled JS + CSS
```

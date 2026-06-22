# Fintraq Website

Marketing website for Fintraq — a privacy-first, local-first personal finance app.  
[https://fintraq.idexa.app](https://fintraq.idexa.app)

## Stack

**Vite 6 + React 19 + React Router v7 + Tailwind CSS v4 + TypeScript**

- Pure SSG — `ssr: false` + `prerender: true` — outputs static HTML to `build/client/`
- Phosphor Icons as React components
- Google Sans Flex typography
- ESLint + TypeScript strict mode

## Project Structure

```
app/
├── routes/           # Page routes (home, privacy, terms, in-app, 404)
├── components/       # Reusable UI components
├── hooks/            # Theme + scroll-reveal hooks
├── data/             # Shared legal content
├── lib/              # Constants, site metadata
└── styles/           # Tailwind v4 + design tokens

public/               # Static assets (favicon, images)
```

## Getting Started

```bash
npm install
npm run dev        # Dev server at http://localhost:5173
npm run build      # Build static site to build/client/
npm run preview    # Preview production build
npm run lint       # ESLint check
npm run typecheck  # TypeScript check
```

## Routes

| Path | Description |
|---|---|
| `/` | Homepage |
| `/privacy` | Privacy Policy |
| `/terms` | Terms of Service |
| `/in-app/privacy` | In-app Privacy (no nav, for mobile WebView) |
| `/in-app/terms` | In-app Terms (no nav, for mobile WebView) |
| `*` | 404 |

## Design

- **Colors**: emerald green primary (`#059669` dark / `#047857` light)
- **Backgrounds**: `#0D0D0F` (dark) / `#FCFCF9` (light)
- **Typography**: Google Sans Flex with ROND axis
- **Theme**: system/dark/light toggle with localStorage persistence
- **Style**: glass cards, dot grid backgrounds, gradient text accents, no borders/shadows

## Deployment

GitHub Actions workflow (`.github/workflows/deploy.yml`) deploys on push to `main`:

1. Lint + typecheck
2. Build static site
3. Rsync `build/client/` to `/var/www/fintraq.idexa.app/`

Required secrets: `SSH_PRIVATE_KEY`, `SSH_HOST`, `SSH_USER`, `DEPLOY_PATH`

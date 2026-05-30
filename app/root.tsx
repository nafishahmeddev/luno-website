import { Links, Outlet, Scripts, ScrollRestoration, useLocation } from 'react-router';
import { ThemeProvider } from '~/hooks/use-theme';
import { Nav } from '~/components/nav';
import { Footer } from '~/components/footer';
import { ScrollProgress } from '~/components/scroll-progress';
import { META, SITE } from '~/lib/constants';

import '~/styles/app.css';

const ROUTE_META: Record<string, { title: string; description: string; robots?: string }> = {
  '/': {
    title: META.title,
    description: META.description,
  },
  '/privacy': {
    title: 'Privacy Policy — Luno',
    description: "How Luno handles your data — spoiler: it doesn't.",
  },
  '/terms': {
    title: 'Terms of Service — Luno',
    description: 'The rules of engagement for using Luno — kept plain and honest.',
  },
  '/in-app/privacy': {
    title: 'Privacy Policy — Luno',
    description: "How Luno handles your data — spoiler: it doesn't.",
  },
  '/in-app/terms': {
    title: 'Terms of Service — Luno',
    description: 'The rules of engagement for using Luno — kept plain and honest.',
  },
};

function getMeta(pathname: string) {
  const path = pathname.replace(/\/$/, '') || '/';
  return ROUTE_META[path] ?? {
    title: 'Page Not Found — Luno',
    description: META.description,
    robots: 'noindex',
  };
}

function isInAppRoute(pathname: string) {
  return pathname.startsWith('/in-app');
}

export function Layout({ children }: { children: React.ReactNode }) {
  const location = useLocation();
  const meta = getMeta(location.pathname);
  const ogUrl = `${SITE.url}${location.pathname === '/' ? '' : location.pathname.replace(/\/$/, '')}`;

  return (
    <html lang="en">
      <head>
        <meta charSet="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{meta.title}</title>
        <meta name="description" content={meta.description} />
        <meta name="author" content={SITE.author} />
        <meta name="robots" content={meta.robots ?? 'index, follow, max-image-preview:large'} />
        <meta name="theme-color" content={META.themeColor} />
        <meta name="keywords" content={META.keywords} />
        <link rel="canonical" href={ogUrl} />
        <link rel="icon" type="image/png" href="/favicon.png" />
        <link rel="apple-touch-icon" href="/favicon.png" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content={SITE.name} />
        <meta property="og:title" content={meta.title} />
        <meta property="og:description" content={meta.description} />
        <meta property="og:url" content={ogUrl} />
        <meta property="og:image" content={`${SITE.url}/favicon.png`} />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content={meta.title} />
        <meta name="twitter:description" content={meta.description} />
        <meta name="twitter:image" content={`${SITE.url}/favicon.png`} />
        <link
          href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:ROND,wght@0..100,300..800&display=swap"
          rel="stylesheet"
        />
        <Links />
        <script
          dangerouslySetInnerHTML={{
            __html: `
(function() {
  var saved = localStorage.getItem('luno-theme') || 'system';
  var root  = document.documentElement;
  root.classList.remove('dark', 'light');
  if (saved === 'dark') {
    root.classList.add('dark');
  } else if (saved === 'light') {
    root.classList.add('light');
  } else {
    root.classList.add(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  }
})();
            `,
          }}
        />
      </head>
      <body>
        <ThemeProvider>
          {children}
        </ThemeProvider>
        <ScrollRestoration />
        <Scripts />
        {import.meta.env.PROD && (
          <>
            <script
              async
              src={`https://www.googletagmanager.com/gtag/js?id=${SITE.gaId}`}
            />
            <script
              dangerouslySetInnerHTML={{
                __html: `
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '${SITE.gaId}');
                `,
              }}
            />
          </>
        )}
      </body>
    </html>
  );
}

export default function Root() {
  const location = useLocation();
  const inApp = isInAppRoute(location.pathname);

  return (
    <>
      {!inApp && <ScrollProgress />}
      {!inApp && <Nav />}
      <main>
        <Outlet />
      </main>
      {!inApp && <Footer />}
    </>
  );
}

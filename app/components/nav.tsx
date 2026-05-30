import { Link } from 'react-router';
import { GooglePlayLogo, Monitor, Moon, Sun, ArrowDown } from '@phosphor-icons/react';
import { SITE } from '~/lib/constants';
import { useTheme } from '~/hooks/use-theme';

const THEME_ICONS: Record<string, React.ReactNode> = {
  system: <Monitor weight="fill" size={15} />,
  dark: <Moon weight="fill" size={15} />,
  light: <Sun weight="fill" size={15} />,
};

const THEME_LABELS: Record<string, string> = {
  system: 'System',
  dark: 'Dark',
  light: 'Light',
};

const THEME_ORDER = ['system', 'dark', 'light'] as const;

export function Nav() {
  const { theme, setTheme } = useTheme();

  const cycleTheme = () => {
    const idx = THEME_ORDER.indexOf(theme as (typeof THEME_ORDER)[number]);
    const next = THEME_ORDER[(idx + 1) % THEME_ORDER.length];
    setTheme(next);
  };

  return (
    <header className="nav-header">
      <div className="nav-pill">
        <Link to="/" className="nav-brand">
          <span className="nav-mark" />
          LUNO<span className="dot">.</span>
        </Link>

        <nav className="nav-center">
          <a href="/#features">Features</a>
          <a href="/#analytics">Analytics</a>
          <a href="/#insights">Insights</a>
          <a href="/#download">Pro</a>
        </nav>

        <div className="nav-actions">
          <button
            onClick={cycleTheme}
            aria-label={`Theme: ${THEME_LABELS[theme]}`}
            className="nav-theme-btn"
          >
            {THEME_ICONS[theme]}
          </button>
          <a href={SITE.googlePlayUrl} className="nav-cta">
            <GooglePlayLogo weight="fill" size={13} />
            <span className="nav-cta-text">Download</span>
            <ArrowDown weight="bold" size={12} />
          </a>
        </div>
      </div>
    </header>
  );
}

import { Link } from 'react-router';
import { GooglePlayLogo, Monitor, Moon, Sun } from '@phosphor-icons/react';
import { SITE } from '~/lib/constants';
import { useTheme } from '~/hooks/use-theme';

const THEME_ICONS: Record<string, React.ReactNode> = {
  system: <Monitor weight="fill" size={16} />,
  dark: <Moon weight="fill" size={16} />,
  light: <Sun weight="fill" size={16} />,
};

const THEME_LABELS: Record<string, string> = {
  system: 'Theme: System',
  dark: 'Theme: Dark',
  light: 'Theme: Light',
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
    <nav className="nav">
      <div className="wrap nav-row">
        <Link to="/" className="nav-logo">
          LUNO<span className="dot">.</span>
        </Link>
        <ul className="nav-links">
          <li><a href="/#features">Features</a></li>
          <li><a href="/#analytics">Analytics</a></li>
          <li><a href="/#insights">Insights</a></li>
          <li><a href="/#download">Pro</a></li>
        </ul>
        <div className="nav-end">
          <button
            onClick={cycleTheme}
            aria-label={THEME_LABELS[theme]}
            className="btn-icon"
          >
            {THEME_ICONS[theme]}
          </button>
          <a href={SITE.googlePlayUrl} className="btn btn-primary btn-sm">
            <GooglePlayLogo weight="fill" size={14} />
            Download free
          </a>
        </div>
      </div>
    </nav>
  );
}

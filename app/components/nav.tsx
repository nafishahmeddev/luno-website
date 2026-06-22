import { Link } from 'react-router';
import { HugeiconsIcon } from '@hugeicons/react';
import { PlayStoreIcon, ComputerIcon, Moon01Icon, Sun01Icon } from '@hugeicons/core-free-icons';
import { SITE } from '~/lib/constants';
import { useTheme } from '~/hooks/use-theme';

const THEME_ICONS: Record<string, React.ReactNode> = {
  system: <HugeiconsIcon icon={ComputerIcon} size={20} />,
  dark: <HugeiconsIcon icon={Moon01Icon} size={20} />,
  light: <HugeiconsIcon icon={Sun01Icon} size={20} />,
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
      <div className="nav-bar">
        <Link to="/" className="nav-brand">
          <span className="nav-brand-name">Fintraq</span><span className="dot">.</span>
        </Link>

        <nav className="nav-center">
          <a href="/#features">Features</a>
          <a href="/#insights">Insights</a>
          <a href="/#download">Pro</a>
        </nav>

        <div className="nav-right">
          <button
            onClick={cycleTheme}
            aria-label={`Theme: ${THEME_LABELS[theme]}`}
            className="nav-icon-btn"
          >
            {THEME_ICONS[theme]}
          </button>
          <span className="nav-sep" />
          <a href={SITE.googlePlayUrl} className="nav-cta-btn">
            <HugeiconsIcon icon={PlayStoreIcon} size={18} />
            <span className="nav-cta-label">Download</span>
          </a>
        </div>
      </div>
    </header>
  );
}

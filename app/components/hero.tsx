import { useState, useEffect, useCallback } from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import { PlayStoreIcon, Shield01Icon } from '@hugeicons/core-free-icons';
import { SITE } from '~/lib/constants';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const STATS = [
  { n: '160+', l: 'Currencies' },
  { n: '44+', l: 'Categories' },
  { n: '0', l: 'Cloud servers' },
  { n: '1×', l: 'Pay, forever' },
];

const SCREENS = [
  { src: '/images/raw_dashboard.jpeg', alt: 'Fintraq dashboard' },
  { src: '/images/raw_analytics.jpeg', alt: 'Fintraq analytics' },
  { src: '/images/raw_accounts.jpeg', alt: 'Fintraq accounts' },
  { src: '/images/raw_transaction.jpeg', alt: 'Fintraq transaction detail' },
  { src: '/images/raw_splits.jpeg', alt: 'Fintraq splits & debts' },
];

export function Hero() {
  const headlineAnim = useScrollReveal();
  const descAnim = useScrollReveal('d1');
  const ctasAnim = useScrollReveal('d2');
  const statsAnim = useScrollReveal('d3');
  const showcaseAnim = useScrollReveal('d1');

  const [activeIdx, setActiveIdx] = useState(0);

  const next = useCallback(() => {
    setActiveIdx((prev) => (prev + 1) % SCREENS.length);
  }, []);

  useEffect(() => {
    const t = setInterval(next, 3800);
    return () => clearInterval(t);
  }, [next]);

  return (
    <section className="hero-s">
      <div className="hero-bg-grid" />
      <div className="hero-glow-a" />
      <div className="hero-glow-b" />

      <div className="wrap hero-inner">
        <div className="hero-grid">
          <div ref={headlineAnim.nodeRef} className="hero-content">
            <div className="hero-eyebrow">
              <HugeiconsIcon icon={Shield01Icon} size={16} />
              Local-first · Privacy-first
            </div>
            <h1 className="hero-headline">
              Your money.
              <br />
              <em>Your rules.</em>
            </h1>
            <p className="hero-desc" ref={descAnim.nodeRef}>
              Track transactions, manage accounts across 160+ currencies, and
              keep every byte on your device. No cloud. No account. No catch.
            </p>
            <div className="hero-ctas" ref={ctasAnim.nodeRef}>
              <a href={SITE.googlePlayUrl} className="btn btn-primary btn-lg">
                <HugeiconsIcon icon={PlayStoreIcon} size={22} />
                Download free
              </a>
              <a href="#features" className="btn btn-ghost btn-lg">
                See features &rarr;
              </a>
            </div>
          </div>

          <div ref={showcaseAnim.nodeRef} className={`hero-showcase ${showcaseAnim.className}`}>
            {/* Main phone mockup */}
            <div className="device-mockup mockup-main">
              <div className="screen">
                {SCREENS.map((s, idx) => (
                  <img
                    key={s.src}
                    src={s.src}
                    alt={s.alt}
                    style={{ opacity: idx === activeIdx ? 1 : 0 }}
                  />
                ))}
              </div>
              <div className="island" />
            </div>

            {/* Dot indicators */}
            <div className="mockup-dots">
              {SCREENS.map((s, idx) => (
                <button
                  key={s.src}
                  className={`mockup-dot${idx === activeIdx ? ' active' : ''}`}
                  onClick={() => setActiveIdx(idx)}
                  aria-label={`Show ${s.alt}`}
                />
              ))}
            </div>

            {/* Floating pill badge */}
            <div className="hero-float-badge">
              <span className="badge-pulse-dot" />
              100% on-device
            </div>
          </div>
        </div>

        <div className="stat-row" ref={statsAnim.nodeRef}>
          {STATS.map((s) => (
            <div key={s.l} className="stat-card">
              <div className="stat-n">{s.n}</div>
              <div className="stat-l">{s.l}</div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

import { useState, useEffect, useCallback } from 'react';
import { HugeiconsIcon } from '@hugeicons/react';
import { PlayStoreIcon } from '@hugeicons/core-free-icons';
import { SITE } from '~/lib/constants';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const STATS = [
  { n: '160+', l: 'Currencies' },
  { n: '44+', l: 'Categories' },
  { n: '0', l: 'Cloud servers' },
  { n: '1×', l: 'Pay, forever' },
];

// Left mockup cycles these
const SCREENS_LEFT = [
  '/images/raw_analytics.jpeg',
  '/images/raw_transaction.jpeg',
];

// Right mockup cycles these
const SCREENS_RIGHT = [
  '/images/raw_dashboard.jpeg',
  '/images/raw_accounts.jpeg',
  '/images/raw_splits.jpeg',
];

export function Hero() {
  const headlineAnim = useScrollReveal();
  const descAnim = useScrollReveal('d1');
  const ctasAnim = useScrollReveal('d2');
  const statsAnim = useScrollReveal('d3');
  const showcaseAnim = useScrollReveal('d1');

  const [leftIdx, setLeftIdx] = useState(0);
  const [rightIdx, setRightIdx] = useState(0);

  const nextLeft = useCallback(() => {
    setLeftIdx((prev) => (prev + 1) % SCREENS_LEFT.length);
  }, []);

  const nextRight = useCallback(() => {
    setRightIdx((prev) => (prev + 1) % SCREENS_RIGHT.length);
  }, []);

  useEffect(() => {
    const lt = setInterval(nextLeft, 4200);
    const rt = setInterval(nextRight, 3800);
    return () => { clearInterval(lt); clearInterval(rt); };
  }, [nextLeft, nextRight]);

  return (
    <section className="hero-s">
      <div className="hero-bg-grid" />
      <div className="hero-glow-a" />
      <div className="hero-glow-b" />

      <div className="wrap hero-inner">
        <div className="hero-grid">
          {/* Left: content */}
          <div ref={headlineAnim.nodeRef} className="hero-content">
            <div className="hero-eyebrow">
              Local-first. Privacy-first.
            </div>
            <h1 className="hero-headline">
              Your money.
              <br />
              <em>Your rules.</em>
            </h1>
            <p className="hero-desc" ref={descAnim.nodeRef}>
              Privacy-first personal finance for iOS and Android. Log
              transactions, manage accounts in 160+ currencies, and keep every
              byte on your device.
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

          {/* Right: two overlapping phone mockups */}
          <div ref={showcaseAnim.nodeRef} className={`hero-showcase ${showcaseAnim.className}`}>
            {/* Back phone — analytics, tilted */}
            <div className="device-mockup mockup-1">
              <div className="screen">
                {SCREENS_LEFT.map((src, idx) => (
                  <img
                    key={src}
                    src={src}
                    alt="Fintraq analytics"
                    style={{ opacity: idx === leftIdx ? 1 : 0 }}
                  />
                ))}
              </div>
              <div className="island" />
            </div>

            {/* Front phone — dashboard, upright */}
            <div className="device-mockup mockup-2">
              <div className="screen">
                {SCREENS_RIGHT.map((src, idx) => (
                  <img
                    key={src}
                    src={src}
                    alt="Fintraq dashboard"
                    style={{ opacity: idx === rightIdx ? 1 : 0 }}
                  />
                ))}
              </div>
              <div className="island" />
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

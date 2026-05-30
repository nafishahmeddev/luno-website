import { GooglePlayLogo } from '@phosphor-icons/react';
import { SITE } from '~/lib/constants';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const STATS = [
  { n: '160+', l: 'Currencies' },
  { n: '44+', l: 'Categories' },
  { n: '0', l: 'Cloud Servers' },
  { n: '1\u00d7', l: 'Pay. Forever.' },
];

export function Hero() {
  const headlineAnim = useScrollReveal();
  const descAnim = useScrollReveal('d1');
  const ctasAnim = useScrollReveal('d2');
  const statsAnim = useScrollReveal('d3');

  return (
    <section className="hero-s">
      <div className="hero-bg-grid" />
      <div className="hero-glow-a" />
      <div className="hero-glow-b" />

      <div className="wrap hero-inner">
        <div ref={headlineAnim.nodeRef} className="hero-content">
          <div className="hero-eyebrow">Local-first. Privacy-first.</div>
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
              <GooglePlayLogo weight="fill" size={18} />
              Download free
            </a>
            <a href="#features" className="btn btn-ghost btn-lg">
              See features &rarr;
            </a>
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

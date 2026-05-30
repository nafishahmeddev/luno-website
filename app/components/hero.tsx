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
  const heroAnim = useScrollReveal();
  const phoneAnim = useScrollReveal('d1');
  const statsAnim = useScrollReveal('d2');

  return (
    <section className="hero-s">
      <div className="hero-glow-a" />
      <div className="hero-glow-b" />

      <div className="wrap">
        <div className="hero-inner">
          <div ref={heroAnim.nodeRef} className={heroAnim.className}>
            <h1 className="hero-headline">
              Your money.
              <br />
              <em>Your rules.</em>
            </h1>
            <p className="hero-desc">
              Privacy-first personal finance for iOS and Android. Log
              transactions, manage accounts in 160+ currencies, and keep every
              byte on your device. Free for daily tracking — Pro adds analytics,
              search, and export.
            </p>
            <div className="hero-ctas">
              <a
                href={SITE.googlePlayUrl}
                className="btn btn-primary btn-lg"
              >
                <GooglePlayLogo weight="fill" size={18} />
                Google Play
              </a>
              <a href="#features" className="btn btn-ghost btn-lg">
                See features
              </a>
            </div>
          </div>

          <div ref={phoneAnim.nodeRef} className={phoneAnim.className}>
            <div className="hero-phone-wrap">
              <div className="hero-phone-glow" />
              <div className="hero-phone-glow-2" />
              <img
                src="/images/mint_fresh_3.png"
                alt="Luno dashboard"
                className="hero-phone-img"
              />
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

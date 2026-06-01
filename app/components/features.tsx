import {
  LockKey,
  MagnifyingGlass,
  FileCsv,
  Wallet,
  NotePencil,
  Palette,
  Fire,
} from '@phosphor-icons/react';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const PRIVACY_PILLS = [
  'No cloud storage',
  'No account required',
  'No analytics SDK',
  'On-device SQLite',
  'No ads. Ever.',
];

const METRICS = [
  { key: 'Daily Burn Rate', val: '-\u20B91,240 / day', ok: false },
  { key: 'Savings Rate', val: '76.3%', ok: true },
  { key: 'Financial Runway', val: '2,180 days', ok: true },
  { key: 'Active Days', val: '28 of 30', ok: true },
];

interface FeatureCardData {
  num: string;
  icon: React.ReactNode;
  name: string;
  desc: string;
  cls: string;
  delay: string;
}

const FEATURES: FeatureCardData[] = [
  {
    num: 'Pro',
    icon: <MagnifyingGlass weight="fill" size={18} />,
    name: 'Global Search',
    desc: 'Find any transaction, account, or category instantly across your entire history.',
    cls: 'fc-small-a',
    delay: '',
  },
  {
    num: 'Pro',
    icon: <FileCsv weight="fill" size={18} />,
    name: 'CSV Export',
    desc: 'Export filtered transactions to a spreadsheet. Filter by date, account, and type.',
    cls: 'fc-small-b',
    delay: 'd1',
  },
  {
    num: 'Free',
    icon: <Wallet weight="fill" size={18} />,
    name: 'Multi-account',
    desc: 'Unlimited accounts. 160+ currencies, custom icons and colours.',
    cls: 'fc-card-3',
    delay: '',
  },
  {
    num: 'Free',
    icon: <NotePencil weight="fill" size={18} />,
    name: 'Transaction logging',
    desc: 'Log income, expenses, and transfers. Swipe to edit or delete. Grouped by day.',
    cls: 'fc-card-4',
    delay: 'd1',
  },
  {
    num: 'Free',
    icon: <Palette weight="fill" size={18} />,
    name: 'Dark mode + themes',
    desc: 'Light, dark, and system theme. Custom icons and colours per account and category.',
    cls: 'fc-card-5',
    delay: 'd2',
  },
  {
    num: 'Free',
    icon: <Fire weight="fill" size={18} />,
    name: 'Streak &amp; reminders',
    desc: 'Track daily logging consistency. Set a reminder at your preferred time.',
    cls: 'fc-card-6',
    delay: 'd3',
  },
];

function SmallFeatureCard({ feature }: { feature: FeatureCardData }) {
  const anim = useScrollReveal<HTMLDivElement>(feature.delay || undefined);
  return (
    <div ref={anim.nodeRef} className={`feat-card fc-small ${feature.cls} ${anim.className}`}>
      <div className="fc-num">{feature.num}</div>
      <div className="fc-icon">{feature.icon}</div>
      <div className="fc-name">{feature.name}</div>
      <p className="fc-desc">{feature.desc}</p>
    </div>
  );
}

export function Features() {
  const sectionAnim = useScrollReveal();
  const privAnim = useScrollReveal('d1');
  const analyticsAnim = useScrollReveal<HTMLDivElement>('d2');

  return (
    <section id="features" className="features-s">
      <div className="grid-bg" />
      <div className="wrap" ref={sectionAnim.nodeRef} style={{ position: 'relative', zIndex: 1 }}>
        <div className="section-tag">Features</div>
        <h2 className="section-title">Built different.<br />By design.</h2>
        <p className="section-sub">
          Every feature respects your privacy. Free to use daily — Pro unlocks the full picture.
        </p>
      </div>
      <div className="wrap" style={{ position: 'relative', zIndex: 1 }}>
        <div className="feat-bento">
          {/* Privacy */}
          <div ref={privAnim.nodeRef} className={`feat-card fc-privacy ${privAnim.className}`}>
            <div className="fc-priv-icon">
              <LockKey weight="fill" size={22} />
            </div>
            <h3 className="fc-priv-title">Your data never leaves your device.</h3>
            <p className="fc-priv-sub">
              All data encrypted and stored locally via SQLite. No cloud. No
              account. No tracking. Not even Numeo can see it.
            </p>
            <div className="fc-pills">
              {PRIVACY_PILLS.map((p) => (
                <span key={p} className="fc-pill">
                  <span className="fc-pill-dot" />
                  {p}
                </span>
              ))}
            </div>
          </div>

          {/* Analytics */}
          <div ref={analyticsAnim.nodeRef} className={`feat-card fc-analytics ${analyticsAnim.className}`} id="analytics">
            <div className="fca-head">
              <h3 className="fca-title">Understand your money, deeply.</h3>
              <span className="tag">Pro</span>
            </div>
            <p className="fca-sub">
              Visual charts, behavioral metrics, and period comparisons — one lifetime unlock.
            </p>
            <div className="metric-table">
              {METRICS.map((m) => (
                <div key={m.key} className="m-row">
                  <span className="m-key">{m.key}</span>
                  <span className={`m-val ${m.ok ? 'ok' : 'bad'}`}>{m.val}</span>
                </div>
              ))}
            </div>
          </div>

          {FEATURES.map((f) => (
            <SmallFeatureCard key={f.name} feature={f} />
          ))}
        </div>
      </div>
    </section>
  );
}

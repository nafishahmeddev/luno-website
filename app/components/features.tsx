import {
  LockKey,
  MagnifyingGlass,
  FileCsv,
  Wallet,
  NotePencil,
  Palette,
  Fire,
  Users,
  Fingerprint,
  ArrowsClockwise,
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
    desc: 'Find any transaction, account, category, or note instantly across your entire history.',
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
    icon: <Users weight="fill" size={18} />,
    name: 'Splits & Debts',
    desc: 'Keep track of shared splits, lending, and borrowing with friends and family.',
    cls: 'fc-card-3',
    delay: 'd2',
  },
  {
    num: 'Free',
    icon: <Wallet weight="fill" size={18} />,
    name: 'Multi-account Ledger',
    desc: 'Unlimited ledgers for cash, banks, cards, and investments with custom icons.',
    cls: 'fc-card-4',
    delay: '',
  },
  {
    num: 'Free',
    icon: <Fingerprint weight="fill" size={18} />,
    name: 'Biometric Lock',
    desc: 'Secure your financial data with an on-device PIN, FaceID, or fingerprint lock.',
    cls: 'fc-card-5',
    delay: 'd1',
  },
  {
    num: 'Free',
    icon: <Palette weight="fill" size={18} />,
    name: 'Dark Mode & Themes',
    desc: 'Light, dark, and system themes with custom accent colors and account colors.',
    cls: 'fc-card-6',
    delay: 'd2',
  },
  {
    num: 'Free',
    icon: <NotePencil weight="fill" size={18} />,
    name: 'Transaction Logging',
    desc: 'Log income, expenses, and transfers. Swipe to delete. Grouped beautifully by day.',
    cls: 'fc-card-7',
    delay: '',
  },
  {
    num: 'Free',
    icon: <Fire weight="fill" size={18} />,
    name: 'Streak & Reminders',
    desc: 'Build logging habits with streaks and custom notifications at your preferred time.',
    cls: 'fc-card-8',
    delay: 'd1',
  },
  {
    num: 'Pro',
    icon: <ArrowsClockwise weight="fill" size={18} />,
    name: 'Backup & Restore',
    desc: 'Export full JSON backups. Import to restore your data on any device, anytime.',
    cls: 'fc-card-9',
    delay: 'd2',
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
              account. No tracking. Not even Fintraq can see it.
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

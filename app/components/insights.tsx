import { HugeiconsIcon } from '@hugeicons/react';
import { ChartUpIcon, PiggyBankIcon, CalendarCheckIcon, CheckmarkCircle01Icon } from '@hugeicons/core-free-icons';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const INSIGHTS_CARDS = [
  {
    icon: <HugeiconsIcon icon={ChartUpIcon} size={20} />,
    bg: 'rgba(245,158,11,0.1)',
    color: 'var(--accent-amber)',
    title: 'Spending spike — Food & Dining',
    text: 'Up 28% vs your 4-week average. You spent ₹3,240 more than usual this week.',
  },
  {
    icon: <HugeiconsIcon icon={PiggyBankIcon} size={20} />,
    bg: 'rgba(46,204,113,0.1)',
    color: 'var(--success)',
    title: 'Savings rate up 12% this week',
    text: 'Your 7-day savings rate reached 76% — your best week this month.',
  },
  {
    icon: <HugeiconsIcon icon={CalendarCheckIcon} size={20} />,
    bg: 'rgba(78,205,196,0.1)',
    color: 'var(--accent-teal)',
    title: 'Weekly summary ready',
    text: '₹14,200 income · ₹3,380 spent · ₹10,820 saved. Best week in 90 days.',
  },
];

const CHECKLIST = [
  'Real-time spending spike alerts',
  'Saving trend notifications',
  'Weekly financial summaries',
  'Burn rate + financial runway',
  'Period flow & category breakdown',
  'Weekday spending heatmap',
];

export function Insights() {
  const stackAnim = useScrollReveal();
  const labelAnim = useScrollReveal();
  const titleAnim = useScrollReveal<HTMLHeadingElement>('d1');
  const bodyAnim = useScrollReveal<HTMLParagraphElement>('d2');
  const checkAnim = useScrollReveal<HTMLUListElement>('d3');

  return (
    <section className="insights-s" id="insights">
      <div className="grid-bg" />
      <div className="insights-bg-glow" />
      <div className="wrap">
        <div className="split split-rev">
          <div className="insight-stack" ref={stackAnim.nodeRef}>
            {INSIGHTS_CARDS.map((card) => (
              <div key={card.title} className="insight-card">
                <div className="icard-icon" style={{ background: card.bg, color: card.color }}>
                  {card.icon}
                </div>
                <div>
                  <div className="icard-title">{card.title}</div>
                  <p className="icard-text">{card.text}</p>
                </div>
              </div>
            ))}
          </div>

          <div>
            <div className="s-label" ref={labelAnim.nodeRef}>
              Fintraq Pro
            </div>
            <h2 className="s-title" ref={titleAnim.nodeRef}>
              Your dashboard,
              <br />
              smarter.
            </h2>
            <p className="s-body" ref={bodyAnim.nodeRef}>
              Dashboard Insights surfaces real-time spending alerts, saving
              trends, and weekly summaries — right on your home screen. No
              digging required.
            </p>
            <ul className="checklist" ref={checkAnim.nodeRef}>
              {CHECKLIST.map((item) => (
                <li key={item}>
                  <HugeiconsIcon icon={CheckmarkCircle01Icon} size={20} color="var(--primary)" />
                  {item}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>
    </section>
  );
}

import { HugeiconsIcon } from '@hugeicons/react';
import { PlayStoreIcon, Shield01Icon, InfinityIcon } from '@hugeicons/core-free-icons';
import { SITE } from '~/lib/constants';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

const PRO_PERKS = [
  'Pro Insights dashboard',
  'Global search across all data',
  'CSV export with filters',
  'Full JSON backup & restore',
];

export function Cta() {
  const titleAnim = useScrollReveal();
  const subAnim = useScrollReveal<HTMLParagraphElement>('d1');
  const btnAnim = useScrollReveal<HTMLDivElement>('d2');
  const noteAnim = useScrollReveal<HTMLDivElement>('d3');

  return (
    <section id="download" className="cta-s">
      <div className="cta-glow-center" />
      <div className="wrap cta-inner">
        <div className="cta-eyebrow" ref={titleAnim.nodeRef}>
          <HugeiconsIcon icon={InfinityIcon} size={18} />
          One-time unlock
        </div>
        <h2 className="cta-title">
          Free to track.
          <br />
          <em>Pro to master.</em>
        </h2>
        <p className="cta-sub" ref={subAnim.nodeRef}>
          Start tracking for free — no account, no cloud, no subscription. Upgrade to Pro once and unlock every feature, including all future updates.
        </p>
        <div className="cta-perks" ref={btnAnim.nodeRef}>
          {PRO_PERKS.map((perk) => (
            <span key={perk} className="cta-perk">
              <span className="cta-perk-dot" />
              {perk}
            </span>
          ))}
        </div>
        <a href={SITE.googlePlayUrl} className="btn btn-primary btn-lg cta-main-btn">
          <HugeiconsIcon icon={PlayStoreIcon} size={22} />
          Get it on Google Play
        </a>
        <div className="cta-note-row" ref={noteAnim.nodeRef}>
          <HugeiconsIcon icon={Shield01Icon} size={16} />
          <span>iOS &amp; Android &middot; Free core &middot; No subscription &middot; No cloud</span>
        </div>
      </div>
    </section>
  );
}

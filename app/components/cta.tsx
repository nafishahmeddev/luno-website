import { GooglePlayLogo } from '@phosphor-icons/react';
import { SITE } from '~/lib/constants';
import { useScrollReveal } from '~/hooks/use-scroll-reveal';

export function Cta() {
  const eyebrowAnim = useScrollReveal();
  const titleAnim = useScrollReveal<HTMLHeadingElement>('d1');
  const subAnim = useScrollReveal<HTMLParagraphElement>('d2');
  const btnAnim = useScrollReveal<HTMLAnchorElement>('d3');
  const noteAnim = useScrollReveal<HTMLParagraphElement>('d4');

  return (
    <section id="download" className="cta-s">
      <div className="cta-glow" />
      <div className="cta-glow-2" />
      <div className="wrap cta-inner">
        <div className="cta-eyebrow" ref={eyebrowAnim.nodeRef}>
          One price. Forever.
        </div>
        <h2 className="cta-title" ref={titleAnim.nodeRef}>
          Free to track.
          <br />
          <em>Pro to understand.</em>
        </h2>
        <p className="cta-sub" ref={subAnim.nodeRef}>
          Start with free daily tracking — no account, no cloud, no catch.
          <br />
          Upgrade to Pro once. Keep every feature. Every future update.
        </p>
        <a
          href={SITE.googlePlayUrl}
          className="btn btn-primary btn-lg"
          ref={btnAnim.nodeRef}
        >
          <GooglePlayLogo weight="fill" size={18} />
          Get it on Google Play
        </a>
        <p className="cta-note" ref={noteAnim.nodeRef}>
          iOS &amp; Android &middot; Free core features &middot; No subscription
        </p>
      </div>
    </section>
  );
}

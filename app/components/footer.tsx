import { Link } from 'react-router';
import { GooglePlayLogo } from '@phosphor-icons/react';
import { SITE } from '~/lib/constants';

export function Footer() {
  return (
    <footer className="footer">
      <div className="wrap">
        <div className="footer-top">
          <div className="footer-brand">
            <div className="footer-logo">
              <span className="footer-logo-name">Keeep</span><span className="dot">.</span>
            </div>
            <p className="footer-tagline">
              Free = Tracking.<br />
              Premium = Insights + Control.
            </p>
            <a href={SITE.googlePlayUrl} className="footer-store-btn">
              <GooglePlayLogo weight="fill" size={14} />
              Google Play
            </a>
          </div>

          <div className="footer-col">
            <h4>Product</h4>
            <ul>
              <li><a href="/#features">Features</a></li>
              <li><a href="/#insights">Insights</a></li>
              <li><a href="/#download">Keeep Pro</a></li>
            </ul>
          </div>

          <div className="footer-col">
            <h4>Legal</h4>
            <ul>
              <li><Link to="/privacy">Privacy Policy</Link></li>
              <li><Link to="/terms">Terms of Service</Link></li>
            </ul>
          </div>
        </div>

        <div className="footer-bottom">
          <p className="footer-copy">&copy; 2026 Keeep. All rights reserved.</p>
          <p className="footer-made">
            Built by{' '}
            <a href={SITE.authorUrl}>{SITE.author}</a>
          </p>
        </div>
      </div>
    </footer>
  );
}

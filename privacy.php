<?php
/**
 * Privacy Policy Page
 * ===================
 */
$page_title = 'Privacy Policy';
$page_meta = 'How Luno handles your data — spoiler: it doesn\'t.';
include_once __DIR__ . '/includes/header.php';
?>

<div class="page-wrap">
  <div class="page-header">
    <div class="page-tag">Legal</div>
    <h1>Privacy Policy</h1>
    <p>How Luno handles your data — spoiler: it doesn't.</p>
    <div class="effective">Effective: January 1, 2025 · Version 1.0</div>
  </div>

  <div class="highlight">
    <p><strong>The short version:</strong> Luno is built local-first. All your financial data is stored exclusively on your device using SQLite. We do not collect, transmit, store, or sell any personal or financial information. There are no servers, no accounts, and no tracking of any kind.</p>
  </div>

  <div class="doc-section">
    <h2>1. Information We Collect</h2>
    <p>Luno does not collect any personal information. The app operates entirely offline and on-device. Specifically:</p>
    <ul>
      <li>We do not collect your name, email address, or any identifying information.</li>
      <li>We do not collect financial data, transaction records, or account balances.</li>
      <li>We do not collect device identifiers, IP addresses, or location data.</li>
      <li>We do not use analytics SDKs, crash reporting tools, or advertising frameworks.</li>
    </ul>
    <p>The only data that exists in relation to Luno is data you create yourself, stored locally on your device.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>2. How Your Data Is Stored</h2>
    <p>All data you enter into Luno — including transactions, account details, categories, and preferences — is stored in a SQLite database on your device. This data:</p>
    <ul>
      <li>Never leaves your device.</li>
      <li>Is not backed up to any Luno-operated cloud service.</li>
      <li>Is not accessible to us or any third party.</li>
      <li>Is fully under your control at all times.</li>
    </ul>
    <p>If you use your device's native backup features (such as Google Drive backup on Android), your app data may be included in those backups according to your device settings. This is governed by Google's privacy policy, not ours.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>3. Third-Party Services</h2>
    <p>Luno does not integrate with any third-party analytics, advertising, or data services for tracking. However, we do use:</p>
    <ul>
      <li><strong>Google Play Billing:</strong> For processing in-app purchases (Premium features). Google Play Billing handles payment information but does NOT have access to your financial data stored in Luno.</li>
      <li><strong>Google Fonts:</strong> For typography. This is a web request that may send minimal data to Google per their privacy policy.</li>
    </ul>
    <p>The following are NOT included in Luno:</p>
    <ul>
      <li>Advertising networks or SDKs</li>
      <li>Analytics platforms (Google Analytics, Firebase, Mixpanel, etc.)</li>
      <li>Crash reporting services</li>
      <li>Social login or OAuth providers</li>
      <li>Banking integrations or account connections</li>
    </ul>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>4. In-App Purchases and Premium Features</h2>
    <p>Luno offers both free and premium features. Premium features include advanced analytics (daily burn rate, savings rate, financial runway, in/out ratio) and extended time-range filtering.</p>
    <p><strong>Pricing Options:</strong></p>
    <ul>
      <li>Subscription plan: Recurring monthly or annual payment for continuous premium access</li>
      <li>Lifetime purchase: One-time payment for permanent, lifetime premium access</li>
      <li>Free tier: Core features available at no cost</li>
    </ul>
    <p><strong>Payment Processing:</strong></p>
    <ul>
      <li>All payments are processed through Google Play Billing</li>
      <li>Payment information (credit card, billing address) is handled by Google and is NOT stored in Luno</li>
      <li>We do NOT have access to your payment details</li>
      <li>For refund policies, please refer to Google Play's refund policy at: https://support.google.com/googleplay/answer/134336</li>
    </ul>
    <p><strong>Purchase Data:</strong></p>
    <ul>
      <li>We track whether you have an active premium subscription or lifetime access locally on your device</li>
      <li>This information is stored only on your device</li>
      <li>Luno receives no information about your payment method or billing details</li>
      <li>Your purchase status is tied to your Google Play account, not to Luno's servers</li>
    </ul>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>5. Data Deletion</h2>
    <p>You have full control over your data at all times. To delete your data:</p>
    <ul>
      <li><strong>Factory Reset:</strong> Navigate to Settings → Maintenance → Factory Reset within the app to wipe all locally stored data immediately.</li>
      <li><strong>Uninstall:</strong> Uninstalling the app from your device will remove all associated app data, subject to your device's storage management behavior.</li>
    </ul>
    <p>Since we do not hold any of your data on our servers, there is no need to contact us for data deletion.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>6. Children's Privacy</h2>
    <p>Luno is not directed at children under the age of 13. We do not knowingly collect personal information from children. Since Luno collects no personal information from anyone, this applies equally to all users regardless of age.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>7. Changes to This Policy</h2>
    <p>We may update this Privacy Policy from time to time. Any changes will be reflected with an updated effective date at the top of this page and within the app's update release notes. Continued use of the app after changes constitutes your acceptance of the revised policy.</p>
    <p>Given the nature of Luno's local-first architecture, changes to this policy are expected to be minimal.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>8. Contact</h2>
    <p>If you have any questions about this Privacy Policy, please reach out:</p>
    <div class="contact-card">
      <h3>Luno Support</h3>
      <p>For privacy inquiries: <a href="mailto:hello@nafish.me">hello@nafish.me</a></p>
      <p>General support: <a href="mailto:hello@nafish.me">hello@nafish.me</a></p>
    </div>
  </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>

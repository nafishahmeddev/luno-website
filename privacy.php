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
    <div class="effective">Effective: April 2, 2026 · Version 1.0.1</div>
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
      <li><strong>Google Play Account:</strong> You can also manage your purchased premium features through your Google Play Account settings.</li>
    </ul>
    <p>Since we do not hold any of your data on our servers, there is no need to contact us for data deletion.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>6. Data Security</h2>
    <p>Luno implements security measures to protect your data:</p>
    <ul>
      <li>All data is stored locally on your device using SQLite with file-level encryption available through your device's OS</li>
      <li>No data is transmitted to external servers</li>
      <li>No network requests expose your financial information</li>
      <li>Your device's built-in security features (lock screen, biometric authentication) protect access to Luno</li>
    </ul>
    <p>While we employ security measures, no method of electronic storage is 100% secure. Your device's security settings play a crucial role in protecting your data.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>7. Data Retention and Backups</h2>
    <p><strong>Data Retention:</strong> Luno retains your data for as long as you keep the app installed on your device. You can delete all data at any time using the factory reset feature.</p>
    <p><strong>Device Backups:</strong> If you use Android's automatic backup feature (Google Drive, other cloud services), your Luno data may be included based on your device settings. This is subject to those services' privacy policies, not ours.</p>
    <p><strong>Luno-Operated Backups:</strong> Luno does not maintain backups of your data on any servers.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>8. Cookies and Tracking Technologies</h2>
    <p>Luno does NOT use:</p>
    <ul>
      <li>Cookies</li>
      <li>Web beacons or tracking pixels</li>
      <li>Mobile identifiers or advertising IDs</li>
      <li>Analytics libraries</li>
      <li>Crash reporting tools that transmit data</li>
    </ul>
    <p>The app's only external network requests are to Google Fonts for font loading, which is governed by Google's privacy policies.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>9. Your Rights</h2>
    <p><strong>Access:</strong> You have full access to all your data stored in Luno at any time through the app.</p>
    <p><strong>Portability:</strong> You can export your data by using the app's data export features or accessing the SQLite database directly through your device's file system.</p>
    <p><strong>Rectification:</strong> You can modify any data in the app directly.</p>
    <p><strong>Erasure (Right to be Forgotten):</strong> You can delete all your data using the factory reset feature.</p>
    <p><strong>Restriction:</strong> You control the scope of data collection by choosing what information you input into the app.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>10. International Data Transfers</h2>
    <p>Since Luno operates entirely on your device, no data transfers occur internationally. Your data never leaves your device or local backups.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>11. Children's Privacy</h2>
    <p>Luno is not directed at children under the age of 13. We do not knowingly collect personal information from children. Since Luno collects no personal information from anyone, this applies equally to all users regardless of age.</p>
    <p>If you believe a child has provided information to Luno, please contact us immediately at hello@nafish.me.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>12. Changes to This Policy</h2>
    <p>We may update this Privacy Policy from time to time. Any changes will be reflected with an updated effective date at the top of this page and within the app's update release notes. Continued use of the app after changes constitutes your acceptance of the revised policy.</p>
    <p>Given the nature of Luno's local-first architecture, changes to this policy are expected to be minimal. Significant changes will be communicated in advance.</p>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>13. Data Safety & Transparency</h2>
    <p>As required by Google Play's Data Safety section, we confirm:</p>
    <ul>
      <li><strong>Data Collected:</strong> No personal, financial, or identifying data is collected by Luno or transmitted to any external service (except Google Play for in-app purchases)</li>
      <li><strong>Data Sharing:</strong> No data is shared with third parties</li>
      <li><strong>Data Security:</strong> Your data is protected by your device's security features and stored locally using SQLite</li>
      <li><strong>User Controls:</strong> You can delete all app data using the factory reset feature at any time</li>
    </ul>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>14. Contact & Privacy Inquiries</h2>
    <p>If you have any questions about this Privacy Policy or our privacy practices, please reach out:</p>
    <div class="contact-card">
      <h3>Luno Privacy Contact</h3>
      <p>Email: <a href="mailto:hello@nafish.me">hello@nafish.me</a></p>
      <p>Subject: Privacy Policy Inquiry</p>
      <p>We will respond to privacy inquiries within 30 days.</p>
    </div>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>15. Play Store Data Safety Compliance</h2>
    <p>As required by Google Play's Data Safety section, Luno provides complete transparency:</p>
    <ul>
      <li><strong>Data Collected:</strong> None. Luno does not collect, access, or transmit any personal or financial data about you.</li>
      <li><strong>Data Shared:</strong> No data is shared with any third party (except Google Play for in-app purchases, governed by Google's privacy policy).</li>
      <li><strong>Data Retention:</strong> We do not retain any user data on external servers.</li>
      <li><strong>Data Deletion:</strong> Use Factory Reset in Settings to permanently delete all your app data immediately.</li>
      <li><strong>Data Encryption:</strong> Your device's SQLite encryption protects your data.</li>
      <li><strong>Secure Transmission:</strong> No data is transmitted from your device for Luno purposes.</li>
    </ul>
  </div>

  <hr class="divider"/>

  <div class="doc-section">
    <h2>16. California Consumer Privacy Act (CCPA)</h2>
    <p>For California residents: Since Luno collects no personal information, CCPA rights to access, delete, or opt-out do not apply in the traditional sense. However:</p>
    <ul>
      <li><strong>Right to Know:</strong> You can see all data in the app — it's all yours, stored locally.</li>
      <li><strong>Right to Delete:</strong> Use Factory Reset to delete all data immediately.</li>
      <li><strong>Right to Opt-Out:</strong> N/A — we don't sell data because we don't collect it.</li>
    </ul>
  </div>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>

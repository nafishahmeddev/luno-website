import { LegalSection } from '~/components/legal-layout';

export function TermsContent() {
  return (
    <>
      <LegalSection title="1. Acceptance of Terms">
        <p>By downloading, installing, or using Aurei ("the App"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, do not use the App.</p>
        <p>These Terms constitute the entire agreement between you and the Aurei team regarding your use of the App.</p>
      </LegalSection>

      <LegalSection title="2. Eligibility">
        <p>By using Aurei, you represent and warrant that:</p>
        <ul>
          <li>You are at least 18 years of age</li>
          <li>You have the legal authority to enter into these Terms</li>
          <li>You will comply with all applicable laws and regulations</li>
        </ul>
        <p>Aurei is not intended for users under 13 years of age. Parental consent is required for users aged 13–18.</p>
      </LegalSection>

      <LegalSection title="3. Description of Service">
        <p>Aurei is a personal finance tracking application for Android devices. It provides tools to:</p>
        <ul>
          <li>Log and categorize income and expense transactions</li>
          <li>Track balances across multiple financial accounts</li>
          <li>View analytics and financial insights (with premium features)</li>
          <li>Manage personal budgets and spending categories</li>
        </ul>
        <p>All functionality operates entirely on your device. Aurei does not connect to any external servers, banking institutions, or financial services on your behalf (except for Google Play Billing for premium purchases).</p>
      </LegalSection>

      <LegalSection title="4. License and Intellectual Property">
        <p>Subject to your compliance with these Terms, we grant you a limited, non-exclusive, non-transferable, revocable license to download and use Aurei for your personal, non-commercial purposes on devices you own or control.</p>
        <p>You may not:</p>
        <ul>
          <li>Copy, modify, or distribute the App or its source code</li>
          <li>Reverse engineer, decompile, or disassemble the App</li>
          <li>Rent, lease, sell, or sublicense the App</li>
          <li>Use the App for any commercial purpose without explicit written permission</li>
          <li>Remove or alter any proprietary notices or labels on the App</li>
        </ul>
        <p><strong>Our Intellectual Property:</strong> All content, features, and functionality of the Aurei app (including but not limited to software, text, graphics, logos, images, and sound) are owned by Aurei, its content providers, or other providers of such material and are protected by international copyright, trademark, and other intellectual property laws.</p>
      </LegalSection>

      <LegalSection title="5. Free and Premium Features">
        <p>Aurei is offered in two tiers:</p>
        <h3>Free Tier</h3>
        <ul>
          <li>Transaction tracking (unlimited)</li>
          <li>Basic dashboard (net position + recent activity)</li>
          <li>Basic filtering (by account, category, type)</li>
          <li>Account &amp; category management</li>
          <li>44 default categories + unlimited custom (with custom icons and colours)</li>
          <li>Theme support (light, dark, system)</li>
        </ul>
        <h3>Premium Tier (Lifetime Purchase)</h3>
        <ul>
          <li>All free features</li>
          <li>Dashboard insights — spending spike alerts, saving trends, weekly summaries</li>
          <li>Extended analytics — 30-day, 90-day, and 12-month time ranges (7D is free)</li>
          <li>Period flow chart — side-by-side income vs expense bars over time</li>
          <li>Category breakdown — donut chart of top expense categories</li>
          <li>Account split — balance distribution across accounts</li>
          <li>Weekday patterns — heatmap of spending by day of week</li>
          <li>Behavioral insights — daily burn rate, financial runway, in/out ratio, active days</li>
          <li>Global search — find any transaction, account, or category instantly</li>
          <li>CSV export — export filtered transactions to a spreadsheet</li>
          <li>Permanent access with a one-time purchase. All future updates included.</li>
        </ul>
        <p>Premium access is available through a one-time in-app purchase processed via Google Play Billing.</p>
      </LegalSection>

      <LegalSection title="6. In-App Purchases and Payments">
        <p>Aurei offers premium features through a one-time lifetime purchase model:</p>
        <ul>
          <li>One-time in-app purchase for permanent premium access</li>
          <li>Lifetime access carries across device restores via Google Play account</li>
          <li>No recurring charges</li>
        </ul>
        <h3>General Payment Terms</h3>
        <ul>
          <li>All payments are processed through Google Play Billing</li>
          <li>Aurei does NOT store, access, or process your payment information</li>
          <li>For payment issues or disputes, contact Google Play Support</li>
          <li>Refunds are subject to Google Play's refund policy: <a href="https://support.google.com/googleplay/answer/134336">https://support.google.com/googleplay/answer/134336</a></li>
          <li>Refund requests must be made within the time period specified by Google Play</li>
        </ul>
        <p>Aurei maintains no payment records and cannot process refunds directly. All refund requests must be made through Google Play.</p>
      </LegalSection>

      <LegalSection title="7. Purchase Restoration & Management">
        <p><strong>How to Restore Purchases:</strong></p>
        <ul>
          <li>Open Google Play Store app on your Android device</li>
          <li>Use the same Google account used for purchase</li>
          <li>Reinstall Aurei or use in-app purchase restore flow (if available)</li>
          <li>Google Play will validate and restore premium entitlement</li>
        </ul>
        <p>For billing or entitlement issues, contact Google Play Support first, then contact Aurei support if needed.</p>
      </LegalSection>

      <LegalSection title="8. Your Data and Responsibilities">
        <p>Since Aurei operates entirely on-device, you are solely responsible for:</p>
        <ul>
          <li>The accuracy of the financial data you enter into the App</li>
          <li>Maintaining backups of your data through your device's backup mechanisms</li>
          <li>Protecting access to your device and the App</li>
          <li>Any decisions made based on information displayed by the App</li>
        </ul>
        <p>Aurei is a personal record-keeping tool, not a certified financial advisor. The insights and metrics displayed (such as savings rate, daily burn, and runway) are calculated from the data you provide and should not be treated as professional financial advice.</p>
      </LegalSection>

      <LegalSection title="9. Disclaimer of Warranties">
        <p>The App is provided "as is" and "as available" without warranties of any kind, express or implied. We do not warrant that:</p>
        <ul>
          <li>The App will be error-free or uninterrupted</li>
          <li>Calculations and metrics are free from errors</li>
          <li>The App will meet your specific requirements</li>
          <li>Any defects will be corrected</li>
        </ul>
        <p>To the maximum extent permitted by applicable law, we disclaim all warranties including merchantability, fitness for a particular purpose, and non-infringement.</p>
      </LegalSection>

      <LegalSection title="10. Limitation of Liability">
        <p>To the fullest extent permitted by law, the Aurei team shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to:</p>
        <ul>
          <li>Loss of data due to device failure, uninstall, or factory reset</li>
          <li>Financial decisions made based on app data or calculations</li>
          <li>Any errors or inaccuracies in the App's computations</li>
          <li>Interruption or cessation of the App's availability</li>
        </ul>
        <p>Our total liability to you for all claims shall not exceed the amount you paid for the App (which is zero for free users, or the premium purchase amount for premium users).</p>
      </LegalSection>

      <LegalSection title="11. Prohibited Conduct & Acceptable Use">
        <p>You agree to use Aurei only for lawful purposes and in a manner that does not infringe the rights of others. You agree not to:</p>
        <ul>
          <li>Facilitate illegal financial activity or tax evasion</li>
          <li>Violate any applicable local, national, or international law</li>
          <li>Attempt to probe, scan, or test the vulnerability of the App</li>
          <li>Reverse engineer, decompile, or disassemble the App</li>
          <li>Use the App to harass, abuse, or target individuals</li>
          <li>Attempt to gain unauthorized access to the App or related systems</li>
          <li>Circumvent security or usage limits of the App</li>
          <li>Sell, transfer, or profit from the App or its content</li>
        </ul>
      </LegalSection>

      <LegalSection title="12. Indemnification">
        <p>You agree to indemnify, defend, and hold harmless Aurei and its operators from any claims, liabilities, damages, losses, costs, or expenses (including attorneys' fees) arising from:</p>
        <ul>
          <li>Your violation of these Terms</li>
          <li>Your use of the App in violation of applicable law</li>
          <li>Your financial data or transactions</li>
          <li>Your actions or conduct related to the App</li>
        </ul>
      </LegalSection>

      <LegalSection title="13. Updates and Changes">
        <p>We may update the App from time to time to fix bugs, add features, or improve performance. We may also update these Terms. Continued use of the App after any changes constitutes acceptance of the revised Terms.</p>
        <p>We reserve the right to discontinue the App at any time without notice, though we will make reasonable efforts to communicate significant changes.</p>
      </LegalSection>

      <LegalSection title="14. Account Termination">
        <p>We reserve the right to terminate your access to Aurei if you violate these Terms or engage in prohibited conduct. Upon termination:</p>
        <ul>
          <li>Your right to use the App immediately ceases</li>
          <li>Paid purchases remain subject to Google Play refund and entitlement policies</li>
          <li>You must delete the App from your device</li>
        </ul>
      </LegalSection>

      <LegalSection title="15. Severability & Entire Agreement">
        <p><strong>Severability:</strong> If any provision of these Terms is found to be invalid or unenforceable, that provision will be modified to the minimum extent necessary to make it enforceable, and the remaining provisions will continue in full force.</p>
        <p><strong>Entire Agreement:</strong> These Terms constitute the entire agreement between you and Aurei regarding the App and supersede all prior negotiations, representations, and agreements.</p>
      </LegalSection>

      <LegalSection title="16. Governing Law">
        <p>These Terms shall be governed by and construed in accordance with the laws of India, without regard to its conflict of law provisions. Any disputes arising from these Terms shall be subject to the exclusive jurisdiction of the courts located in India.</p>
      </LegalSection>

      <LegalSection title="17. Service Level & Availability">
        <p>Aurei is provided "as is" and we do not guarantee any specific uptime or availability guarantees since it operates entirely on your device. However, the app strives for reliability and bug-free operation.</p>
        <p><strong>No Warranty:</strong> We disclaim all warranties, express or implied, including merchantability and fitness for a particular purpose. Users are responsible for maintaining backups of their data.</p>
      </LegalSection>

      <LegalSection title="18. Content & Intellectual Property">
        <p>Aurei contains proprietary content, including software, trademarks, logos, and design elements. You may not:</p>
        <ul>
          <li>Copy, modify, or distribute this content</li>
          <li>Remove or alter copyright notices or other proprietary markings</li>
          <li>Use Aurei's branding without explicit permission</li>
        </ul>
        <p>Your personal financial data is yours — you retain all ownership and rights to the data you create within the app.</p>
      </LegalSection>

      <LegalSection title="19. Compliance with Google Play Policies">
        <p>Aurei complies with Google Play's Terms of Service and Developer Program Policies, including:</p>
        <ul>
          <li><strong>Families Policy:</strong> The app is rated for ages 3+ and complies with all Families Policy requirements. No inappropriate content or harmful features are included.</li>
          <li><strong>Data Security:</strong> All user data stays locally on the device. No external servers store or process your financial information.</li>
          <li><strong>Deceptive Practices:</strong> Aurei does not engage in deceptive practices. We clearly communicate features and pricing.</li>
          <li><strong>API Compliance:</strong> The app uses Google Play Billing API for payments and Google Fonts for typography, both in compliance with their respective terms.</li>
        </ul>
      </LegalSection>

      <LegalSection title="20. Contact & Support">
        <p>If you have questions about these Terms, please get in touch:</p>
        <div className="legal-contact">
          <h3>Aurei Support</h3>
          <p>For legal inquiries: <a href="mailto:hello@nafish.me">hello@nafish.me</a></p>
          <p>General support: <a href="mailto:hello@nafish.me">hello@nafish.me</a></p>
        </div>
      </LegalSection>
    </>
  );
}

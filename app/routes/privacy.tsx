import { LegalLayout } from '~/components/legal-layout';
import { PrivacyContent } from '~/data/privacy-content';

export default function Privacy() {
  return (
    <LegalLayout
      title="Privacy Policy"
      subtitle="How Aurei handles your data — spoiler: it doesn't."
      version="Effective: April 2, 2026 &middot; Version 1.0.1"
      summary={
        <>
          <strong>The short version:</strong> Aurei is built local-first. All
          your financial data is stored exclusively on your device using SQLite.
          We do not collect, transmit, store, or sell any personal or financial
          information. There are no servers, no accounts, and no tracking of any
          kind.
        </>
      }
    >
      <PrivacyContent />
    </LegalLayout>
  );
}

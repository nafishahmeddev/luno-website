import { LegalLayout } from '~/components/legal-layout';
import { TermsContent } from '~/data/terms-content';

export default function Terms() {
  return (
    <LegalLayout
      title="Terms of Service"
      subtitle="The rules of engagement for using Keeep — kept plain and honest."
      version="Effective: April 2, 2026 &middot; Version 1.0.1"
      summary={
        <>
          <strong>The short version:</strong> Keeep is free personal finance
          software. Use it honestly, don't try to break it, and understand that
          your financial data is your responsibility since we never touch it.
          These terms are straightforward because the product is.
        </>
      }
    >
      <TermsContent />
    </LegalLayout>
  );
}

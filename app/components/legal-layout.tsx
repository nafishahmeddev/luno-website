interface LegalLayoutProps {
  tag?: string;
  title: string;
  subtitle: string;
  version: string;
  summary: React.ReactNode;
  children: React.ReactNode;
}

export function LegalLayout({
  tag = 'Legal',
  title,
  subtitle,
  version,
  summary,
  children,
}: LegalLayoutProps) {
  return (
    <div className="legal-wrap">
      <div className="legal-head">
        <span className="legal-tag">{tag}</span>
        <h1>{title}</h1>
        <p>{subtitle}</p>
        <span className="legal-version">{version}</span>
      </div>

      <div className="legal-summary">
        <p>{summary}</p>
      </div>

      {children}
    </div>
  );
}

export function LegalSection({
  title,
  children,
}: {
  title: string;
  children: React.ReactNode;
}) {
  return (
    <>
      <div className="legal-body">
        <h2>{title}</h2>
        {children}
      </div>
      <hr className="legal-hr" />
    </>
  );
}

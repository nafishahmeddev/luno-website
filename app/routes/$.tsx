export const handle = {
  title: 'Page Not Found — Fintraq',
  robots: 'noindex',
};

export default function NotFound() {
  return (
    <div
      style={{
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        minHeight: '60vh',
        textAlign: 'center',
        padding: '2rem',
      }}
    >
      <h1
        style={{
          fontSize: 'clamp(60px, 10vw, 120px)',
          fontWeight: 800,
          color: 'var(--primary)',
          lineHeight: 1,
          marginBottom: '1rem',
        }}
      >
        404
      </h1>
      <p style={{ fontSize: '18px', color: 'var(--muted)', marginBottom: '2rem' }}>
        This page doesn't exist. Maybe it never did.
      </p>
      <a href="/" className="btn btn-primary btn-lg">
        Go home
      </a>
    </div>
  );
}

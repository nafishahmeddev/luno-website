import { useEffect, useRef } from 'react';

export interface ScrollRevealResult {
  nodeRef: React.RefObject<HTMLDivElement | null>;
  className: string;
}

export function useScrollReveal<T extends HTMLElement = HTMLDivElement>(delayClass?: string) {
  const nodeRef = useRef<T>(null);

  useEffect(() => {
    const el = nodeRef.current;
    if (!el) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 },
    );

    observer.observe(el);
    return () => observer.disconnect();
  }, []);

  const className = delayClass ? `anim ${delayClass}` : 'anim';

  return { nodeRef, className };
}

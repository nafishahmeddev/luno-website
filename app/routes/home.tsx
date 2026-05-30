import { Hero } from '~/components/hero';
import { Features } from '~/components/features';
import { Insights } from '~/components/insights';
import { Cta } from '~/components/cta';

export default function Home() {
  return (
    <>
      <Hero />
      <Features />
      <Insights />
      <Cta />
    </>
  );
}

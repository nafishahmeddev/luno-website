import { type RouteConfig, index, route, layout } from '@react-router/dev/routes';

export default [
  index('./routes/home.tsx'),
  route('privacy', './routes/privacy.tsx'),
  route('terms', './routes/terms.tsx'),
  layout('./routes/in-app.tsx', [
    route('in-app/privacy', './routes/in-app.privacy.tsx'),
    route('in-app/terms', './routes/in-app.terms.tsx'),
  ]),
  route('*', './routes/$.tsx'),
] satisfies RouteConfig;

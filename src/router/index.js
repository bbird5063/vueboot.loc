import { createRouter, createWebHistory } from 'vue-router';

import Plan from '@/pages/Plan';
import P0 from '@/pages/P0';
import P1 from '@/pages/P1';
import P2 from '@/pages/P2';
import P3 from '@/pages/P3';
import P4 from '@/pages/P4';
import P5 from '@/pages/P5';

const routes = [
  {
    path: '/',
    name: 'Plan',
    component: Plan,
  },
  {
    path: '/plan',
    name: 'Plan',
    component: Plan,
  },
  {
    path: '/p0',
    name: 'P0',
    component: P0,
  },
  {
    path: '/p1',
    name: 'P1',
    component: P1,
  },
  {
    path: '/p2',
    name: 'P2',
    component: P2,
  },
  {
    path: '/p3',
    name: 'P3',
    component: P3,
  },
  {
    path: '/p4',
    name: 'P4',
    component: P4,
  },
  {
    path: '/p5',
    name: 'P5',
    component: P5,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;

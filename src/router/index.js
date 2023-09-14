import { createRouter, createWebHistory } from 'vue-router';

import Main from '@/pages/Main';
import P0 from '@/pages/P0';
import P1 from '@/pages/P1';
import P2 from '@/pages/P2';
import P3 from '@/pages/P3';
import P4 from '@/pages/P4';
import P5 from '@/pages/P5';
import P6 from '@/pages/P6';
import P7 from '@/pages/P7';
import P8 from '@/pages/P8';
import P9 from '@/pages/P9';
import RowIdPage from '@/pages/RowIdPage';

const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main,
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
  {
    path: '/p6',
    name: 'P6',
    component: P6,
  },
  {
    path: '/p7',
    name: 'P7',
    component: P7,
  },
  {
    path: '/p8',
    name: 'P8',
    component: P8,
  },
  {
    path: '/p9',
    name: 'P9',
    component: P9,
  },
  {
    // добавил (:id - динамический параметр)
    path: '/rows/:id',
    component: RowIdPage,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;

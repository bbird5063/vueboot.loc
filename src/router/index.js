import { createRouter, createWebHistory } from 'vue-router';

import AjaxComponent from '@/components/AjaxComponent.vue';
import IncExp0 from '@/pages/IncExp0';
import IncExp1 from '@/pages/IncExp1';
import PlanPay from '@/pages/PlanPay';
import OtherApp from '@/pages/OtherApp';

const routes = [
  {
    path: '/',
    component: AjaxComponent,
  },
  {
    path: '/ajaxcomponent',
    name: 'AjaxComponent',
    component: AjaxComponent,
  },
  {
    path: '/incexp0',
    name: 'IncExp0',
    component: IncExp0,
  },
  {
    path: '/incexp1',
    name: 'IncExp1',
    component: IncExp1,
  },
  {
    path: '/planpay',
    component: PlanPay,
  },
  {
    path: '/otherapp',
    component: OtherApp,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;

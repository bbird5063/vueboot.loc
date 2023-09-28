import { createRouter, createWebHistory } from 'vue-router';

import Main from '@/pages/Main';
import P5 from '@/pages/PageTest5';
import P6 from '@/pages/PageTest6';
import P7 from '@/pages/PageTest7';
import P8 from '@/pages/PageTest8';
import P9 from '@/pages/PageTest9';
import RowIdPage from '@/pages/RowIdPage';

const routes = [
	{
		path: '/',
		name: 'Main',
		component: Main,
	},
	{
		path: '/:authMode/:id',
		name: 'Main',
		component: Main,
	},
	{
		path: '/PageTest5',
		name: 'P5',
		component: P5,
	},
	{
		path: '/PageTest6',
		name: 'P6',
		component: P6,
	},
	{
		path: '/PageTest7',
		name: 'P7',
		component: P7,
	},
	{
		path: '/PageTest8',
		name: 'P8',
		component: P8,
	},
	{
		path: '/PageTest9',
		name: 'P9',
		component: P9,
	},
	{
		path: '/rows/:id',
		component: RowIdPage,
	},
];

const router = createRouter({
	history: createWebHistory(process.env.BASE_URL),
	routes,
});

export default router;

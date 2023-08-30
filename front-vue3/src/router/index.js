import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { ElMessage } from 'element-plus';

const router = createRouter({
  history: createWebHistory('#'),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue')
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/DashboardView.vue')
    },

  ]
})

router.beforeEach((to, from, next) => {
  if (to.name == 'login') {
    next();
  }
  else {
    const token = window.sessionStorage.getItem('token');
    const username = window.sessionStorage.getItem('username');

    if (!token || !username) {
      ElMessage({
        message: "You haven't logged in!",
        type: 'warning'
      })
      next({ name: 'login' });
    } else {
      next();
    }
  }
});

export default router

import LoginVue from '@/views/Login.vue'
import RegVue from '@/views/Reg.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/reg', component: RegVue, name: 'reg', meta: { noHeader: true } },
    { path: '/login', component: LoginVue, name: 'login', meta: { noHeader: true } },
  ],
})

router.beforeEach((to, from) => {
  const token = localStorage.getItem('token')
  if (!token || (to.name !== 'login' && to.name !== 'reg')) {
    return { name: 'login' }
  }
})

export default router

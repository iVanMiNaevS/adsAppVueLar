import LoginVue from '@/views/Login.vue'
import RegVue from '@/views/Reg.vue'
import AdsListVue from '@/views/AdsList.vue'
import { createRouter, createWebHistory } from 'vue-router'
import MyAdsVue from '@/views/MyAds.vue'
import EditAdsVue from '@/views/EditAds.vue'
import CreateAdsVue from '@/views/CreateAds.vue'
import OneAdsVue from '@/views/OneAds.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/reg', component: RegVue, name: 'reg', meta: { noHeader: true } },
    { path: '/login', component: LoginVue, name: 'login', meta: { noHeader: true } },
    { path: '/', component: AdsListVue, name: 'adsList' },
    { path: '/my-ads', component: MyAdsVue, name: 'myAds' },
    { path: '/edit/:id', component: EditAdsVue, name: 'edit' },
    { path: '/create', component: CreateAdsVue, name: 'create' },
    { path: '/ads/:id', component: OneAdsVue, name: 'oneAds' },
  ],
})

router.beforeEach((to, from) => {
  const token = localStorage.getItem('token')
  if (!token && to.name !== 'login' && to.name !== 'reg') {
    return { name: 'login' }
  }
})

export default router

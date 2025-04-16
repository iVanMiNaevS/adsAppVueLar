<template>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px">
      <h3 class="text-center mb-4">Вход в аккаунт</h3>

      <form @submit.prevent="handleLogin">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" v-model="email" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" id="password" class="form-control" v-model="password" required />
        </div>

        <button type="submit" class="btn btn-primary w-100">Войти</button>
      </form>

      <div class="text-center mt-3">
        <small>Нет аккаунта? <RouterLink to="/reg">Зарегистрируйтесь</RouterLink></small>
      </div>
    </div>
  </div>
</template>
<script setup>
import { API } from '@/config'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const router = useRouter()

async function handleLogin() {
  const response = await fetch(`${API}/login`, {
    method: 'post',
    headers: { 'Content-type': 'application/json' },
    body: JSON.stringify({ email: email.value, password: password.value }),
  })

  if (response.ok) {
    const data = await response.json()

    localStorage.setItem('token', data.token)
    router.push('/')
  }
}
</script>
<style lang=""></style>

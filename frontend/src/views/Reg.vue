<template>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px">
      <h3 class="text-center mb-4">Регистрация</h3>

      <form @submit.prevent="handleRegister">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" v-model="email" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input
            type="password"
            id="password"
            class="form-control"
            v-model="password"
            required
            minlength="6"
          />
        </div>

        <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
      </form>

      <div v-if="submitted" class="alert alert-success mt-3">
        Вы успешно зарегистрированы как <strong>{{ email }}</strong>
      </div>

      <div class="text-center mt-3">
        <small>Уже есть аккаунт? <RouterLink to="/login">Войти</RouterLink></small>
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

async function handleRegister() {
  const response = await fetch(`${API}/registration`, {
    method: 'post',
    headers: { 'Content-type': 'application/json' },
    body: JSON.stringify({ email: email.value, password: password.value }),
  })

  if (response.ok) {
    router.push('/login')
  }
}
</script>
<style lang=""></style>

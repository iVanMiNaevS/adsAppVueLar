<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router'
import { API } from './config'

const router = useRouter()

async function exit() {
  const response = await fetch(`${API}/logout`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    router.push('/login')
  }
}
</script>

<template>
  <header v-if="!$route.meta.noHeader">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <RouterLink class="nav-link active" to="/">Список Объявлений</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link active" to="/my-ads">Мои объявления</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link active" to="/create">Выложить объявление</RouterLink>
            </li>
          </ul>
          <button class="btn btn-success ms-auto" @click="exit">Выйти</button>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>

<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <!-- Изображение -->
        <img :src="ad.image_url" class="img-fluid rounded mb-4 ad-image" :alt="ad.name" />

        <!-- Название -->
        <h1 class="mb-3">{{ ad.name }}</h1>

        <!-- Цена -->
        <div class="price mb-4">{{ ad.price }} ₽</div>

        <!-- Описание -->
        <p class="lead">{{ ad.description }}</p>

        <!-- Контакты -->
        <div class="mt-5">
          <button v-if="!showEmail" class="btn btn-outline-primary" @click="showEmail = true">
            Показать контакты продавца
          </button>
          <p v-else class="mt-3 fw-semibold text-muted">Email: {{ ad.user.email }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { API } from '@/config'
import { ref } from 'vue'
import { useRoute } from 'vue-router'
const route = useRoute()

const ad = ref()
async function getAdById() {
  const response = await fetch(`${API}/ad/${route.params.id}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    const data = await response.json()
    ad.value = data.data
  }
}
getAdById()
// Контроль показа email
const showEmail = ref(false)
</script>

<style scoped>
.ad-image {
  max-height: 400px;
  object-fit: cover;
}

.price {
  font-size: 1.5rem;
  color: #28a745;
  font-weight: bold;
}
</style>

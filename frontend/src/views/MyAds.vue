<template lang="">
  <div class="container py-5">
    <h1 class="mb-4">Мои объявления</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      <!-- Карточка пользователя 1 -->
      <div class="col" v-if="ads.length > 0" v-for="ad in ads" :key="ad.id">
        <div class="card h-100 shadow-sm">
          <img
            :src="ad.image_url"
            class="card-img-top"
            alt="Товар 1"
            style="cursor: pointer; height: 200px; object-fit: cover"
            @click="$router.push(`/ads/${ad.id}`)"
          />
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ ad.name }}</h5>
            <p class="card-text">{{ ad.description }}</p>
            <div class="mt-auto">
              <div class="card-price mb-2">{{ ad.price }} ₽</div>
              <div class="card-buttons">
                <button class="btn btn-primary btn-sm">
                  <router-link class="text-light" :to="`/edit/${ad.id}`">Редактировать</router-link>
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteAd(ad.id)">Удалить</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p v-else="">У вас нет объявлений</p>
    </div>
  </div>
</template>
<script setup>
import { API } from '@/config'
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const ads = ref([])
const router = useRoute()
async function fetchMyAds() {
  const response = await fetch(`${API}/ad/by-user`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  if (response.ok) {
    const data = await response.json()
    ads.value = data.data
  }
}
async function deleteAd(id) {
  const response = await fetch(`${API}/ad/${id}`, {
    method: 'delete',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  if (response.ok) {
    fetchMyAds()
  }
}
fetchMyAds()
</script>
<style lang="css">
.card-price {
  font-weight: bold;
  color: #28a745;
}

.card-buttons {
  display: flex;
  gap: 10px;
  margin-top: 10px;
}
</style>

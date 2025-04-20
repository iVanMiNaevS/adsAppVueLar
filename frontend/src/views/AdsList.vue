<template lang="html">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Объявления</h1>
      <Notification/>
      <button @click="createAds">create</button>
      <div class="d-flex align-items-center">
        <label class="me-2" for="sortSelect">Сортировка:</label>
        <select id="sortSelect" @change="handleSort" class="form-select w-auto">
          <option value="empty" disabled selected>Выберите сортировку</option>
          <option value="asc">По возрастанию цены</option>
          <option value="desc">По убыванию цены</option>
        </select>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      <div class="col" v-for="ad in ads" :key="ad.id">
        <div class="card h-100 shadow-sm">
          <img
            :src="ad.image_url"
            class="card-img-top"
            alt="Товар 1"
            style="cursor: pointer; height: 200px; object-fit: cover"
            @click="$router.push(`/ads/${ad.id}`)"
          />
          <div class="card-body">
            <h5 class="card-title">{{ ad.name }}</h5>
            <p class="card-text">{{ ad.description }}</p>
          </div>
          <div class="card-footer">
            <strong class="text-success">{{ ad.price }}₽</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { API } from '@/config'
import { ref } from 'vue'
import Notification from "@/components/Notification.vue";

const ads = ref([])

async function createAds() {
  await fetch("http://localhost:3000/api/ads", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({'title': 'fsfds', 'description': 'fsfds'})

})}

function handleSort(e) {
  if (e.target.value === 'asc') {
    ads.value = ads.value.sort((a, b) => a.price - b.price)
  } else if (e.target.value === 'desc') {
    ads.value = ads.value.sort((a, b) => b.price - a.price)
  }
}

async function fetchAds() {
  const response = await fetch(`${API}/ad`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  if (response.ok) {
    const data = await response.json()

    ads.value = data.data.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
  }
}
fetchAds()
</script>
<style lang=""></style>

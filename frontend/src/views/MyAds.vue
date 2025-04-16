<template lang="">
    <div class="container py-5">
  <h1 class="mb-4">Мои объявления</h1>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <!-- Карточка пользователя 1 -->
    <div class="col" v-for="ad in ads" :key='ad.id'>
      <div class="card h-100 shadow-sm">
        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Товар 1">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ad.name}}</h5>
          <p class="card-text">{{ad.description}}</p>
          <div class="mt-auto">
            <div class="card-price mb-2">{{ad.price}} ₽</div>
            <div class="card-buttons">
              <button class="btn btn-primary btn-sm"><router-link class="text-light" :to="`/ads/${ad.id}`">Редактировать</router-link></button>
              <button class="btn btn-danger btn-sm" @click='deleteAd(ad.id)'>Удалить</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script setup>
import { API } from '@/config';
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const ads = ref([{ id: 1, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 },
{ id: 2, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 },
{ id: 3, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 }]);
const router = useRoute()
async function fetchMyAds() {
  const response = await fetch(`${API}/ad/by-user`, {
    headers: {
      'Authorization': localStorage.getItem('token')
    }
  })
  if (response.ok) {
    ads.value = await response.json()
  }
}
async function deleteAd(id) {
  const response = await fetch(`${API}/ad/${id}`, {
    method: 'delete',
    headers: {
      'Authorization': localStorage.getItem('token')
    }
  })
  if (response.ok) {
    console.log('delete')
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
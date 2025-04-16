<template lang="">
   <div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Объявления</h1>

    <div class="d-flex align-items-center">
      <label class="me-2" for="sortSelect">Сортировка:</label>
      <select id="sortSelect" class="form-select w-auto">
        <option value="asc">По возрастанию цены</option>
        <option value="desc">По убыванию цены</option>
      </select>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <div class="col" v-for="ad in ads" :key="ad.id">
      <div class="card h-100 shadow-sm">
        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Товар 1">
        <div class="card-body">
          <h5 class="card-title">{{ad.name}}</h5>
          <p class="card-text">{{ad.description}}</p>
        </div>
        <div class="card-footer">
          <strong class="text-success">{{ad.price}}₽</strong>
        </div>
      </div>
    </div>

  </div>
</div>
</template>
<script setup>
import { ref } from 'vue';

const ads = ref([{ id: 1, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 },
{ id: 2, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 },
{ id: 3, name: "Name", description: "fksj dlfka lkjf sl alfkjas dlk jfa ldkjf", price: 1500 }]);

async function fetchAds() {
  const response = await fetch(`${API}/ad`, {
    headers: {
      'Authorization': localStorage.getItem('token')
    }
  })
  if (response.ok) {
    ads.value = await response.json()
  }
}
</script>
<style lang="">

</style>
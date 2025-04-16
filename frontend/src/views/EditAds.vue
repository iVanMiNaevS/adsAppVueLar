<template lang="">
<div class="container py-5">
  <div class="form-container">
    <h1 class="mb-4">Редактировать объявление</h1>

    <form @submit.prevent='save'>
      <!-- Название -->
      <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" v-model='name' value="Смартфон Samsung Galaxy" required>
      </div>

      <!-- Описание -->
      <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" rows="4" v-model='description' required>Мощный и стильный телефон с AMOLED-дисплеем.</textarea>
      </div>

      <!-- Цена -->
      <div class="mb-3">
        <label for="price" class="form-label">Цена (₽)</label>
        <input type="number" class="form-control" id="price" v-model='price' value="23990" required>
      </div>

      <!-- Фото -->
      <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input class="form-control" type="file" id="image">
        <div class="mt-2">
          <img src="https://via.placeholder.com/400x250" alt="Текущее изображение" @change='handleFileChange' class="img-thumbnail" style="max-width: 200px;">
        </div>
      </div>

      <!-- Кнопки -->
      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success">Сохранить</button>
      </div>
    </form>
  </div>
</div>
</template>
<script setup>
import { API } from '@/config';
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';


const name = ref('');
const description = ref('');
const price = ref(0);
const imgFile = ref(null);

const router = useRouter();
const route = useRoute()

function handleFileChange(e) {
  const file = e.target.files[0]
  if (file) {

    imgFile.value = file
  }
}

async function getAdById() {
  const response = await fetch(`${API}/${route.params.id}`, {
    headers: {
      'Authorization': localStorage.getItem('token')
    }
  })

  if (response.ok) {
    const data = await response.json().data

    name = data.name
    description = data.description
    price = data.price
  }
}

async function save() {
  const body = {
    name: name.value,
    description: description.value,
    price: price.value,
    img_url: imgFile.value
  }
  const response = await fetch(`${API}/ad/${route.params.id}`, {
    method: 'POST',
    headers: {
      'Authorization': localStorage.getItem('token')
    },
    body: JSON.stringify(body)
  })
  if (response.ok) {
    router.push('/')
  }
}

getAdById()
</script>
<style lang="css">
.form-container {
  max-width: 700px;
  margin: 0 auto;
}
</style>
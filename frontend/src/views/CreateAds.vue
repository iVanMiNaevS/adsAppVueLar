<template lang="">
    <div class="container py-5">
  <div class="form-container">
    <h1 class="mb-4">Создать объявление</h1>

    <form @submit.prevent='save'>
      <!-- Название -->
      <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" v-model="name" id="title" placeholder="Например: iPhone 13" required>
      </div>

      <!-- Описание -->
      <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" v-model="description" rows="4" placeholder="Добавьте описание..." required></textarea>
      </div>

      <!-- Цена -->
      <div class="mb-3">
        <label for="price" class="form-label">Цена (₽)</label>
        <input type="number" class="form-control" id="price" v-model="price"placeholder="Введите цену" required>
      </div>

      <!-- Фото -->
      <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input class="form-control" type="file" id="image" @change='handleFileChange' accept="image/*">
      </div>

      <!-- Кнопки -->
      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success">Создать</button>
      </div>
    </form>
  </div>
</div>
</template>
<script setup>
import { API } from '@/config';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const name = ref('');
const description = ref('');
const price = ref(0);
const imgFile = ref(null);

const router = useRouter();

function handleFileChange(e) {
  const file = e.target.files[0]
  if (file) {

    imgFile.value = file
  }
}

async function save() {
  const body = {
    name: name.value,
    description: description.value,
    price: price.value,
    img_url: imgFile.value
  }
  const response = await fetch(`${API}/ad`, {
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
</script>
<style lang="css">
.form-container {
  max-width: 700px;
  margin: 0 auto;
}
</style>
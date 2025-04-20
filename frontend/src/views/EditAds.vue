<template lang="html">
  <div class="container py-5">
    <div class="form-container">
      <h1 class="mb-4">Редактировать объявление</h1>

      <form @submit.prevent="save">
        <!-- Название -->
        <div class="mb-3">
          <label for="title" class="form-label">Название</label>
          <input
            type="text"
            class="form-control"
            id="title"
            v-model="name"
            value="Смартфон Samsung Galaxy"
            required
          />
        </div>

        <!-- Описание -->
        <div class="mb-3">
          <label for="description" class="form-label">Описание</label>
          <textarea class="form-control" id="description" rows="4" v-model="description" required>
Мощный и стильный телефон с AMOLED-дисплеем.</textarea
          >
        </div>

        <!-- Цена -->
        <div class="mb-3">
          <label for="price" class="form-label">Цена (₽)</label>
          <input
            type="number"
            class="form-control"
            id="price"
            v-model="price"
            value="23990"
            required
          />
        </div>

        <!-- Фото -->
        <div class="mb-3">
          <label for="image" class="form-label">Изображение</label>
          <input class="form-control" @change="handleFileChange" type="file" id="image" />

          <div class="mt-2">
            <img
              :src="currentImg"
              alt="Текущее изображение"
              class="img-thumbnail"
              style="max-width: 200px"
            />
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
<script setup >
import { API } from '@/config'
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

let name = ref('')
let description = ref('')
let price = ref(0)
let imgFile = ref(null)
let currentImg = ref('')
const router = useRouter()
const route = useRoute()

function handleFileChange(e) {
  const file = e.target.files[0]
  if (file) {
    imgFile.value = file

    const reader = new FileReader()

    reader.onload = function (event) {
      currentImg.value = event.target.result // ← base64 строка
    }

    reader.readAsDataURL(file)
  }
}

async function getAdById() {
  const response = await fetch(`${API}/ad/${route.params.id}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  const response2 = await fetch(`${API}/user`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })
  console.log(response2)
  if (response.ok && response2.ok) {
    const data2 = await response2.json()
    const data = await response.json()
    if (data.data.user_id !== data2.id) {
      router.push('/')
    }
    name.value = data.data.name
    description.value = data.data.description
    price.value = data.data.price
    currentImg.value = data.data.image_url
  }
}

async function save() {
  const body = new FormData()

  body.append('name', name.value)
  body.append('description', description.value)
  body.append('price', price.value)
  if (imgFile.value != null) {
    body.append('img_url', imgFile.value)
  }

  const response = await fetch(`${API}/ad/${route.params.id}`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
    body: body,
  })
  if (response.status === 403) {
    router.push('/')
  }
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

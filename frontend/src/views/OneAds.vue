<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Изображение -->
                <img :src="ad.image" class="img-fluid rounded mb-4 ad-image" :alt="ad.title" />

                <!-- Название -->
                <h1 class="mb-3">{{ ad.title }}</h1>

                <!-- Цена -->
                <div class="price mb-4">{{ ad.price }} ₽</div>

                <!-- Описание -->
                <p class="lead">{{ ad.description }}</p>

                <!-- Контакты -->
                <div class="mt-5">
                    <button v-if="!showEmail" class="btn btn-outline-primary" @click="showEmail = true">
                        Показать контакты продавца
                    </button>
                    <p v-else class="mt-3 fw-semibold text-muted">
                        Email: {{ ad.userEmail }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { API } from '@/config'
import { ref } from 'vue'

// 🔸 Пример объявления (в реальности — получаем с API)
const ad = {
    title: 'Смартфон Samsung Galaxy',
    description: 'Мощный и стильный телефон с AMOLED-дисплеем, отличной камерой и быстрым процессором.',
    price: 23990,
    image: 'https://via.placeholder.com/800x400',
    userEmail: 'user@example.com'
}
async function getAdById() {
    const response = await fetch(`${API}/${route.params.id}`, {
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    })

    if (response.ok) {
        const data = await response.json().data

        ad.value = data
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
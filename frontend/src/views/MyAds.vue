<template lang="">
    <div class="container py-5">
  <h1 class="mb-4">Мои объявления</h1>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

    <!-- Карточка пользователя 1 -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Товар 1">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Смартфон Samsung Galaxy</h5>
          <p class="card-text">Мощный и стильный телефон с AMOLED-дисплеем.</p>
          <div class="mt-auto">
            <div class="card-price mb-2">23 990 ₽</div>
            <div class="card-buttons">
              <button class="btn btn-primary btn-sm">Редактировать</button>
              <button class="btn btn-danger btn-sm">Удалить</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Карточка пользователя 2 -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Товар 2">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Ноутбук Lenovo IdeaPad</h5>
          <p class="card-text">Универсальный ноутбук для работы и учебы.</p>
          <div class="mt-auto">
            <div class="card-price mb-2">45 000 ₽</div>
            <div class="card-buttons">
              <button class="btn btn-primary btn-sm">Редактировать</button>
              <button class="btn btn-danger btn-sm">Удалить</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Карточка пользователя 3 -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Товар 3">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">Кофемашина Philips</h5>
          <p class="card-text">Автоматическая кофемашина для дома.</p>
          <div class="mt-auto">
            <div class="card-price mb-2">12 500 ₽</div>
            <div class="card-buttons">
              <button class="btn btn-primary btn-sm">Редактировать</button>
              <button class="btn btn-danger btn-sm">Удалить</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</template>
<script setup>

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
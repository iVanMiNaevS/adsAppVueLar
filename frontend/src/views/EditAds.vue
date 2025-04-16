<template lang="">
<div class="container py-5">
  <div class="form-container">
    <h1 class="mb-4">Редактировать объявление</h1>

    <form>
      <!-- Название -->
      <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" value="Смартфон Samsung Galaxy" required>
      </div>

      <!-- Описание -->
      <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" rows="4" required>Мощный и стильный телефон с AMOLED-дисплеем.</textarea>
      </div>

      <!-- Цена -->
      <div class="mb-3">
        <label for="price" class="form-label">Цена (₽)</label>
        <input type="number" class="form-control" id="price" value="23990" required>
      </div>

      <!-- Фото -->
      <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input class="form-control" type="file" id="image">
        <div class="mt-2">
          <img src="https://via.placeholder.com/400x250" alt="Текущее изображение" class="img-thumbnail" style="max-width: 200px;">
        </div>
      </div>

      <!-- Кнопки -->
      <div class="d-flex justify-content-between mt-4">
        <a href="my-ads.html" class="btn btn-secondary">Отмена</a>
        <button type="submit" class="btn btn-success">Сохранить</button>
      </div>
    </form>
  </div>
</div>
</template>
<script>

</script>
<style lang="css">
.form-container {
    max-width: 700px;
    margin: 0 auto;
}
</style>
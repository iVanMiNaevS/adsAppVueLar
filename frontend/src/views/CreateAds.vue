<template lang="">
    <div class="container py-5">
  <div class="form-container">
    <h1 class="mb-4">Создать объявление</h1>

    <form>
      <!-- Название -->
      <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input type="text" class="form-control" id="title" placeholder="Например: iPhone 13" required>
      </div>

      <!-- Описание -->
      <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control" id="description" rows="4" placeholder="Добавьте описание..." required></textarea>
      </div>

      <!-- Цена -->
      <div class="mb-3">
        <label for="price" class="form-label">Цена (₽)</label>
        <input type="number" class="form-control" id="price" placeholder="Введите цену" required>
      </div>

      <!-- Фото -->
      <div class="mb-3">
        <label for="image" class="form-label">Изображение</label>
        <input class="form-control" type="file" id="image" accept="image/*">
      </div>

      <!-- Кнопки -->
      <div class="d-flex justify-content-between mt-4">
        <a href="my-ads.html" class="btn btn-secondary">Отмена</a>
        <button type="submit" class="btn btn-success">Создать</button>
      </div>
    </form>
  </div>
</div>
</template>
<script>
export default {

}
</script>
<style lang="css">
.form-container {
    max-width: 700px;
    margin: 0 auto;
}
</style>
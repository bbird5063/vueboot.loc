<template>
  <div>
    <!-- $route - мы получаем некую информацию о пути -->
    <!-- зная ID, мы можем получить информаю о посте с бэкэнда -->
    <h1>Страница строки с ID = {{ $route.params.id }}</h1>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>

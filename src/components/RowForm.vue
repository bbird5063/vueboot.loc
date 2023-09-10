<template>
  <form @submit.prevent>
    <h4>Создание поста</h4>
    <my-input v-focus v-model="row.title" type="text" placeholder="Название" />
    <my-input v-model="row.body" type="text" placeholder="Описание" />
    <my-button
      style="align-self: flex-end; margin-top: 15px"
      @click="createRow"
    >
      Создать
    </my-button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      row: {
        id: null, // BBR
        title: '',
        body: '',
      },
    };
  },
  methods: {
    createRow(event) {
      // новый пост создавать не надо, он уже есть, нет id
      this.row.id = Date.now(); // BBR: было this.row.id = Date.now()
      //this.rows.push(newRow); // добавляем к массиву rows, не подходит - мы в дочернем компоненте
      this.$emit('create', this.row); // 1-имя события, 2,3,...-то, что хотим передать
      this.row = {
        // после передачи - очищаем
        id: null, // BBR
        title: '',
        body: '',
      };
    },
  },
};
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
}
</style>

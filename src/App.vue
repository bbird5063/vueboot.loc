<template>
  <navbar></navbar>
  <h1>{{ $store.state.auth.likes }}</h1>
  <div class="app">
    <!-- <router-view> - в него будут встраиваться компоненты из router.js -->
    <router-view></router-view>
    <!-- Кнопка-триггер модального окна -->
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#login-signup-modal"
    >
      Запустите демо модального окна
    </button>
    <auth-form></auth-form>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import AuthForm from '@/components/register/AuthForm';

export default {
  components: {
    Navbar,
    AuthForm,
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.app {
  padding: 20px;
}

.app_btns {
  display: flex;
  /* кнопка и список напротив друга  */
  justify-content: space-between;
  align-items: center;
  margin: 0;
}

table,
td,
th {
  border-collapse: collapse;
  border: 3px solid #245488;
}
td {
  padding: 5px;
}

.page__wrapper {
  display: flex;
  margin-top: 15px;
  align-items: center;
}
.page {
  border: 1px solid black;
  padding: 10px;
  cursor: pointer;
}
.current-page {
  border: 2px solid teal;
  cursor: pointer;
}
</style>

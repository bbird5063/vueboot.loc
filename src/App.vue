<template>
  <navbar></navbar>
  <div class="app">
    <!-- <router-view> - в него будут встраиваться компоненты из router.js -->
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';

export default {
  components: {
    Navbar,
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

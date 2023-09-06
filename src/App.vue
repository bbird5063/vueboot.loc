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

table,
td,
th {
  border-collapse: collapse;
  border: 3px solid #245488;
  padding: 5px;
}
</style>

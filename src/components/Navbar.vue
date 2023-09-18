<template>
  <!-- <div class="navbar"> -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" @click="$router.push('/')">HS</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Переключатель навигации"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li v-for="point in menu" class="nav-item">
            <a
              class="nav-link"
              :class="{ active: point.name == currentPoint }"
              href="#"
              @click.prevent="activePoint(point)"
              >{{ point.name }}</a
            >
          </li>
          <li v-if="$store.state.auth.dataUser" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Link
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li v-else class="nav-item navbar-right">
            <a class="nav-link" href="#">Вход</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- </div> -->
</template>

<script>
export default {
  data() {
    return {
      currentPoint: '',
      likes: 128,
      menu: [
        { path: '/p5', name: 'P5' },
        { path: '/p6', name: 'P6' },
        { path: '/p7', name: 'P7' },
        { path: '/p8', name: 'P8' },
        { path: '/p9', name: 'P9' },
      ],
    };
  },
  methods: {
    activePoint(point) {
      this.$router.push(point.path);
      this.currentPoint = point.name;
    },
  },
};
</script>

<style scoped></style>

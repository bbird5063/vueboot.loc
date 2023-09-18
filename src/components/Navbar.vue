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
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarScrollingDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              User
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li>
                <a
                  @click.prevent="openAuthModal('user-modal-content')"
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#login-signup-modal"
                  >Профиль</a
                >
              </li>
              <li>
                <a
                  @click.prevent="
                    openAuthModal('forgot-password-modal-content')
                  "
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#login-signup-modal"
                  >Изменить пароль</a
                >
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a
                  @click.prevent="openAuthModal('exit-modal-content')"
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#login-signup-modal"
                  >Выход</a
                >
              </li>
            </ul>
          </li>
          <li v-else class="nav-item navbar-right">
            <a
              @click.prevent="openAuthModal('login-modal-content')"
              class="nav-link"
              href="#"
              data-bs-toggle="modal"
              data-bs-target="#login-signup-modal"
              >Вход</a
            >
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
    openAuthModal(authModal) {
      this.$store.commit('auth/setCurrModal', authModal);
      /*
      // const modal = document.querySelector('#login-signup-modal');
      const modal = new bootstrap.Modal(
        document.querySelector('#login-signup-modal')
      );
      modal.show();
      */
      // console.log('=======================');
      /*
      document.addEventListener('DOMContentLoaded', function () {
        console.log('---------------');
        // получим кнопку id="btn" с помощью которой будем открывать модальное окно
        // const btn = document.querySelector('#btn');
        // активируем контент id="modal" как модальное окно
        const modal = new bootstrap.Modal(
          document.querySelector('#login-signup-modal')
        );
        // при нажатии на кнопку
        // btn.addEventListener('click', function() {
        // открываем модальное окно

        console.log(modal);
        modal.show();
        // });
      });
      */
    },
  },
};
</script>

<style scoped></style>

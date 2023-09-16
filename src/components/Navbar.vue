<template>
  <!-- <div class="navbar"> -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" @click="$router.push('/')">HS</a>
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
          <li class="nav-item">
            <a
              class="nav-link active"
              href="#"
              aria-current="page"
              @click.prevent="$router.push('/p0')"
              >P0</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p1')"
              >P1</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p2')"
              >P2</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p3')"
              >P3</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p4')"
              >P4</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p5')"
              >P5</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p6')"
              >P6</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p7')"
              >P7</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p8')"
              >P8</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$router.push('/p9')"
              >P9</a
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- </div> -->
</template>

<script>
export default {};
</script>

<style scoped>
/* .navbar {
  height: 50px;
  background-color: lightgray;
  box-shadow: 2px 2px 4px gray;
  display: flex;
  align-items: center;
  padding: 0 15px;
}
.navbar__btns {
  margin-left: auto;
}

my-button {
  cursor: pointer;
} */
</style>

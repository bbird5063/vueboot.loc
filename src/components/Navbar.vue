<template>
  <div class="navbar">
    <div style="cursor: pointer" @click="$router.push('/')">HS</div>
    <div class="navbar__btns">
      <my-button style="margin-left: 10px" @click="$router.push('/plan')"
        >План</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p0')"
        >P0</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p1')"
        >P1</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p2')"
        >P2</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p3')"
        >P3</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p4')"
        >P4</my-button
      >
      <my-button style="margin-left: 10px" @click="$router.push('/p5')"
        >P5</my-button
      >
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.navbar {
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
}
</style>

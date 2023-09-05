<template>
  <div class="navbar">
    <div style="cursor: pointer" @click="$router.push('/')">HS</div>
    <div class="navbar__btns">
      <my-button @click="$router.push('/ajaxcomponent')"
        >AjaxComponent</my-button
      >
      <my-button style="margin-left: 20px" @click="$router.push('/incexp0')"
        >Inc/Exp0</my-button
      >
      <my-button style="margin-left: 20px" @click="$router.push('/incexp1')"
        >Inc/Exp1</my-button
      >
      <my-button style="margin-left: 20px" @click="$router.push('/planpay')"
        >План</my-button
      >
      <my-button style="margin-left: 20px" @click="$router.push('/otherapp')"
        >Прочее</my-button
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

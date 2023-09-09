<template>
  <!-- Родительский див на весь экран. Он черный и прозрачный -->
  <!-- При клике на нем - окно скрывается (@click.stop="hideDialog") -->
  <transition-group name="spab">
    <div class="dialog" v-if="show" @click.stop="hideDialog">
      <!-- При клике на дочернем - ничего не происходит (@click.stop) -->
      <div @click.stop class="dialog__content">
        <!-- В <slot> -> <row-form> -->
        <slot></slot>
      </div>
    </div>
  </transition-group>
</template>

<script>
export default {
  name: 'my-dialog',
  props: {
    /* от <my-dialog v-model:show="dialodVisible"> */
    show: {
      type: Boolean,
      default: false,
    },
  },

  methods: {
    hideDialog() {
      /* 
      <my-dialog v-model:show="dialodVisible"> //"dialodVisible" - это модель, а не функция 
      v-model - двусторонняя связь, поэтомуЫ модель "dialodVisible" можно изменять 
      и в родительком (через клике на кнопке "создать" - функция, 
      в которой dialodVisible = true) 
      и в дочернем (через .$emit) компоненте
      */
      this.$emit('update:show', false); // при клике вне модального
    },
  },
};
</script>

<style scoped>
.dialog {
  /* типа фон: черный, прозрачный, на весь экран */
  display: flex;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
}

.dialog__content {
  /* типа само окно: белое */
  margin: auto;
  background: white;
  border-radius: 12px;
  min-height: 50px;
  min-width: 300px;
  padding: 20px;
}
/* АНИМАЦИЯ: */
.spab-item {
  display: inline-block;
  margin-right: 10px;
}
.spab-enter-active,
.spab-leave-active {
  transition: all 0.4s ease;
}
.spab-enter-from,
.spab-leave-to {
  opacity: 0;
  transform: translateY(-130px);
}
.spab-move {
  transition: transform 0.4s ease;
}
</style>

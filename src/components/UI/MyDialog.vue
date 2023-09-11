<template>
  <div class="dialog" v-if="show" @click.stop="hideDialog">
    <div @click.stop class="dialog__content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
import toggleMixin from '@/mixins/toggleMixin';
export default {
  name: 'my-dialog',
  mixins: [toggleMixin],
  mounted() {
    console.log('my-dialog'); // для проверки
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
</style>

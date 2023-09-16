export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
    showContent: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    hideDialog() {
      this.$emit('update:show', false);
    },
  },
  mounted() {
    // setTimeout(() => (this.showContent = true), 5000);
    console.log('mixin mounted'); // для проверки
  },
};

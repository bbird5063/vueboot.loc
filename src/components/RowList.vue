<template>
  <div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="active">
          <th style="width: 5%">ID</th>
          <th style="width: 20%">Название</th>
          <th style="width: 55%">Описание</th>
          <th style="width: 20%"></th>
        </tr>
      </thead>

      <tbody>
        <transition-group name="spab">
          <row-item
            :row="row"
            v-for="row in rows"
            :key="row.id"
            @remove="$emit('remove', row)"
          />
        </transition-group>
      </tbody>
    </table>
  </div>
</template>

<script>
import RowItem from '@/components/RowItem';
export default {
  components: { RowItem },
  props: {
    rows: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>
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

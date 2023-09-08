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
        <row-item
          :row="row"
          v-for="row in rows"
          :key="row.id"
          @remove="$emit('remove', row)"
        />
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

<style scoped></style>

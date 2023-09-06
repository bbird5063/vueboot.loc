<template>
  <div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="active">
          <th style="width: 10%">ID</th>
          <th style="width: 20%">Название</th>
          <th style="width: 70%">Описание</th>
        </tr>
      </thead>

      <tbody>
        <row-item :row="row" v-for="row in rows" />
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

<style></style>

<template>
  <div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="active">
          <th style="width: 20%">Surname</th>
          <th style="width: 20%">Name</th>
          <th style="width: 20%">Patronymic</th>
          <th style="width: 15%">Nickname</th>
          <th style="width: 10%">Birth</th>
          <th style="width: 15%">eMail</th>
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

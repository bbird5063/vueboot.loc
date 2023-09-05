<template>
  <tr>
    <td>{{ row.Surname }}</td>
    <td>{{ row.Name }}</td>
    <td>{{ row.Patronymic }}</td>
    <td>{{ row.Nickname }}</td>
    <td>{{ row.Birth }}</td>
    <td>{{ row.eMail }}</td>
  </tr>
</template>

<script>
export default {
  props: {
    row: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style></style>

<template>
  <tr>
    <td>{{ row.id }}</td>
    <td>{{ row.title }}</td>
    <td>{{ row.body }}</td>
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

<template>
	<tr>
		<td>{{ row.id }}</td>
		<td>{{ row.title }}</td>
		<td>{{ row.body }}</td>
		<td>
			<my-button @click="$router.push(`/rows/${row.id}`)">Открыть</my-button>
			<my-button @click="$emit('remove', row)">Удалить</my-button>
		</td>
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

<style scoped></style>

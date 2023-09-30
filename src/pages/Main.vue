<template>
	<div>
		<table>
			<thead>
				<tr class="active">
					<th style="width: 20%">Страница</th>
					<th style="width: 80%">Описание</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>P1</td>
					<td>
						До декомпозиции. Один компонент. <br />
						Используется 'my-button'
					</td>
				</tr>
				<tr>
					<td>P2</td>
					<td>Декомпозиция</td>
				</tr>
				<tr>
					<td>P3</td>
					<td>
						1. Изменил контроллер (controller_rows.php):<br />
						'$data['rows'][] = $row' -> '$data[] = $row';<br />
						2. Добавляем 'mounted() {this.loadRows()...'; <br />
						3. Модальное окно для добавления;<br />
						4. Добавление в таблицу: controller_insert.php;<br />
						5. Удаление из таблицы: controller_delete.php;<br />
						6. Сортировка в watch;<br />
					</td>
				</tr>
				<tr>
					<td>P4</td>
					<td>
						1. Сортировка в computed;<br />
						2. Анимация добавления и удаления строк;<br />
						3. Анимация появления и скрывания модального окна;<br />
						4. watch: глубокое отслеживание!;<br />
						5. Динамический биндинг классов и стилей;<br />
						--------------------------------------------<br />
						1. При добавлении - нет ID;<br />
						2. При добавлении и удалении - неправильная пагинация;<br />
					</td>
				</tr>
				<tr>
					<td>P5</td>
					<td>1. лента с подгрузкой;<br /></td>
				</tr>
				<tr>
					<td>P6</td>
					<td>
						1. Добавили directives\Vintersection.js;<br />
						В нее вынесли отслеживание появление observer в зоне видимости;<br />
						2. Создаем собственные директивы V-INTERSECTION и V-FOCUS;<br />
						--------------------------------------------<br />
						1. Вначале загружает две страницы;<br />
					</td>
				</tr>
				<tr>
					<td>P7</td>
					<td>1. Vuex. Глобальное состояние приложения; <br /></td>
				</tr>
				<tr>
					<td>P8</td>
					<td>1. Vuex. Все работает; <br /></td>
				</tr>
				<tr>
					<td>P9</td>
					<td>1. Composition API<br /></td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex';	
export default {
	data() {
		return {}
	},
	methods: {
		...mapActions({
			fadeOut: 'auth/fadeOut',
			fadeIn: 'auth/fadeIn',
		}),
	},
	mounted() {
		if (this.$route.params.id.length > 1) {
			// alert('Main.vue = ' + this.$route.params.id);

			// this.$emit('openModal', 'code-modal-content');
			this.fadeIn('#code-modal-content');
			this.$store.commit('auth/setCurrModal', '#code-modal-content');
			this.$store.commit('auth/setAuthMode', this.$route.params.authMode);
			
		}
	},
};
</script>

<style scoped></style>

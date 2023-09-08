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
      </tbody>
    </table>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>

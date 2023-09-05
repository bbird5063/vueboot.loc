<template>
  <div>
    <button class="btn btn-primary" @click="loadRows" v-if="!is_refresh">
      Загрузить таблицу
    </button>

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
        <tr v-for="row in rows">
          <td>{{ row.Surname }}</td>
          <td>{{ row.Name }}</td>
          <td>{{ row.Patronymic }}</td>
          <td>{{ row.Nickname }}</td>
          <td>{{ row.Birth }}</td>
          <td>{{ row.eMail }}</td>
        </tr>
      </tbody>
    </table>

    <span v-if="isLoading">Обновляем...</span>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      rows: [
        {
          Surname: 'Иванов',
          Name: 'Иван',
          Patronymic: 'Иванович',
          Nickname: 'Ива',
          Birth: '23.05.1996',
          eMail: 'ivan@mail.ua',
        },
        {
          Surname: 'Петров',
          Name: 'Петр',
          Patronymic: 'Петрович',
          Nickname: 'Петр 1',
          Birth: '24.05.1989',
          eMail: 'petya@mail.ua',
        },
        {
          Surname: 'Сидоров',
          Name: 'Сидор',
          Patronymic: 'Сидорович',
          Nickname: 'Сидор',
          Birth: '27.07.1977',
          eMail: 'sidor@mail.ua',
        },
        {
          Surname: 'Иванов',
          Name: 'Иван',
          Patronymic: 'Иванович',
          Nickname: 'Ива',
          Birth: '23.05.1996',
          eMail: 'email@mail.ua',
        },
        {
          Surname: 'Иванов',
          Name: 'Иван',
          Patronymic: 'Иванович',
          Nickname: 'Ива',
          Birth: '23.05.1996',
          eMail: 'email@mail.ua',
        },
      ],
      isLoading: false,
      page: 1, //
      _limit: 10, //
      totalPages: 0, //
      post: '_page=0&_limit=10', //
      get: { params: { _page: 0, _limit: 10 } },
      url: '/php_modules/controller_user.php',
      result: '', //
    };
  },
  methods: {
    async loadRows() {
      if (
        location.hostname.includes('192.168.0.100') ||
        location.hostname.includes('localhost')
      ) {
        return alert(
          'Сайт в режиме разработки. \nДля доступа к базе данных запустите локальный сервер с поддержкой PHP.'
        );
      }
      try {
        this.isLoading = true;
        const response = await axios.get(this.url, this.get);
        /*const response = await axios.get(
          'https://jsonplaceholder.typicode.com/posts?__limit=10'
        );*/
        this.rows = [];
        this.rows = response.data.rows;
        this.get['params']['_page'] += this.get['params']['_limit'];

        this.result = response.data.rows;
        console.table(response.data.rows);
        console.log(response.data.params);
      } catch (e) {
        alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
      } finally {
        this.isLoading = false;
      }
    },
  },
};
</script>

<style></style>

<template>
  <div>
    <button class="btn btn-primary" @click="loadRows" v-if="!is_refresh">
      Загрузить таблицу
    </button>
    <row-list :rows="rows" />
    <span v-if="isLoading">Обновляем...</span>
  </div>
</template>

<script>
import RowList from '@/components/RowList';
import axios from 'axios';
export default {
  components: { RowList },
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
      limit: 10, //
      totalPages: 0, //
      post: 'offset=0&limit=10', //
      get: { params: { offset: 0, limit: 10 } },
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
          'https://jsonplaceholder.typicode.com/posts?_limit=10'
        );*/
        // this.rows = [];
        // this.rows = response.data.rows;
        console.log(this.rows);
        console.log(response.data.rows);
        this.rows.push(response.data.rows);
        this.get['params']['offset'] += this.get['params']['limit'];

        //this.result = response.data.rows;

        //console.log(response.data.params);
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

<template>
  <div>
    <button class="btn btn-primary" @click="loadRows" v-if="!isLoading">
      Загрузить таблицу
    </button>
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="active">
          <th style="width: 10%">ID</th>
          <th style="width: 20%">Название</th>
          <th style="width: 70%">Описание</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="row in rows">
          <td>{{ row.id }}</td>
          <td>{{ row.title }}</td>
          <td>{{ row.body }}</td>
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
          id: 1000,
          title: 'Название...',
          body: 'Описание...',
        },
        {
          id: 1001,
          title: 'Название...',
          body: 'Описание...',
        },
      ],
      isLoading: false,
      isTest: true,
      page: 1, //
      limit: 10, //
      totalPages: 0, //
      post: '_page=0&_limit=10', //
      get: { params: { offset: 0, limit: 10 } },
      getTest: { params: { _page: 1, _limit: 10 } },
      url: '/php_modules/controller_posts.php',
      urlTest: 'https://jsonplaceholder.typicode.com/posts',
    };
  },
  methods: {
    async loadRows() {
      if (
        location.hostname.includes('192.168.0.100') ||
        location.hostname.includes('localhost')
      ) {
        this.isTest = true;
      } else {
        this.isTest = false;
      }

      try {
        this.isLoading = true;
        let url = this.isTest ? this.urlTest : this.url;
        let get = this.isTest ? this.getTest : this.get;
        const response = await axios.get(url, get);
        this.rows = [];
        this.rows = this.isTest ? response.data : response.data.rows;
        this.isTest
          ? (this.getTest['params']['_page'] += 1)
          : (this.get['params']['offset'] += this.get['params']['limit']);

        console.log(this.isTest ? response.data : response.data.rows);
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

<template>
  <div>
    <my-button @click="loadRows" v-if="!isLoading">
      Загрузить таблицу
    </my-button>
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
      rows: [],
      isLoading: false,
      isTest: true,
      page: 1, //
      limit: 10, //
      totalPages: 0,
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
        console.log(response.headers['x-total-count']);
        this.totalPages = Math.ceil(
          response.headers['x-total-count'] / this.getTest.params._limit
        );
        let postRows = this.isTest ? response.data : response.data.rows;
        this.rows = [...this.rows, ...postRows];
        this.isTest
          ? (this.getTest.params._page += 1)
          : (this.get.params.offset += this.get.params.limit);

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

<style scoped></style>

<template>
  <div>
    <h1>Страница с постами</h1>
    <my-button @click="showDialog" style="margin: 15px 0">
      Создать пользователя
    </my-button>
    <my-dialog v-model:show="dialodVisible">
      <row-form @create="createRow" />
    </my-dialog>
    <row-list :rows="rows" @remove="removeRow" />
    <span v-if="isLoading">Обновляем...</span>
  </div>
</template>

<script>
import RowList from '@/components/RowList';
import RowForm from '@/components/RowForm';
import axios from 'axios';
export default {
  components: { RowList, RowForm },
  data() {
    return {
      rows: [],
      dialodVisible: false, // создали директиву
      isLoading: false,
      isTest: true,
      page: 1, //
      limit: 10, //
      totalPages: 0, //
      post: '_page=0&_limit=10', //
      get: { params: { offset: 0, limit: 10 } },
      getTest: { params: { _page: 1, _limit: 10 } },
      url: '/php_modules/controller_rows.php',
      urlTest: 'https://jsonplaceholder.typicode.com/posts',
    };
  },
  methods: {
    async createRow(row) {
      if (!this.isTest) {
        let url = '/php_modules/controller_insert.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        row.id = response.data.id;
      }
      this.rows.push(row);
      this.dialodVisible = false;
    },
    async removeRow(row) {
      if (!this.isTest) {
        let url = '/php_modules/controller_delete.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        console.log(response.data.result);
      }
      this.rows = this.rows.filter(p => p.id !== row.id); // filter создает новый массив
    },
    showDialog() {
      this.dialodVisible = true;
    },

    async loadRows() {
      try {
        this.isLoading = true;
        let url = this.isTest ? this.urlTest : this.url;
        let get = this.isTest ? this.getTest : this.get;
        const response = await axios.get(url, get);
        console.log(response.headers['x-total-count']);
        console.log(response.data.cnt_rows);

        this.totalPages = this.isTest
          ? Math.ceil(
              response.headers['x-total-count'] / this.getTest.params._limit
            )
          : Math.ceil(response.data.cnt_rows / this.get.params.limit);

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
  mounted() {
    if (
      location.hostname.includes('192.168.0.100') ||
      location.hostname.includes('localhost')
    ) {
      this.isTest = true;
    } else {
      this.isTest = false;
    }

    this.loadRows();
  },
};
</script>

<style scoped></style>

<template>
  <div>
    <h1>Страница с постами</h1>
    <my-input v-model="searchQuery" placeholder="Поиск..." />
    <div class="app_btns">
      <my-button @click="showDialog" style="margin: 15px 0">
        Создать пользователя
      </my-button>

      <!-- 
        1. v-model="selectedSort".  v-model:value = selectedSort - через $emit
        2. :options="sortOption". байдим options - пропс массив, который ждет MySelect (по нему будет v-for). sortOption - массив, который определяем здесь
       -->
      <my-select v-model="selectedSort" :options="sortOption" />
    </div>
    <my-dialog v-model:show="dialodVisible">
      <row-form @create="createRow" />
    </my-dialog>
    <row-list :rows="sortedAndSearchedPosts" @remove="removeRow" />
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
      selectedSort: '',
      isReverse: false,
      searchQuery: '',
      sortOption: [
        // массив option для нашего select
        { value: 'id', name: 'По порядку добавления' },
        { value: 'title', name: 'По названию' },
        { value: 'body', name: 'По содержанию' },
      ],
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

  watch: {},

  computed: {
    sortedRows() {
      if (this.selectedSort === 'id') {
        // числовое поле
        let sortRows = [...this.rows];
        sortRows = this.rows.sort(
          (row1, row2) => row1[this.selectedSort] - row2[this.selectedSort]
        );
        if (this.isReverse) sortRows.reverse();
        this.isReverse = !this.isReverse;
        return sortRows;
      } else {
        return [...this.rows].sort((row1, row2) =>
          row1[this.selectedSort]?.localeCompare(row2[this.selectedSort])
        );
      }
    },

    sortedAndSearchedPosts() {
      return this.sortedRows.filter(post =>
        post.title.includes(this.searchQuery)
      );
    },
  },
};
</script>

<style scoped></style>

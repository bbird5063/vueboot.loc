<template>
  <div>
    <h1>Страница с постами</h1>
    <my-input v-model="searchQuery" placeholder="Поиск..." />
    <div class="app_btns">
      <my-button @click="showDialog" style="margin: 15px 0">
        Создать пользователя
      </my-button>
      <span v-if="isLoading">Обновляем...</span>
      <my-select v-else v-model="selectedSort" :options="sortOption" />
    </div>
    <my-dialog v-model:show="dialodVisible">
      <row-form @create="createRow" />
    </my-dialog>
    <br />
    <row-list :rows="sortedAndSearchedRows" @remove="removeRow" />
    <div v-intersection="loadMoreRows" class="observer"></div>
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
      page: 0,
      limit: 10,
      totalRows: 1,
      totalPages: 1,
      get: { params: { offset: 0, limit: 10 } },
      getTest: { params: { _page: 1, _limit: 10 } },
      url: '/php_modules/controller_rows.php',
      urlTest: 'https://jsonplaceholder.typicode.com/posts',
      selectedSort: '',
      isReverse: false,
      searchQuery: '',
      sortOption: [
        { value: 'id', name: 'По порядку добавления' },
        { value: 'title', name: 'По названию' },
        { value: 'body', name: 'По содержанию' },
      ],
    };
  },
  methods: {
    async createRow(row) {
      if (this.isTest) {
        this.totalPages++;
      } else {
        let url = '/php_modules/controller_insert.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        row.id = response.data.id;
        this.totalPages = Math.ceil(this.cnt_rows / this.get.params.limit);
      }
      this.totalPages = this.isTest;
      this.rows.push(row);
      this.dialodVisible = false;
    },

    async removeRow(row) {
      if (this.isTest) {
        this.totalRows--;
        this.totalPages = Math.ceil(
          this.totalRows / this.getTest.params._limit
        );
      } else {
        let url = '/php_modules/controller_delete.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        this.totalRows = response.data.cnt_rows;
        this.totalPages = Math.ceil(this.totalRows / this.get.params.limit);
      }

      this.rows = this.rows.filter(p => p.id !== row.id); // filter создает новый массив
    },

    showDialog() {
      this.dialodVisible = true;
    },

    changePage(pageNumber) {
      this.page = pageNumber;
      this.getTest.params._page = pageNumber;
      this.get.params.offset = (pageNumber - 1) * this.get.params.limit;
    },
    async loadMoreRows() {
      try {
        // this.isLoading = true;
        this.page++;
        this.getTest.params._page = this.page;
        this.get.params.offset = (this.page - 1) * this.get.params.limit;

        let url = this.isTest ? this.urlTest : this.url;
        let get = this.isTest ? this.getTest : this.get;
        const response = await axios.get(url, get);

        if (this.isTest) {
          this.rows = [...this.rows, ...response.data];
        } else if (response.data.rows) {
          this.rows = [...this.rows, ...response.data.rows];
        }

        if (this.isTest) {
          this.totalRows = response.headers['x-total-count'];
          this.totalPages = Math.ceil(
            this.totalRows / this.getTest.params._limit
          );
        } else {
          this.totalRows = response.data.cnt_rows;
          this.totalPages = Math.ceil(this.totalRows / this.get.params.limit);
        }
      } catch (e) {
        alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
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

    this.loadMoreRows();
  },

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

    sortedAndSearchedRows() {
      return this.sortedRows.filter(post =>
        post.title.includes(this.searchQuery)
      );
    },
  },
};
</script>

<style scoped>
.observer {
  height: 10px;
  background: grey;
}
</style>

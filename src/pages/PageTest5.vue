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
      <span v-if="isLoading">Обновляем...</span>
      <my-select v-else v-model="selectedSort" :options="sortOption" />
    </div>
    <my-dialog v-model:show="dialodVisible">
      <row-form @create="createRow" />
    </my-dialog>
    <br />
    <!-- <div class="page__wrapper">
      <div
        class="page"
        v-for="pageNumber in totalPages"
        :key="page"
        :class="{ 'current-page': page === pageNumber }"
        @click="changePage(pageNumber)"
      >
        {{ pageNumber }}
      </div>
    </div> -->
    <row-list :rows="sortedAndSearchedPosts" @remove="removeRow" />
    <div ref="observer" class="observer"></div>
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
      page: 1,
      limit: 10,
      totalRows: 1,
      totalPages: 1,
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
      // console.log(row);
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

    async loadRows() {
      try {
        this.isLoading = true;
        let url = this.isTest ? this.urlTest : this.url;
        let get = this.isTest ? this.getTest : this.get;
        const response = await axios.get(url, get);

        this.rows = this.isTest ? response.data : response.data.rows;

        this.page++;
        this.getTest.params._page = this.page;
        this.get.params.offset = (this.page - 1) * this.get.params.limit;

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
      } finally {
        this.isLoading = false;
      }
    },

    async loadMoreRows() {
      try {
        // this.isLoading = true;
        let url = this.isTest ? this.urlTest : this.url;
        let get = this.isTest ? this.getTest : this.get;
        const response = await axios.get(url, get);

        this.rows = this.isTest
          ? [...this.rows, ...response.data]
          : [...this.rows, ...response.data.rows];

        this.page++;
        this.getTest.params._page = this.page;
        this.get.params.offset = (this.page - 1) * this.get.params.limit;

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

    this.loadRows();
    console.log(this.$refs.observer);
    const options = {
      rootMargin: '0px',
      threshold: 1.0,
    };

    console.log(this.page);
    console.log(this.totalPages);

    const callback = (entries, observer) => {
      console.log(entries[0].isIntersecting);
      // только стрелочная. при function не будет доступна loadMorePosts()
      if (entries[0].isIntersecting && this.page < this.totalPages) {
        this.loadMoreRows();
      }
    };
    const observer = new IntersectionObserver(callback, options);
    observer.observe(this.$refs.observer); // передаем ссылку на нужный DOM-элемент
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

    sortedAndSearchedPosts() {
      return this.sortedRows.filter(post =>
        post.title.includes(this.searchQuery)
      );
    },
  },
};
</script>

<style scoped>
.observer {
  /* при работе этот <div> невидимый
  display: none; */
  height: 10px;
  background: grey;
}
</style>

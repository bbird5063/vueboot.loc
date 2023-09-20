<template>
  <div>
    <h1>Страница с постами</h1>
    <my-input
      :model-value="searchQuery"
      @update:model-value="setSearchQuery"
      placeholder="Поиск..."
    />

    <div class="app_btns">
      <my-button @click="showDialog" style="margin: 15px 0">
        Создать пост
      </my-button>

      <my-select
        :model-value="selectedSort"
        @update:model-value="setSelectedSort"
        :options="sortOption"
      />
    </div>
    <my-dialog v-model:show="dialodVisible">
      <row-form @create="createRow" />
    </my-dialog>

    <br />
    <row-list
      :rows="sortedAndSearchedRows"
      @remove="removeRow"
      v-if="!isLoading"
    />

    <div v-else>Идет загрузка...</div>
    <!-- v-if="!isLoading" - ЧТОБЫ В НАЧАЛЕ НЕ ЗАГРУЖАЛАСЬ ВТОРАЯ СТРАНИЦА -->
    <div v-if="!isLoading" v-intersection="loadMoreRows" class="observer"></div>
  </div>
</template>

<script>
import RowList from '@/components/RowList';
import RowForm from '@/components/RowForm';
import axios from 'axios';
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex';
export default {
  components: { RowList, RowForm },
  data() {
    return {
      dialodVisible: false, // создали директиву
    };
  },
  methods: {
    ...mapMutations({
      setRows: 'row/setRows',
      setIsLoading: 'row/setIsLoading',
      setIsTest: 'row/setIsTest',
      setPage: 'row/setPage',
      setTotalRows: 'row/setTotalRows',
      setTotalPages: 'row/setTotalPages',
      setGetTestPage: 'row/setGetTestPage',
      setGetOffset: 'row/setGetOffset',
      setGetTest: 'row/setGetTest',
      setGet: 'row/setGet',
    }),
    ...mapActions({
      loadMoreRows: 'row/loadMoreRows',
      loadRows: 'row/loadRows',
    }),

    async createRow(row) {
      if (this.isTest) {
        this.$store.commit('row/setTotalPages', this.totalPages + 1);
      } else {
        let url = '/php_modules/controller_insert.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        row.id = response.data.id;
        console.log(response.data);
        console.table(row);
        this.$store.commit(
          'row/setTotalPages',
          Math.ceil(response.data.cnt_rows / this.get.params.limit)
        );
      }
      this.rows.push(row);
      this.dialodVisible = false;
    },

    async removeRow(row) {
      if (this.isTest) {
        this.$store.commit('row/setTotalRows', this.totalRows - 1);
        this.$store.commit(
          'row/setTotalPages',
          Math.ceil(this.totalRows / this.getTest.params._limit)
        );
      } else {
        let url = '/php_modules/controller_delete.php';
        let get = { params: row };
        const response = await axios.get(url, get);
        this.$store.commit('setTotalRows', response.data.cnt_rows);
        this.$store.commit(
          'row/setTotalPages',
          Math.ceil(response.data.cnt_rows / this.get.params.limit)
        );
      }

      this.$store.commit(
        'row/setRows',
        this.rows.filter(p => p.id !== row.id) // this. - filter создает новый массив
      );
    },

    showDialog() {
      this.dialodVisible = true;
    },
  },
  mounted() {
    this.loadRows();
  },

  computed: {
    ...mapState({
      rows: state => state.row.rows,
      isLoading: state => state.row.isLoading,
      isTest: state => state.row.isTest,
      page: state => state.row.page,
      limit: state => state.row.limit,
      totalRows: state => state.row.totalRows,
      totalPages: state => state.row.totalPages,
      get: state => state.row.get,
      getTest: state => state.row.getTest,
      url: state => state.row.url,
      urlTest: state => state.row.urlTest,
      selectedSort: state => state.row.selectedSort,
      searchQuery: state => state.row.searchQuery,
      sortOption: state => state.row.sortOption,
    }),

    ...mapGetters({
      sortedRows: 'row/sortedRows',
      sortedAndSearchedRows: 'row/sortedAndSearchedRows',
    }),
  },
};
</script>

<style scoped>
.observer {
  height: 10px;
  background: grey;
}
</style>

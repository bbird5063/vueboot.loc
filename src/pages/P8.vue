<template>
  <div>
    <h1>Страница с постами</h1>
    <my-input
      :model-value="searchQuery"
      @update:model-value="setSearchQuery"
      placeholder="Поиск..."
      v-focus
    />

    <div class="app_btns">
      <my-button @click="showDialog" style="margin: 15px 0">
        Создать поста
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

    <div v-intersection="loadMoreRows" class="observer"></div>
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
      setPage: 'row/setPage',
      setSearchQuery: 'row/setSearchQuery',
      setSelectedSort: 'row/setSelectedSort',
      setRows: 'row/setRows',
    }),
    ...mapActions({
      loadMoreRows: 'row/loadMoreRows',
      fetchRows: 'row/loadRows',
    }),

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
      // this.totalPages = this.isTest;
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
      this.$store.commit(
        // commit только так
        'row/setRows', // просто setRows не работает
        this.rows.filter(p => p.id !== row.id) // this. - ???
      );

      this.rows = this.rows.filter(p => p.id !== row.id); // filter создает новый массив
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
      posts: state => state.row.posts,
      isLoading: state => state.row.isLoading,
      selectedSort: state => state.row.selectedSort,
      searchQuery: state => state.row.searchQuery,
      page: state => state.row.page,
      limit: state => state.row.limit,
      totalPages: state => state.row.totalPages,
      sortOptions: state => state.row.sortOptions,
    }),

    ...mapGetters({
      sortedPosts: 'post/sortedPosts',
      sortedAndSearchedPosts: 'post/sortedAndSearchedPosts',
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

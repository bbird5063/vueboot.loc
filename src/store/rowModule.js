import axios from 'axios';

export const rowModule = {
  state: () => ({
    rows: [],
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
    searchQuery: '',
    sortOption: [
      { value: 'id', name: 'По порядку добавления' },
      { value: 'title', name: 'По названию' },
      { value: 'body', name: 'По содержанию' },
    ],
  }),

  getters: {
    sortedRows(state) {
      /*if (state.selectedSort === 'id') {
        // числовое поле
        let sortRows = [...state.rows];
        sortRows = state.rows.sort(
          (row1, row2) => row1[state.selectedSort] - row2[state.selectedSort]
        );
        return sortRows;
      } else {*/
      return [...state.rows].sort((row1, row2) =>
        row1[state.selectedSort]?.localeCompare(row2[state.selectedSort])
      );
      //}
    },
    sortedAndSearchedRows(state, getters) {
      return getters.sortedRows.filter(
        row => row.title.toLowerCase().includes(state.searchQuery.toLowerCase())
        //row.title.includes(state.searchQuery)
      );
    },
  },

  mutations: {
    setRows(state, rows) {
      state.rows = rows;
    },
    setIsLoading(state, bool) {
      state.isLoading = bool;
    },
    setIsTest(state, bool) {
      state.isTest = bool;
    },
    setPage(state, page) {
      state.page = page;
    },
    setTotalPages(state, totalPages) {
      state.totalPages = totalPages;
    },
    setGetTestPage(state, page) {
      state.getTest.params._page = page;
    },
    setGetOffset(state, offset) {
      state.get.params.offset = offset;
    },

    setGetTest(state, getTest) {
      state.getTest = getTest;
    },
    setGet(state, get) {
      state.get = get;
    },

    setSelectedSort(state, selectedSort) {
      state.selectedSort = selectedSort;
    },
    setSearchQuery(state, searchQuery) {
      state.searchQuery = searchQuery;
    },
  },

  actions: {
    async loadRows({ state, commit }) {
      try {
        commit('setIsLoading', true);
        if (
          location.hostname.includes('192.168.0.100') ||
          location.hostname.includes('localhost')
        ) {
          commit('setIsTest', true);
        } else {
          commit('setIsTest', false);
        }
        commit('setGetTestPage', state.page);
        commit('setGetOffset', (state.page - 1) * state.get.params.limit);
        let url = state.isTest ? state.urlTest : state.url;
        let get = state.isTest ? state.getTest : state.get;
        const response = await axios.get(url, get);

        if (state.isTest) {
          commit('setRows', response.data);
        } else if (response.data.rows) {
          commit('setRows', response.data.rows);
        }

        if (state.isTest) {
          commit(
            'setTotalPages',
            Math.ceil(
              response.headers['x-total-count'] / state.getTest.params._limit
            )
          );
        } else {
          commit(
            'setTotalPages',
            Math.ceil(response.data.cnt_rows / state.get.params.limit)
          );
        }
      } catch (e) {
        alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
      } finally {
        commit('setIsLoading', false);
      }
    },

    async loadMoreRows({ state, commit }) {
      try {
        commit('setIsLoading', true);
        commit('setPage', (state.page += 1));
        commit('setGetTestPage', state.page);
        commit('setGetOffset', (state.page - 1) * state.get.params.limit);

        let url = state.isTest ? state.urlTest : state.url;
        let get = state.isTest ? state.getTest : state.get;
        const response = await axios.get(url, get);

        if (state.isTest) {
          commit('setRows', response.data);
        } else if (response.data.rows) {
          commit('setRows', response.data.rows);
        }

        if (state.isTest) {
          commit(
            'setTotalPages',
            Math.ceil(
              response.headers['x-total-count'] / state.getTest.params._limit
            )
          );
        } else {
          commit(
            'setTotalPages',
            Math.ceil(response.data.cnt_rows / state.get.params.limit)
          );
        }
      } catch (e) {
        alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
      } finally {
        commit('setIsLoading', false);
      }
    },
  },
  namespaced: true,
};

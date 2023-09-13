import { createStore } from 'vuex';
import { rowModule } from '@/store/rowModule';

export default createStore({
  modules: {
    row: rowModule,
  },
});

import { createStore } from 'vuex';
import { rowModule } from '@/store/rowModule';
import { authModule } from '@/store/authModule';

export default createStore({
  modules: {
    row: rowModule,
    auth: authModule,
  },
});

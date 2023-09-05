<template>
  <div>
    <button class="btn btn-primary" @click="update" v-if="!is_refresh">
      Используем $.post
    </button>
    <button class="btn btn-success" @click="axiosTest" v-if="!is_refresh">
      Используем axios
    </button>

    <span v-if="is_refresh">Обновляем...</span>
    <div>Пришло: {{ result }}</div>
    <div id="result"></div>
  </div>
</template>

<script>
import axios from 'axios'; // установить: npm i axios
export default {
  data() {
    return {
      /*name: 'AjaxComponent',*/
      post: { test: 'axios-OK' },
      result: 'начальное значение',
      urldata: [],
      is_refresh: false,
      id: 0 /* для итерации нажатия клавиш */,
    };
  },
  methods: {
    async axiosTest() {
      //let url = 'controller.php';
      //let url = window.location + 'controller.php';
      //let url = window.location + 'controller.php';
      //let url = 'http://www.vueboot.loc/php_modules/controller.php'; // работает
      //let url = 'https://jsonplaceholder.typicode.com/posts';
      let url = '/php_modules/controller.php'; // работает

      try {
        this.is_refresh = true;
        //this.result = response.data.info;

        //let str = JSON.stringify(this.post);
        //alert(url + ' => ' + str);
        //const response = await axios.get(url, { params: { test: 'axios-OK' } }); // работает
        //const response = await axios.post(url, 'test=axios-OK'); // работает
        //const response = await axios.post(url, JSON.stringify({ test: 'axios-OK' })); // контроллер не определил $_POST['test']
        //const response = await axios.post(url, JSON.stringify({ test: "axios-OK" })); // контроллер не определил $_POST['test']
        //const response = await axios.post(url, { params: { test: 'axios-OK' } }) // контроллер не определил $_POST['test']
        //const response = await axios.post(url, { test: 'axios-OK' }); // контроллер не определил $_POST['test']
        //const response = await axios.post(url, { params: { test: 'axios-OK' }, }); // не работает
        const response = await axios.post(url, 'limit=10&test=axios-OK'); // работает
        //const response = await axios.get(url, 'test=axios-OK'); // контроллер не определил $_GET['test']

        //const response = await axios.post(url, 'test=axios-OK');

        this.result = response.data.info;
        console.log(response.data.info);
        alert(response.data.info);
      } catch (e) {
        alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
      } finally {
        this.is_refresh = false;
      }
    },

    update() {
      window.$('.home').css('background', 'blue'); // работает
      //alert('Функция: update()');
      let url = '/php_modules/controller.php',
        post = 'test=jquery-OK';
      this.is_refresh = true;
      //window.$.get( // работает
      window.$.post(
        url,
        post,
        data => {
          if (data.error) {
            alert(data.error);
          } else {
            if (data.info) {
              //alert(data.info);
              this.result = data.info; // работает
              window.$('#result').text('JQuery: ' + data.info); // работает
              this.is_refresh = false;
            }
          }
        },
        'json'
      );
    },
  },
};
</script>

<style scoped></style>

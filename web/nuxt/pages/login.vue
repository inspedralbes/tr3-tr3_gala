<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <form @submit.prevent="formPost" class="flex flex-col w-72 bg-white p-5 rounded-xl shadow-lg">
      <div class="mb-4">
        <label for="email" class="mb-1 font-bold">Email</label>
        <input type="email" id="email" v-model="email" class="w-full p-2 border border-gray-300 rounded text-lg">
      </div>
      <div class="mb-4">
        <label for="password" class="mb-1 font-bold">Contrasenya</label>
        <input type="password" id="password" v-model="password" class="w-full p-2 border border-gray-300 rounded text-lg">
      </div>
      <div class="mb-4">
        <nuxt-link to="/registre" class="text-blue-500 hover:underline">Encara no tens compte? Registra't!</nuxt-link>
      </div>
      <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded text-lg hover:bg-blue-700 transition-colors duration-300">Inicia sessió</button>
    </form>
  </div>
</template>
<script>
import { compraStore } from "../stores/compra.js";
export default {
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    formPost() {
      fetch('http://localhost:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          email: this.email,
          password: this.password
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.token) {

            console.log('PAPOPAPE',compraStore().email);
            compraStore().email = this.email;
            compraStore().movieTitle = "Moana";
            alert('Has iniciat sessió correctament!');
            this.$router.push('/');
          } else if (data.error) {
            alert('Error al iniciar sessió: ' + data.error);
          }
        })
        // .catch(error => {
        //   console.error('Error:', error);
        // });
    }
  }
}
</script>

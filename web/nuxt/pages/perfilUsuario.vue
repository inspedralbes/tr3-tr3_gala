<template>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4 p-4">
      <div class="md:flex">
        <div class="p-8">
          <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Perfil de Usuario</div>
          <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Tus Datos:</h2>
          <ul class="mt-2 text-gray-500">
            <li class="py-1"><span class="font-bold">Nombre:</span> {{ user.name }}</li>
            <li class="py-1"><span class="font-bold">Email:</span> {{ user.email }}</li>
            <li class="py-1"><span class="font-bold">Rol:</span> {{ user.role }}</li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        user: {}
      }
    },
    created() {
      this.getUserInfo();
    },
    methods: {
      getUserInfo() {
        axios.get('/api/getInfoUser', {
          params: {
            email: this.$store.state.compraStore.email
          }
        })
        .then(response => {
          this.user = response.data;
        })
        .catch(error => {
          console.error(error);
        });
      }
    }
  }
  </script>
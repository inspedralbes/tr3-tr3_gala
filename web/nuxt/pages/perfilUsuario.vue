<template>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4 p-4" v-if="userData">
      <div class="md:flex">
        <div class="p-8">
          <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Perfil de Usuario</div>
          <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Tus Datos:</h2>
          <ul class="mt-2 text-gray-500">
            <li class="py-1">
              <span class="font-bold">Nombre:</span> {{ userData.name }}
              <button @click="editName">Editar</button>
            </li>
            <li class="py-1">
              <span class="font-bold">Email:</span> {{ userData.email }}
              <button @click="editEmail">Editar</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { compraStore } from "../stores/compra.js";
  export default {
    data() {
      return {
        userData: null,
        store: compraStore()
      }
    },
    created() {
      this.getUserInfo();
    },
    methods: {
      getUserInfo() {
        fetch(`http://localhost:8000/api/user?email=${this.store.email}`, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.store.token}`
          },
        })
        .then(response => response.json())
        .then(data => {
          if (data) {
            this.userData = data;
            console.log(this.userData);
            console.log(this.userData.name);
          }
        })
      },
      editName() {
        // Aquí puedes abrir un modal para editar el nombre
        // y luego llamar a la API para actualizar el nombre en la base de datos
      },
      editEmail() {
        // Aquí puedes abrir un modal para editar el correo electrónico
        // y luego llamar a la API para actualizar el correo electrónico en la base de datos
      }
    }
  }
  </script>
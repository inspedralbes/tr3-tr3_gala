<template>
  <div class="flex justify-center items-center h-screen bg-gray-200">
    <form @submit.prevent="formPost" class="flex flex-col w-72 bg-white p-5 rounded-xl shadow-lg">
      <div class="mb-2">
        <label for="username" class="mb-1 font-bold">Nom Usuari</label>
        <input type="text" id="username" v-model="username" class="w-full p-2 border border-gray-300 rounded text-lg">
      </div>
      <div class="mb-2">
        <label for="email" class="mb-1 font-bold">Email</label>
        <input type="email" id="email" v-model="email" class="w-full p-2 border border-gray-300 rounded text-lg">
      </div>
      <div class="mb-2">
        <label for="password" class="mb-1 font-bold">Contrasenya</label>
        <input type="password" id="password" v-model="password" class="w-full p-2 border border-gray-300 rounded text-lg">
      </div>
      <div class="mb-2">
        <nuxt-link to="/login" class="text-blue-500 hover:underline">Tens compte? Inicia Sessió!</nuxt-link>
      </div>
      <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded text-lg hover:bg-blue-700 transition-colors duration-300">Registrarse</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ruta: 'http://tr3.a19galdelred.daw.inspedralbes.cat/laravel/public',
      username: '',
      email: '',
      password: ''
    }
  },
  methods: {
    formPost() {
      fetch(`${this.ruta}/api/registre`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name: this.username,
          email: this.email,
          password: this.password
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.token) {
            
            alert("T'has registrat correctament!");
            this.$router.push('/login');
          } else if (data.error) {
            alert('Error al iniciar sessió: ' + data.error);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  }
}
</script>
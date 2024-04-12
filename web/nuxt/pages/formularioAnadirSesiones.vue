<template>
  <div>
    <h1>Añadir sesión</h1>
    <form @submit.prevent="addSession">
      <label for="pelicula_id">ID de la película:</label>
      <input id="pelicula_id" type="number" v-model="newSession.pelicula_id" required>

      <label for="fecha">Fecha:</label>
      <input id="fecha" type="date" v-model="newSession.fecha" required>

      <label for="hora">Hora:</label>
      <input id="hora" type="time" v-model="newSession.hora" required>

      <button type="submit">Añadir sesión</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newSession: {
        pelicula_id: '',
        fecha: '',
        hora: '',
        ruta: 'http://tr3-gala.daw.inspedralbes.cat/laravel/public',
      }
    };
  },
  methods: {
    async addSession() {
      const response = await fetch(`${this.ruta}/api/sessionsAdd`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.newSession)
      });

      if (!response.ok) {
        console.error('Error al añadir la sesión:', response.statusText);
        return;
      }

      // Limpiar el formulario
      this.newSession = {
        pelicula_id: '',
        fecha: '',
        hora: ''
      };

      alert('Sesión añadida con éxito');
    }
  }
};
</script>

<style scoped>
div {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f5f5f5;
}

h1 {
  color: #333;
}

form {
  display: flex;
  flex-direction: column;
  width: 300px;
  margin-top: 20px;
  padding: 20px;
  border-radius: 5px;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

label {
  margin-bottom: 5px;
  color: #555;
}

input {
  margin-bottom: 20px;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ddd;
}

button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #007BFF;
  color: #fff;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
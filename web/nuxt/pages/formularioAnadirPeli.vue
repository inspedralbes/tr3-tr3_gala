<template>
    <div>
      <h1>Añadir película</h1>
      <form @submit.prevent="addMovie">
        <label for="titol">Título:</label>
        <input id="titol" v-model="newMovie.titol" required>
  
        <label for="descripcio">Descripción:</label>
        <textarea id="descripcio" v-model="newMovie.descripcio" required></textarea>
  
        <label for="director">Director:</label>
        <input id="director" v-model="newMovie.director" required>
  
        <label for="any">Año:</label>
        <input id="any" type="number" v-model="newMovie.any" required>
  
        <label for="url">URL de la imagen:</label>
        <input id="url" v-model="newMovie.url" required>
  
        <button type="submit">Añadir película</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        ruta: 'http://localhost:8000',
        newMovie: {
          titol: '',
          descripcio: '',
          director: '',
          any: '',
          url: ''
        }
      };
    },
    methods: {
      async addMovie() {
        const response = await fetch(`${this.ruta}/api/pelicules`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.newMovie)
        });
  
        if (!response.ok) {
          console.error('Error al añadir la película:', response.statusText);
          return;
        }
  
        // Limpiar el formulario
        this.newMovie = {
          titol: '',
          descripcio: '',
          director: '',
          any: '',
          url: ''
        };
  
        alert('Película añadida con éxito');
      }
    }
  };
  </script>
  <style scoped>
  div {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }
  
  h1 {
    color: #3f51b5;
  }
  
  form {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  label {
    font-weight: bold;
  }
  
  input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  button {
    padding: 10px 20px;
    font-size: 16px;
    color: white;
    background-color: #3f51b5;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #303f9f;
  }
  </style>
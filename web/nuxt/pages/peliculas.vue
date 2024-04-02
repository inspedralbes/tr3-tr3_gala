<template>
  <div class="container">
    <h1 class="title">CARTELERA</h1>
    <div class="grid">
      <div v-for="movie in movies" :key="movie.id" class="card" @click="selectedMovie = movie">
        <div class="image-container">
          <img :src="movie.url" :alt="movie.titol" class="image">
        </div>
        <div class="content">
          <h2 class="movie-title">{{ movie.titol }}</h2>
          <p class="text">Director: {{ movie.director }}</p>
          <p class="text">Any d'estrena: {{ movie.any}}</p>
        </div>
      </div>
    </div>
    <!-- Modal code -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      ruta: 'http://tr3.a19galdelred.daw.inspedralbes.cat/laravel/public',
      movies: [],
      selectedMovie: null
    };
  },
  mounted() {
    fetch(`${this.ruta}/api/pelicules`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Error al obtener los datos de la API');
        }
        return response.json();
      })
      .then(data => {
        if (Array.isArray(data)) {
          this.movies = data;
        } else {
          throw new Error('La respuesta de la API no tiene el formato esperado');
        }
      })
      .catch(error => {
        console.error('Error al obtener datos de la API:', error);
      });
  }
};
</script>
<style scoped>
  .container {
    padding: 4px 2px;
    background-color: #FFD7E8;
    width: 100vw;
    height: 100vh;
  }
  .title {
    font-size: 2em;
    font-weight: bold;
    text-align: center;
    margin-bottom: 4px;
    color: white;
  }
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 4px;
    justify-items: stretch;
  }
  .card {
    background-color: white;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
    max-width: 300px;
   
  }
  .card:hover {
    transform: scale(1.05);
  }
  .image-container {
    overflow: hidden;
    height: 80%;

  }
  .image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }
  .content {
    padding: 2px;
  }
  .movie-title {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 1px;
    color: #333;
  }
  .text {
    color: #555;
  }
  /* Add media queries for larger screens */
</style>
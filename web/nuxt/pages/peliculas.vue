<template>
  <div class="container">
    <h1 class="title">CARTELERA PRÓXIMAMENTE</h1>
    <input type="text" v-model="filter" placeholder="Filtrar por título" class="busca">
    <div class="grid">
      <div v-for="movie in paginatedMovies" :key="movie.id" class="card" @click="selectedMovie = movie">
        <div class="image-container">
          <img :src="movie.url" :alt="movie.titol" class="image">
        </div>
        <div class="content">
          <h2 class="movie-title">{{ movie.titol }}</h2>
          <p class="text">Director: {{ movie.director }}</p>
          <p class="text">Any d'estrena: {{ movie.any }}</p>
        </div>
      </div>
    </div>
    <button @click="previousPage" :disabled="currentPage <= 0">Anterior</button>
    <button @click="nextPage" :disabled="currentPage >= pageCount - 1">Siguiente</button>
    <!-- Modal code -->
    <div v-if="selectedMovie" class="modal" @click="selectedMovie = null">
  <div class="modal-content" @click.stop>
    <h2>{{ selectedMovie.titol }}</h2>
    <p>{{ selectedMovie.descripcio }}</p>
    <p>Director: {{ selectedMovie.director }}</p>
    <p>Año de estreno: {{ selectedMovie.any }}</p>
    <button @click="selectedMovie = null" class="buttonModal">Cerrar</button>
  </div>
</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ruta: 'http://tr3-gala.daw.inspedralbes.cat/laravel/public',
      movies: [],
      selectedMovie: null,
      currentPage: 0,
      itemsPerPage: 6,
      filter: ''
    };
  },
  computed: {
    filteredMovies() {
      if (this.filter) {
        return this.movies.filter(movie => movie.titol.toLowerCase().includes(this.filter.toLowerCase()));
      } else {
        return this.movies;
      }
    },
    paginatedMovies() {
      const start = this.currentPage * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredMovies.slice(start, end);
    },
    pageCount() {
      return Math.ceil(this.filteredMovies.length / this.itemsPerPage);
    }
  },
  methods: {
    nextPage() {
      if (this.currentPage < this.pageCount - 1) {
        this.currentPage++;
      }
    },
    previousPage() {
      if (this.currentPage > 0) {
        this.currentPage--;
      }
    }
  },
  mounted() {
  fetch(`${this.ruta}/api/peliculesProximamente`) 
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
  padding: 20px;
  background-color: #fff;
  width: 100vw;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.title {
  font-size: 2em;
  font-weight: bold;
  text-align: center;
  margin-bottom: 20px;
  color: #ff9fc7;
  margin-top: 20px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  justify-items: center;
  width: 80%;
  margin: 0 auto;
}

.card {
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;
  max-width: 300px;
  width: 100%;
  min-width: 150px; /* Add this line */
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
  padding: 20px;
  text-align: center;
}

.movie-title {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

.text {
  color: #555;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  width: 80%;
  height:28%;
}

.buttonModal {
  background-color: #ffaace;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 20px 2px;
  cursor: pointer;
  border-radius: 5px;
}
.busca{
  width: 50%;
  padding: 10px;
  margin-bottom: 30px;
  border-radius: 5px;
  border: 1px solid #ddd;

}
@media (max-width: 765px) {
    .grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* Styles for screens smaller than 450px */
  @media (max-width: 450px) {
    .grid {
      grid-template-columns: repeat(1, 1fr);
    }
  }
  @media(min-width: 950px) {
    .grid {
      grid-template-columns: repeat(4, 1fr);
    }
  }
</style>
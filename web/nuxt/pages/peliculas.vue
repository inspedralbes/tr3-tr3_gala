<template>
  <div class="py-4 px-2 lg:py-12 lg:px-8" style="background-color: #FFD7E8;">
    <h1 class="text-2xl font-bold text-center mb-4 lg:text-4xl lg:mb-8 text-white">CARTELERA</h1>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 justify-items-stretch">
      <div v-for="movie in movies" :key="movie.id" class="bg-white shadow-lg hover:shadow-xl transition duration-300 ease-in-out rounded-lg overflow-hidden transform hover:scale-105" style="max-width: 300px;" @click="selectedMovie = movie">
        <div class="overflow-hidden h-32 lg:h-64">
          <img :src="movie.url" :alt="movie.titol" class="w-full h-full object-cover object-center">
        </div>
        <div class="p-2 lg:p-6">
          <h2 class="text-xl font-bold mb-1 lg:text-2xl lg:mb-2 text-gray-800">{{ movie.titol }}</h2>
          <p class="text-gray-700 mb-1">Director: {{ movie.director }}</p>
          <p class="text-gray-700">Any d'estrena: {{ movie.any}}</p>
        </div>
      </div>
    </div>
    <div v-if="selectedMovie" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-2 pt-3 pb-2 sm:px-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                  {{ selectedMovie.titol }}
                </h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    {{ selectedMovie.descripcio }}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-2 py-1 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="selectedMovie = null">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      movies: [],
      selectedMovie: null
    };
  },
  mounted() {
    fetch('http://localhost:8000/api/pelicules')
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
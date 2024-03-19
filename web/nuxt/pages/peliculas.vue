<template>
  <div class="bg-gray-200 py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">CARTELERA</h1>
    <div class="flex flex-wrap justify-center gap-8">
      <div v-for="movie in movies" :key="movie.id" class="bg-white shadow-lg hover:shadow-xl transition duration-300 ease-in-out rounded-lg overflow-hidden transform hover:scale-105" style="max-width: 300px;" @click="selectedMovie = movie">
        <div class="overflow-hidden h-64">
          <img :src="movie.url" :alt="movie.titol" class="w-full h-full object-cover object-center">
        </div>
        <div class="p-6">
          <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ movie.titol }}</h2>
          <p class="text-gray-700 mb-2">Director: {{ movie.director }}</p>
          <p class="text-gray-700">Any d'estrena: {{ movie.any}}</p>
        </div>
      </div>
    </div>
    <div v-if="selectedMovie" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
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
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="selectedMovie = null">
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
        // Verificar si la respuesta tiene la estructura esperada
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
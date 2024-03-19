<template>
  <div class="bg-gray-200 py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">CARTELERA</h1>
    <div class="flex flex-wrap justify-center gap-8">
      <div v-for="movie in movies" :key="movie.id" class="bg-white shadow-lg hover:shadow-xl transition duration-300 ease-in-out rounded-lg overflow-hidden transform hover:scale-105" style="max-width: 300px;">
        <div class="overflow-hidden h-64">
          <img :src="movie.url" :alt="movie.títol" class="w-full h-full object-cover object-center">
        </div>
        <div class="p-6">
          <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ movie.titol }}</h2>
  
          <p class="text-gray-700 mb-2">Director: {{ movie.director }}</p>
          <p class="text-gray-700">Any d'estrena: {{ movie.any}}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: []
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
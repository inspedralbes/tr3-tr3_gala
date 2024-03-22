<template>
    <div class="imatge">
      <h1>COMPRA EFECTUADA CORRECTAMENT</h1>
      <img src="../public/confirmacion.png" alt="CinemaGala" class="image">
    </div>
  </template>
  
  <script>
  export default {
    mounted() {
      setTimeout(() => {
        this.$router.push({ name: 'index' }); // Reemplaza 'Home' con el nombre de la ruta de tu página principal
      }, 5000); // 10000 milisegundos son 10 segundos
    },
  };
  </script>
  
  <style scoped>
  /* ... */
  </style>
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
        this.$router.push({ name: 'index' }); 
      }, 3000); 
    },
  };
  </script>
  
  <style scoped>
  /* ... */
  </style>
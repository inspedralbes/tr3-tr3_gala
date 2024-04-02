<template>
  <div class="container">
    <h1>¡Compra efectuada correctamente!</h1>
    <p class="confirmation-text">Gracias por tu compra. Serás redirigido a la página principal en unos momentos.</p>
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
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  text-align: center;
  background-color: #f8f9fa;
  color: #343a40;
  font-family: 'Arial', sans-serif;
}

h1 {
  margin-bottom: 1rem;
}

.confirmation-text {
  margin-bottom: 2rem;
}

.image {
  width: 50%; 
  max-width: 300px; 
  margin-top: 2rem; 
}
</style>
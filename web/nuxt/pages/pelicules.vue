<template>
  <!-- Aquí estará tu formulario -->
  <form id="formularioCompra">
  //CAMPS del form
   <input type="hidden" id="productosJson" :value="productosJson">
  </form>
</template>

<script>
export default {
  data() {
    return {
      productosJson: ''
    };
  },
  mounted() {
    this.obtenerProductosJson();
  },
  methods: {
    obtenerProductosJson() {
      fetch('http://localhost:8000/api/peliculasForm') 
        .then(response => response.json())
        .then(data => {
          this.productosJson = JSON.stringify(data);
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>
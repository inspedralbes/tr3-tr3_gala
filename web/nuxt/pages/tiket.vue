<template>
    <div></div>
  </template>
  
  <script>
  export default {
    
    props: {
      datosCompra: {
        type: Object,
        required: true,
      },
    },
   
    created() {
      console.log("Datos de la compra recibidos:", this.datosCompra);
    
    },
  };
  </script>
  
  <style lang="scss" scoped></style>
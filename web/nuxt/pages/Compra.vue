<template>
  <h1><b><u>SELECCIONA LES TEVES BUTAQUES</u></b></h1>
  <div class="container">
    
    <!-- Renderiza el componente de butacas -->
    <Butacas :sessionId="sessioPinia && sessioPinia.id" @seatSelected="handleSeatSelected"
      @seatDeselected="handleSeatDeselected" />

    <!-- Renderiza el menú de butacas seleccionadas -->
    <div v-if="selectedSeats.length" class="selected-seats">
      <h2>Butacas seleccionadas:</h2>
      <img :src="store.imagen" alt="Imagen de la película" style="float: right;">  <!-- Añade esto -->

      <ul>
        <li v-for="(seat, index) in selectedSeats" :key="index">
          Butaca: {{ seat.id }} - Precio: {{ seat.precio }}€
        </li>
      </ul>
      <p>Total de butacas seleccionadas: {{ totalSeats }}</p>
      <p>Total a pagar: {{ totalPrice }}€</p>
    </div>
    <button @click="efectuarCompra" :disabled="!selectedSeats.length">Comprar</button>
  </div>
</template>

<script>
import { compraStore } from "../stores/compra.js";
import Butacas from "../components/butacas.vue";

export default {
  components: {
    Butacas,
  },
  data() {
    return {
      sessioPinia: null,
      sessionId: null,
      selectedSeats: [],
      store: compraStore(),
    };
  },
  computed: {
    totalSeats() {
      return this.selectedSeats.length; 
    },
    totalPrice() {
      return this.selectedSeats.reduce((total, seat) => total + seat.precio, 0); 
    },
  },
  created() {
    let storeSesion = compraStore();
    this.sessioPinia = storeSesion.sessio;
    this.sessionId = this.sessioPinia ? this.sessioPinia.id : null;
  },
  methods: {
    efectuarCompra() {
      let storeSesion = compraStore();
      console.log(storeSesion.email);
      storeSesion.butacas = this.selectedSeats;
      let sessioId = storeSesion.sessio.id;
      const data = {
        seats: this.selectedSeats.map((seat) => ({
          id: seat.id,
          price: seat.precio,
          status: seat.status
        })),
        sessionId: sessioId,
        userEmail: storeSesion.email, 
      };
      console.log("Datos de la compra:", data);
      this.$router.push({ path: "/ticket" });
    },
    handleSeatSelected(seat) {
      console.log("Butaca seleccionada:", seat);
      const index = this.selectedSeats.findIndex((s) => s.id === seat.id);
      if (index !== -1) {
        
        this.selectedSeats.splice(index, 1);
      } else {
     
        this.selectedSeats.push(seat);
      }
    },
    handleSeatDeselected(seat) {
      const index = this.selectedSeats.findIndex((s) => s.id === seat.id);
      if (index !== -1) {
        this.selectedSeats.splice(index, 1);
      }
    },
  },
};
</script>

<style scoped>
h1{
  text-align: center;
  font-size: 30px;
  color: #333;
  margin-top: 20px;

}

.container {
  width: 80%;
  font-family: 'Roboto', sans-serif;
  background-color: #f8f8f8;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
  margin: 10%
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity .5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.selected-seats {
  background-color: #f0f0f0;
  padding: 20px;
  margin-top: 20px;
  border-radius: 5px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}

.selected-seats h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.selected-seats ul {
  list-style-type: none;
  padding: 0;
}

.selected-seats ul li {
  padding: 10px 0;
  border-bottom: 1px solid #e0e0e0;
  color: #333;
  font-size: 18px;
}

.selected-seats ul li:last-child {
  border-bottom: none;
}

.summary {
  background-color: #e0e0e0;
  padding: 20px;
  margin-top: 20px;
  border-radius: 5px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}

.summary p {
  color: #242424;
  font-size: 18px;
  margin-top: 10px;
}

.summary button {
  background-color: #6c63ff;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.summary button:hover {
  background-color: #5a54d8;
  transform: scale(1.05);
}
</style>
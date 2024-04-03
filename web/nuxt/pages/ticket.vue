<template>
  <div class="ticket-container">
    <h1>Ticket de compra</h1>
    <table class="ticket-details">
      <tr>
        <td>Fecha:</td>
        <td>{{ formatDate }}</td>
      </tr>
      <tr>
        <td>Película:</td>
        <td>Moana</td>
      </tr>
      <tr>
        <td>Sesión:</td>
        <td>{{ sessionDate }} - {{ sessionTime }}</td>
      </tr>
      <tr>
        <td>Butacas seleccionadas:</td>
        <td>
          <table>
            <tr v-for="(seat, index) in selectedSeats" :key="index">
              <td>Butaca: {{ seat.id }}</td>
              <td>Precio: {{ seat.precio }}€</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>Total de butacas seleccionadas:</td>
        <td>{{ totalSeats }}</td>
      </tr>
      <tr>
        <td>Total a pagar:</td>
        <td>{{ totalPrice }}€</td>
      </tr>
    </table>
    <button @click="efectuarCompra()" class="buttonCompra">Comprar</button>
  </div>
</template>

<script>
import { compraStore } from "../stores/compra.js";

export default {
  data() {
    return {

      selectedSeats: [],
      sessioPinia: null,
    };
  },
  computed: {
    formatDate() {
      const date = new Date();
      return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
    },
    movieTitle() {
      return this.sessioPinia?.pelicula?.titulo || "Película no seleccionada";
    },
    sessionDate() {
      return this.sessioPinia ? this.sessioPinia.fecha : "Fecha no seleccionada";
    },
    sessionTime() {
      return this.sessioPinia ? this.sessioPinia.hora : "Hora no seleccionada";
    },
    totalSeats() {
      return this.selectedSeats.length;
    },
    totalPrice() {
      return this.selectedSeats.reduce((total, seat) => total + seat.precio, 0);
    },
  },
  methods: {
    async efectuarCompra() {
      const storeSesion = compraStore();
      const data = {
        seats: this.selectedSeats.map((seat) => ({
          id: seat.id,
          price: seat.precio,
          status: seat.status
        })),
        sessionId: this.sessioPinia.id,
        userEmail: storeSesion.email,
      };

      try {
        const response = await fetch(`http://localhost:8000/api/efectuarCompra`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        if (!response.ok) {
          throw new Error('Error al realizar la compra');
        }

        const compra = await response.json();
        console.log('Compra realizada:', compra);
        this.$router.push(`/finalizarCompra`);
      } catch (error) {
        console.error('Error:', error);
      }
    }
  },
  created() {
    let storeSesion = compraStore();
    this.selectedSeats = storeSesion.butacas; 
    this.sessioPinia = storeSesion.sessio; 
  },
};
</script>

<style scoped>
.ticket-container {
  width: 80%;
  margin: 0 auto;
  font-family: 'Roboto', sans-serif;
  background-color: #f8f8f8;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}

.ticket-details {
  margin-top: 20px;
}

.ticket-details p {
  margin: 10px 0;
}

.ticket-details ul {
  padding: 0;
  margin-left: 20px;
}

.ticket-details ul li {
  margin-bottom: 5px;
}

.buttonCompra {

  background-color: #ffaace;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;

}
</style>

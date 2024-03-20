<template>
  <div class="ticket-container">
    <h1>Ticket de compra</h1>
    <div class="ticket-details">
      <p>Fecha: {{ formatDate }}</p>
      <p>Película: {{ movieTitle }}</p>
      <p>Sesión: {{ sessionDate }} - {{ sessionTime }}</p>
      <p>Butacas seleccionadas:</p>
      <ul>
        <li v-for="(seat, index) in selectedSeats" :key="index">
          Butaca: {{ seat.id }} - Precio: {{ seat.precio }}€
        </li>
      </ul>
      <p>Total de butacas seleccionadas: {{ totalSeats }}</p>
      <p>Total a pagar: {{ totalPrice }}€</p>
      <button @click="efectuarCompra()">Comprar</button>
    </div>
  </div>
</template>

<script>
import { compraStore } from "../stores/compra.js";

export default {
  data() {
    return {
      selectedSeats: [], // Butacas seleccionadas
      sessioPinia: null, // Sesión seleccionada
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
      return this.selectedSeats.length; // Número total de butacas seleccionadas
    },
    totalPrice() {
      return this.selectedSeats.reduce((total, seat) => total + seat.precio, 0); // Suma el precio de todas las butacas seleccionadas
    },
    async efectuarCompra() {
      const storeSesion = compraStore();
      const data = {
        seats: this.selectedSeats.map((seat) => ({
          id: seat.id,
          price: seat.precio,
          status: seat.status
        })),
        sessionId: this.sessioPinia.id,
        userEmail: storeSesion.email, // Agrega el correo electrónico del usuario a la solicitud
      };

      try {
        const response = await fetch('http://localhost:8000/api/efectuarCompra', {
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
    this.selectedSeats = storeSesion.butacas; // Obtener las butacas seleccionadas de la tienda
    this.sessioPinia = storeSesion.sessio; // Obtener la sesión seleccionada de la tienda
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

</style>

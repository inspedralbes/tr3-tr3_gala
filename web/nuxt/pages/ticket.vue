<template>
  <div class="ticket-container">

    <h1>Ticket de compra</h1>
    <table class="ticket-details">
      <tr>
        <td>Fecha:</td>
        <td>25-03-2024</td>
      </tr>
      <tr>
        <td>Película:</td>
        <td>{{ peliculaPinia }}</td>
      </tr>
      <tr>
        <td>Imagen:</td>
        <td><img :src="imagenPinia" alt="Imagen de la película"></td>
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
      peliculaPinia: null, // Añade esta línea
      imagenPinia: null, // Añade esta línea
      store: compraStore(),
    };
  },
  computed: {
    formatDate() {
      const date = new Date();
      return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
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
    },
    async fetchPelicula(id) {
      try {
        const response = await fetch(`http://localhost:8000/api/peliculas/${id}`);
        if (!response.ok) {
          throw new Error('Error al obtener los datos de la API');
        }
        const pelicula = await response.json();
        this.peliculaPinia = pelicula.titol;
        this.imagenPinia = pelicula.url;
      } catch (error) {
        console.error('Error al obtener datos de la API:', error);
      }
    },
  },
    
  mounted() {
    const storeSesion = compraStore();
    if (storeSesion) {
      this.fetchPelicula(storeSesion.pelicula);
    }
  },
  created() {
    let storeSesion = compraStore();
    this.selectedSeats = storeSesion.butacas; 
    this.sessioPinia = storeSesion.sessio; 
    this.peliculaPinia = storeSesion.pelicula; 
    this.imagenPinia = storeSesion.imagen; 
  },
};
</script>

<style scoped>
.ticket-container {
  width: 80%;
  margin: 0 auto;
  font-family: 'Roboto', sans-serif;
  background-color: #ffffff;
  border-radius: 15px; 
  padding: 20px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
  margin-top: 10%;
  margin-bottom: 10%; 
}

.ticket-details {
  margin-top: 20px;
  width: 100%;
  border-collapse: collapse;
}

.ticket-details td {
  padding: 10px;
  border-bottom: 1px solid #f0f0f0;
  transition: background-color 0.3s ease; 
}

.ticket-details tr:hover {
  background-color: #f9f9f9; 
}

.ticket-details img {
  max-width: 100px;
  max-height: 100px;
}

h1 {
  text-align: center;
  color: #f889b7;
}

.buttonCompra {
  background-color: #ffaace;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: block; 
  font-size: 16px;
  margin: 20px auto 0; 
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.buttonCompra:hover {
  background-color: #ff86b3;
}
</style>

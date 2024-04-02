<template>
  <div class="container">
    <div class="cinema-seats">
      <component
        v-for="seat in availableSeats"
        :key="seat.id"
        :is="getSeatComponent(seat)"
        @click="toggleSeatStatus(seat)"
        :id="'seat_' + seat.id"
        class="svg-seat"
      />
    </div>
    <div class="screen">
      <h1 class="screen-title">Pantalla</h1>
    </div>
  </div>
</template>

<script>
import ButacaVIP from './ButacaVIP.vue';
import ButacaLliure from './ButacaLliure.vue';
import ButacaOcupada from './ButacaOcupada.vue';
import ButacaSeleccionada from './ButacaSeleccionada.vue';

export default {
  components: {
    ButacaVIP,
    ButacaLliure,
    ButacaOcupada,
    ButacaSeleccionada
  },
  props: {
    sessionId: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      availableSeats: Array.from({ length: 80 }, (_, index) => ({
        id: index + 1,
        status: 'available',
        precio: 6.50
      })),
      ruta: 'http://localhost:8000'
    };
  },
  methods: {
    toggleSeatStatus(seat) {
      if (seat.status === 'available' || seat.status === 'vip') {
        seat.status = 'selected';
        this.$emit('seatSelected', seat);
      } else if (seat.status === 'selected') {
        seat.status = 'available';
        this.$emit('seatDeselected', seat);
      }
    },
    getSeatComponent(seat) {
      if (Math.floor((seat.id - 1) / 8) === 4) { // Si el asiento está en la fila central
        return 'ButacaVIP';
      }
      switch (seat.status) {
        case 'selected':
          return 'ButacaSeleccionada';
        case 'available':
          return 'ButacaLliure';
        case 'occupied':
          return 'ButacaOcupada';
        default:
          return 'ButacaLliure'; 
      }
    }
  },
  created() {
    if (typeof this.sessionId !== 'undefined') {
    }
  },
  async mounted() {
    try {
      const response = await fetch(`http://localhost:8000/api/sessions/${this.sessionId}/purchasedSeats`);
      const purchasedSeats = await response.json();

      for (const seat of this.availableSeats) {
        if (purchasedSeats.includes(seat.id)) {
          seat.status = 'occupied';
        }
      }
    } catch (error) {
    console.error('Error:', error);
  }

  }
};
</script>

<style scoped>
.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
}

.section-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  font-weight: bold;
  text-transform: uppercase;
}

.cinema-seats {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
  gap: 10px;
  justify-items: center;
}

.cinema-seats .svg-seat {
  width: 40px; /* Ajusta el ancho según tus necesidades */
  height: auto;
  cursor: pointer;
  transition: transform 0.3s ease-in-out;
}

.cinema-seats .svg-seat:hover {
  transform: scale(1.3);
}

.screen {
  text-align: center;
  margin-top: 20px;
}

.screen-title {
  font-size: 24px;
  font-weight: bold;
  text-transform: uppercase;
}
</style>
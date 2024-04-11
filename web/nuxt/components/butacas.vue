<template>
  <div class="cinema-seats">
    <component v-for="seat in availableSeats" :key="seat.id" :is="getSeatComponent(seat)"
      @click="toggleSeatStatus(seat)" :id="'seat_' + seat.id" class="svg-seat" />
  </div>
  <div class="screen">
    <h1 class="screen-title">Pantalla</h1>
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
      availableSeats: Array.from({ length: 120 }, (_, index) => ({
        id: index + 1,
        status: 'available',
        precio: 6.50,
        previousStatus: null
      })),
      ruta: 'http://localhost:8000'
    };
  },
  methods: {
    toggleSeatStatus(seat) {
      if (seat.status === 'available' || seat.status === 'vip') {
        seat.previousStatus = seat.status;
        seat.status = 'selected';
        this.$emit('seatSelected', seat);
      } else if (seat.status === 'selected') {
        seat.status = seat.previousStatus;
        this.$emit('seatDeselected', seat);
      }
    },
    getSeatComponent(seat) {
      const fila = Math.floor((seat.id - 1) / 10);

      // Si es la fila 6, es VIP
      if (fila === 5) {
        seat.precio = 9.50;
        seat.isVip = true;
      }
      switch (seat.status) {
        case 'selected':
          return 'ButacaSeleccionada';
        case 'available':
          return seat.isVip ? 'ButacaVIP' : 'ButacaLliure';
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
.cinema-seats {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.cinema-seats .svg-seat {
  width: calc(10% - 20px);
  /* Ajusta el tamaño de las butacas para 10 columnas */
  height: auto;
  cursor: pointer;
  margin: 10px;
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

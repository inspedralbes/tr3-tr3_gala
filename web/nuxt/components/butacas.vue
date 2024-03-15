<template>
  <div>
    <h2>Selecciona les teves butaques</h2>
    <div class="cinema-seats">
      <component
        v-for="seat in availableSeats"
        :key="seat.id"
        :is="getSeatComponent(seat.status)"
        @click="toggleSeatStatus(seat)"
        :id="'seat_' + seat.id"
        class="svg-seat"
      />
    </div>
    <h1>PANTALLA</h1>
    <div class="screen"></div>
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
      }))
    };
  },
  methods: {
    toggleSeatStatus(seat) {
      if (seat.status === 'available') {
        seat.status = 'selected';
        this.$emit('seatSelected', seat);
      } else if (seat.status === 'selected') {
        seat.status = 'available';
        this.$emit('seatDeselected', seat);
      }
    },
    getSeatComponent(status) {
      switch (status) {
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
      // Realiza cualquier lógica adicional aquí
    }
  }
};
</script>

<style scoped>
.cinema-seats {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
  gap: 10px;
  justify-items: center;
  margin: 0 auto;
  max-width: 900px;
  padding: 20px;
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
  border-top: 4px dashed #444;
  width: 100%;
  margin: 20px 0;
}
h1{
  text-align: center;
  font-size: 44px;
  margin-bottom: 20px;
  font-weight: bold;
  text-transform: uppercase;

}
.screen-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  font-weight: bold;
  text-transform: uppercase;
}
</style>

<template>
  <div class="sesiones-list">
    <h1>SESSIONS DEL DIA</h1>
    <div>
      <div
        v-for="session in sessions"
        :key="session.sesion.id"
        @click="goToSession(session.sesion)"
      >
        <div>
          <img
            :src="session.pelicula.imagen"
            :alt="session.pelicula.titulo"
          />
          <div></div>
          <div>
            <h2>{{ session.pelicula.titulo }}</h2>
          </div>
        </div>
        <div>
          <p>{{ session.pelicula.descripcion }}</p>
          <p>
            {{ session.sesion.fecha }} - {{ session.sesion.hora }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { compraStore } from "../stores/compra.js";
export default {
  data() {
    return {
      pelicula: null,
      sessions: [],
    };
  },
  mounted() {
    fetch("http://localhost:8000/api/sessions") 
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al obtener los datos de la API");
        }
        return response.json();
      })
      .then((data) => {
        this.sessions = data.sessions;
      })
      .catch((error) => {
        console.error("Error al obtener datos de la API:", error);
      });
  },
  methods: {
    goToSession(session) {
      let storeSesion = compraStore();
      storeSesion.setSessio(session);
      this.$router.push(`/compra`);
    },
  },
};
</script>

<style scoped>
.sesiones-list {
  max-width: 800px;
  margin: auto;
}
</style>
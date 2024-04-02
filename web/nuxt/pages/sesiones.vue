<template>
  <div class="container">
  <div class="sesiones-list">
    <div class="session-container">
      <div
        class="session-item"
        v-for="session in sessions"
        :key="session.sesion.id"
        @click="goToSession(session.sesion)"
      >
        <div class="session-image">
          <img
            :src="session.pelicula.imagen"
            :alt="session.pelicula.titulo"
          />
          <div class="session-title">
            <h2>{{ session.pelicula.titulo }}</h2>
          </div>
        </div>
        <div class="session-details">
          <p>{{ session.pelicula.descripcion }}</p>
          <p>
            {{ session.sesion.fecha }} - {{ session.sesion.hora }}
          </p>
        </div>
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
      ruta: 'http://localhost:8000',
    };
  },
  mounted() {
    
    fetch(`${this.ruta}/api/sessions`) 
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
    storeSesion.sessio = session; 
    this.$router.push(`/compra`);
  },
  },
};
</script>
<style scoped>
.container{
 margin-left: 10%;
}
.sesiones-list {
  max-width: 800px;
  margin: auto;
  font-family: Arial, sans-serif;
}

.sesiones-list h1 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

.session-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
}

.session-item {
  background-color: #f8f8f8;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.3s ease;
}

.session-item:hover {
  transform: scale(1.05);
}

.session-image {
  position: relative;
}

.session-image img {
  width: 100%;
  height: auto;
}

.session-title {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 10px;
}

.session-details {
  padding: 10px;
}

.session-details p {
  margin: 0 0 10px 0;
}
@media (max-width: 600px) {
    .session-container {
      grid-template-columns: 1fr; /* Change to one column on smaller screens */
      width: 80%;
      margin-top: 5%
    }
  }
</style>
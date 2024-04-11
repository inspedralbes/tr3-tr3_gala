<template>
  <div class="container">
    <!-- Botón del menú -->
    <button @click="toggleMenu" class="menu-button">Menú</button>
    
    <!-- Barra lateral del menú -->
    <div class="sidebar" :class="{ 'hidden': !showMenu }">
      <div class="sidebar-header">
        <h2>Menú</h2>
      </div>
      <ul>
        <li><a @click="filterSessions('morning')">Mañana</a></li>
        <li><a @click="filterSessions('afternoon')">Tarde</a></li>
        <li><a @click="filterSessions('evening')">Noche</a></li>
      </ul>
    </div>
    
    <!-- Contenido principal -->
    <div class="content">
      <img src="../public/cinemagala.jpeg" alt="CinemaGala" class="image">
      <h1 class="title">CINEMA GALA</h1>
    </div>
    
    <!-- Lista de sesiones -->
    <div class="sesiones-list">
      <div class="session-container">
        <div class="session-item" v-for="session in sessions" :key="session.sesion.id"
          @click="goToSession(session.sesion)">
          <div class="session-image">
            <img :src="session.pelicula.imagen" :alt="session.pelicula.titulo" />
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
      allSessions: [],
      ruta: 'http://localhost:8000',
      showMenu: false, 
    };
  },
  mounted() {
    fetch(`http://localhost:8000/api/sessions`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al obtener los datos de la API");
        }
        return response.json();
      })
      .then((data) => {
        this.sessions = data.sessions;
        this.allSessions = data.sessions; 
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
    toggleMenu() {
      this.showMenu = !this.showMenu; 
    },
    filterSessions(timeOfDay) {
      let start, end;

      switch (timeOfDay) {
        case 'morning':
          start = '00:00:00';
          end = '12:00:01';
          break;
        case 'afternoon':
          start = '12:00:02';
          end = '19:30:00';
          break;
        case 'evening':
          start = '19:30:01';
          end = '23:59:59';
          break;
      }

      this.sessions = this.allSessions.filter(session => { 
        let sessionTime = session.sesion.hora;
        return sessionTime >= start && sessionTime <= end;
      });
    },
  },
};
</script>

<style scoped>
.menu-button {
  position: absolute;
  top: 90px; 
  left: 20px;
  z-index: 1;
  background-color: pink;
  padding: 1%;
  border-radius: 15%;
}

.container {
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
  flex-wrap: wrap;
  padding: 20px;
  box-sizing: border-box;
  height: 100vh;
}

.sidebar {
  width: 200px;
  position: fixed;
  left: 0;
  top: 15%;
  padding: 20px;
  background-color: #ffffff;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  border-right: 2px solid #f0f0f0;
}

.hidden {
  transform: translateX(-100%);
}

.sidebar-header {
  margin-bottom: 20px;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar ul li {
  margin-bottom: 10px;
}

.sidebar ul li a {
  text-decoration: none;
  color: #333;
}

.sesiones-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin-top: 2em;
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

.content {
  margin: 0 20px;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  max-width: 800px;
}

.image {
  width: 10rem;
  height: 10rem;
  border-radius: 50%;
  margin-bottom: 2rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.title {
  font-size: 2.5rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 2rem;
  color: #444;
}

.session-image img {
  width: 100%;
  height: auto;
  object-fit: cover;
}

.session-title {
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 10px;
  text-align: center;
}

.session-details {
  padding: 10px;
  text-align: center;
}

@media (max-width: 400px) {
  .session-container {
    grid-template-columns: 1fr;
  }
}

@media (min-width: 401px) and (max-width: 600px) {
  .session-container {
    grid-template-columns: 1fr 1fr;
  }
}

@media (min-width: 601px) and (max-width: 1084px) {
  .session-container {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media (min-width: 1085px) and (max-width: 1354px) {
  .session-container {
    grid-template-columns: repeat(5, 1fr);
  }
}

@media (min-width: 1355px) {
  .session-container {
    grid-template-columns: repeat(6, 1fr);
  }
}
</style>

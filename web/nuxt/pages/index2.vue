<template>
  <div class="container">
    <div class="content">
      <img src="../public/cinemagala.jpeg" alt="CinemaGala" class="image">
      <h1 class="title">CINEMA GALA</h1>
      <div class="links">
        <router-link to="/peliculas" class="link pink">Cartelera</router-link>
        <router-link to="/sesiones" class="link violet">Sessio del Dia</router-link>
        <div v-if="!compraStore().email">
          <router-link to="/index2" class="link blue">Login</router-link>
        </div>
        <div v-else>
          <!--<router-link to="/index2" class="link blue">Logout</router-link>-->
        </div>
      </div>
    </div>

    <div class="text-content">
      <p>Benvingut a Cine Gala, el teu destí final per a les darreres pel·lícules i sessions del dia. Navega per la
        nostra
        cartellera per descobrir noves pel·lícules, o inicieu sessió per gaudir d'una experiència personalitzada. A
        Cinema Gala, ens esforcem per oferir-te la millor experiència de cinema des de la comoditat de casa teva.
        Gaudeix
        de la funció!</p>
    </div>

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
    <div class="connected-users">
      <h2>Usuarios Conectados</h2>
      <ul>
        <li v-for="user in compraStore().usuariosConectados" :key="user.id">
          {{ user.name }}
        </li>
      </ul>
    </div>

    <div class="footer">
      <p>&copy; 2024 Cinema Gala. All rights reserved.</p>
      <div class="links">
        <router-link to="/terms" class="link">Terms of Service</router-link>
        <router-link to="/privacy" class="link">Privacy Policy</router-link>
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
    fetch(`http://localhost:8000/api/sessions`)
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
    storeSesion.pelicula = session.pelicula_id;
    this.$router.push(`/compra`);
  },
  },
};
</script>
<style scoped>
body {
  margin: 0;
}
.sesiones-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin-top: 2em;
}

.session-container {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
  width: 100%;
 
}

.session-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: calc(100% / 3 - 2em); 
  margin: 1em;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.session-item:hover {
  transform: scale(1.05);
}

.session-image {
  position: relative;
  width: 100%;
 
}

.session-image img {
  width: 100%;
  height: auto;
}

.session-title {
  position: absolute;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  width: 100%;
  padding: 0.5em 0;
  color: white;
  text-align: center;
}

.session-details {
  background-color: #f4f4f4;
  padding: 1em;
  width: 100%;
  text-align: center;
  border-radius: 10%;
}
.container {
  margin: 0 auto;
  padding: 2rem;
  display: flex;
  flex-direction: column;

  font-family: Arial, sans-serif;
  color: #333;
  line-height: 1.6;
  overflow: auto;
}

.content {
  padding: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
}

.text-content {
  padding: 2rem;
  text-align: center;
  font-size: 1.2rem;
}

@media (min-width: 1280px) {
  .text-content {
    text-align: justify;
  }
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

.links {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 2rem;
  gap: 2rem;
}

.about-us {
  padding: 2rem;
  text-align: center;
  font-size: 1.2rem;
}

@media (min-width: 1280px) {
  .about-us {
    text-align: justify;
  }
}

@media (min-width: 1280px) {
  .links {
    flex-direction: row;
    justify-content: space-around;
    gap: 2rem;
  }
}

.connected-users {
  padding: 2rem;
  text-align: center;
  font-size: 1.2rem;
}

.connected-users ul {
  list-style-type: none;
  padding: 0;
}

.connected-users li {
  margin-bottom: 1rem;
}


.footer .link {
  color: #333;
  background-color: transparent;
  box-shadow: none;
}

.footer .link:hover {
  color: #666;
  transform: none;
}

.link {
  padding: 1rem;
  text-align: center;
  font-weight: 700;
  border-radius: 0.375rem;
  flex: 1;
  color: #fff;
  text-decoration: none;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.link:hover {
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
  transform: scale(1.05);
}

.link.pink {
  background-color: #ff4081;
}

.link.violet {
  background-color: #7c4dff;
}

.link.blue {
  background-color: #448aff;
}

.footer {
  margin-top: auto;
  padding: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  background-color: #f9f9f9;
  box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.1);
}

@media (min-width: 1280px) {
  .footer {
    flex-direction: row;
  }
}

</style>
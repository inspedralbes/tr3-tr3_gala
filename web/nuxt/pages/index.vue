<template>
  <div class="container">
    <!-- Existing content -->
    <div class="content">
      <img src="../public/cinemagala.jpeg" alt="CinemaGala" class="image">
      <h1 class="title">CINEMA GALA</h1>
      <div class="links">
        <router-link to="/peliculas" class="link pink">Cartelera</router-link>
        <router-link to="/sesiones" class="link violet">Sessio del Dia</router-link>
        <router-link to="/Login" class="link blue">Login</router-link>
      </div>
    </div>

    <!-- Text content -->
    <div class="text-content">
      <p>Benvingut a Cine Gala, el teu destí final per a les darreres pel·lícules i sessions del dia. Navega per la nostra
        cartellera per descobrir noves pel·lícules, o inicieu sessió per gaudir d'una experiència personalitzada. A
        Cinema Gala, ens esforcem per oferir-te la millor experiència de cinema des de la comoditat de casa teva. Gaudeix
        de la funció!</p>
    </div>

    <!-- New "About us" section -->
    <div class="about-us">
      <h2>Sobre Nosaltres</h2>
      <p>Som un equip d'apassionats del cinema dedicat a portar-te les millors pel·lícules i sessions del dia. Creiem a la màgia del cinema i volem compartir-la amb tu.</p>
    </div>

    <!-- Footer -->
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
export default {

}
</script>

<style scoped>
body {
  margin: 0;
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
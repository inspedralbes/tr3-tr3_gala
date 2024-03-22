<template>
  <div class="container">
    <!-- Existing content -->
    <div class="content">
      <img src="../public/cinemagala.jpeg" alt="CinemaGala" class="image">
      <h1 class="title">CINEMA GALA</h1>
      <div class="links">
        <router-link to="/peliculas" class="link pink">Cartelera</router-link>
        <router-link to="/sesiones" class="link violet">Sessio del Dia</router-link>
        <router-link to="/login" class="link blue">Login</router-link>
      </div>
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
  .container {
    margin: 0 auto;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    height: 90vh;
  }

  @media (min-width: 640px) {
    .container {
      padding: 1.5rem;
    }
  }

  @media (min-width: 1024px) {
    .container {
      padding: 2rem;
    }
  }

  .content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
  }

  @media (min-width: 1280px) {
    .content {
      flex-direction: row;
    }
  }

  .image {
    width: 8rem;
    height: 8rem;
    border-radius: 50%;
    margin-bottom: 1rem;
  }

  @media (min-width: 1280px) {
    .image {
      margin-bottom: 0;
    }
  }

  .title {
    font-size: 2.25rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1.5rem;
  }

  @media (min-width: 1280px) {
    .title {
      text-align: left;
      margin-bottom: 0;
    }
  }

  .links {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 1.5rem;
    gap: 1rem;
  }

  @media (min-width: 1280px) {
    .links {
      flex-direction: row;
      justify-content: space-around;
      gap: 1rem;
    }
  }

  .link {
    padding: 0.5rem;
    text-align: center;
    font-weight: 700;
    border-radius: 0.375rem;
    flex: 1;
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
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
  }

  @media (min-width: 1280px) {
    .footer {
      flex-direction: row;
    }
  }
</style>
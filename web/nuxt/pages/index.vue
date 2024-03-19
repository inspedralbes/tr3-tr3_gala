<template>
  <div class="container">
    <div class="content">
      <div class="header">
        <h1 class="title">CINEMA GALA</h1>
        <img src="../public/cinemagala.jpeg" alt="CinemaGala" class="image">
      </div>
      <div class="links">
        <router-link to="/peliculas" class="link pink">
          Cartelera
        </router-link>
        <router-link to="/sesiones" class="link violet">
          Sessio del Dia
        </router-link>
        <router-link to="/login" class="link blue">
          Login 
        </router-link>
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
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100vw;
  background-color: #FFD7E8;
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.content {
  background-color: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0px 10px 30px -5px rgba(0, 0, 0, 0.1);
  width: 50%;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
}

.title {
  font-size: 2.5rem;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.image {
  width: 40%;
  border-radius: 50%;
  box-shadow: 0px 10px 30px -5px rgba(0, 0, 0, 0.1);
}

.links {
  display: flex;
  justify-content: space-around;
  margin-top: 2rem;
}

.link {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
  width: 30%;
  color: white;
  font-weight: bold;
  border-radius: 0.5rem;
  transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
  margin: 0 0.5rem;
}

.link:hover {
  transform: scale(1.05);
}

.link.pink {
  background-color: #ff4081;
}

.link.pink:hover {
  background-color: #f36c60;
}

.link.violet {
  background-color: #7c4dff;
}

.link.violet:hover {
  background-color: #651fff;
}

.link.blue {
  background-color: #448aff;
}

.link.blue:hover {
  background-color: #2979ff;
}
</style>
<template>
  <div>
      <form @submit.prevent="formPost">


          <div>
              <label for="email">Email</label>
              <input type="email" id="email" v-model="email">
          </div>

          <div>
              <label for="password">Contrasenya</label>
              <input type="password" id="password" v-model="password">
          </div>
          <div>
              <nuxt-link to="/registre">Encara no tens compte? Registra't!</nuxt-link>
          </div>

          <button type="submit">Inicia sessió</button>
          

      </form>
  </div>
</template>
<script>
export default{
  data(){
    return{
      email: '',
      password: ''
    }
  },
  methods: {
    formPost(){
      fetch('http://localhost:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          email: this.email,
          password: this.password
        })
      })
      .then(response => response.json())
      .then(data => {
        if(data && data.success){
          alert('Has iniciat sessió correctament!');
          this.$router.push('/sesiones');
        } else {
          alert('Error al iniciar sessió');
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
  }
}
</script>
  
<style lang="scss" scoped>
div {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
}

form {
  display: flex;
  flex-direction: column;
  width: 300px;
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 10px 30px -5px rgba(0, 0, 0, 0.1);
}

div > div {
  margin-bottom: 10px;
}

label {
  margin-bottom: 5px;
  font-weight: bold;
}

input {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #007BFF;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}
</style>
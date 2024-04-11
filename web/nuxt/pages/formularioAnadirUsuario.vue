<template>
  <form @submit.prevent="addUser" class="add-user-form">
    <input v-model="newUser.name" placeholder="Nombre" required class="form-input" />
    <input v-model="newUser.email" placeholder="Email" required class="form-input" />
    <input v-model="newUser.password" type="password" placeholder="Contraseña" required class="form-input" />
    <button type="submit" class="submit-button">Añadir usuario</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      newUser: {
        name: '',
        email: '',
        password: '',
      },
    };
  },
  methods: {
    addUser() {
    let userData = {
      name: this.name,
      email: this.email,
      password: this.password
    };

    console.log("User data:", userData);

    fetch('http://localhost:8000/api/addUser', {
      method: 'POST',
      body: JSON.stringify(userData),
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      console.log("Server response:", data);
      if (data.success) {
        this.name = '';
        this.email = '';
        this.password = '';
        this.$router.push('/zonaAdmin');
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }
  },
};
</script>
  <style scoped>
  .add-user-form {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin-top: 10%;
    margin-left: auto;
    margin-right: auto;
  }
  
  .form-input {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  
  .submit-button {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .submit-button:hover {
    background-color: #45a049;
  }
  </style>
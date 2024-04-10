<template>
  <form @submit.prevent="addUser" class="add-user-form">
    <input v-model="newUser.name" placeholder="Nombre" required class="form-input" />
    <input v-model="newUser.email" placeholder="Email" required class="form-input" />
    <input v-model="newUser.password" placeholder="Contraseña" required class="form-input" />
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
      async addUser() {
        const response = await fetch('http://localhost:8000/api/addUser', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.newUser),
        });
  
        if (!response.ok) {
          console.error('Error adding user:', response.statusText);
          return;
        }
  
        console.log('User added successfully');
        this.newUser = { name: '', email: '', password: '' }; 
        this.$router.push('/zonaAdmin'); 
      },
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
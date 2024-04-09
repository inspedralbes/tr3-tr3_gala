<template>
  <div class="admin-area">
    <h1>Zona Admin</h1>

    <button class="admin-button" @click="editUserList">Editar lista de usuarios</button>
    <ul>
      <li v-for="user in userList" :key="user.email">
        {{ user.name }} ({{ user.email }})
        <button @click="deleteUser(user)">Eliminar</button>
      </li>
    </ul>

    <button class="admin-button" @click="editBillboard">Modificar cartelera</button>
  <ul>
    <li v-for="movie in billboard" :key="movie.id">
      {{ movie.titol }}
      <button @click="deleteMovie(movie)">Eliminar</button>
    </li>
  </ul>
  <button class="admin-button" @click="goToAddMoviePage">Añadir</button>


  <button class="admin-button" @click="editSessions">Modificar sesiones</button>
    <ul>
      <li v-for="session in sessions" :key="session.id">
        Película ID: {{ session.pelicula_id }}, Fecha: {{ session.fecha }}, Hora: {{ session.hora }}
        <button @click="deleteSession(session)">Eliminar</button>
      </li>
    </ul>
    <button class="admin-button" @click="goToAddSessionPage">Añadir</button>
  </div>
</template>
<script>

export default {
  middleware: 'check-admin',
  data() {
    return {
      userList: [],
      billboard: []
    };
  },
  methods: {
    goToAddMoviePage() {
      this.$router.push('/formularioAnadirPeli');
    },
    goToAddSessionPage() {
      this.$router.push('/formularioAnadirSesiones');
    },
    async deleteUser(user) {
      const response = await fetch(`http://localhost:8000/api/deleteUser/${user.email}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        console.error('Error deleting user:', response.statusText);
        return;
      }

      console.log('User deleted successfully');
      this.editUserList();  // Refresh the user list
    },
    async deleteSession(session) {
      const response = await fetch(`http://localhost:8000/api/sessions/${session.id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        console.error('Error deleting session:', response.statusText);
        return;
      }

      console.log('Session deleted successfully');
      this.editSessions();  // Refresh the session list
    },
    async editSessions() {
      const response = await fetch('http://localhost:8000/api/sessions', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        console.error('Error getting session list:', response.statusText);
        return;
      }

      const data = await response.json();
      this.sessions = data;
    },
    async editUserList() {
      const response = await fetch('http://localhost:8000/api/getUsers', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        console.error('Error getting user list:', response.statusText);
        return;
      }

      const data = await response.json();
      this.userList = data.users;

      this.userList.push({
        name: 'New User',
        email: 'newuser@example.com',

      });

      const updateResponse = await fetch('http://localhost:8000/api/updateUserList', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ userList: this.userList }),
      });

      if (!updateResponse.ok) {
        console.error('Error updating user list:', updateResponse.statusText);
        return;
      }

      console.log('User list updated successfully');
    },
    editSessions() {
      // ...
    },
    async editBillboard() {
      const response = await fetch(`http://localhost:8000/api/pelicules`);

      if (!response.ok) {
        console.error('Error getting billboard:', response.statusText);
        return;
      }

      const data = await response.json();
      if (Array.isArray(data)) {
        this.billboard = data;
      } else {
        console.error('La respuesta de la API no tiene el formato esperado');
      }
    },
  }
}
</script>

<style scoped>
.admin-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.admin-button {
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-color: #3f51b5;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.admin-button:hover {
  background-color: #303f9f;
}
</style>
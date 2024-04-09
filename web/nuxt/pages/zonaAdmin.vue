<template>
  <div class="admin-area">
    <h1>Bienvenido a la Zona Admin</h1>

    <button class="admin-button" @click="toggleUserList">Editar lista de usuarios</button>
    <ul v-if="showUserList">
      <li v-for="user in userList" :key="user.email">
        {{ user.name }} ({{ user.email }})
        <button @click="deleteUser(user)">Eliminar</button>
      </li>
    </ul>

    <button class="admin-button" @click="toggleBillboard">Modificar cartelera</button>
    <ul v-if="showBillboard">
      <li v-for="movie in billboard" :key="movie.id">
        {{ movie.titol }}
        <button @click="deleteMovie(movie)">Eliminar</button>
      </li>
      <button class="admin-button" @click="goToAddMoviePage">Añadir</button>
    </ul>



    <button class="admin-button" @click="toggleSessions">Modificar sesiones</button>
    <ul v-if="showSessions">

      <li v-for="session in sessions" :key="session.sesion.id">
        Película ID: {{ session.sesion.pelicula_id }}, Fecha: {{ session.sesion.fecha }}, Hora: {{ session.sesion.hora
        }}
        <button @click="deleteSession(session.sesion)">Eliminar</button>
      </li>
      <button class="admin-button" @click="goToAddSessionPage">Añadir</button>
    </ul>

  </div>
</template>
<script>

export default {
  middleware: 'check-admin',
  data() {
    return {
      userList: [],
      billboard: [],
      sessions: [],
      showUserList: false,
      showBillboard: false,
      showSessions: false,
    };
  },
  methods: {
    toggleUserList() {
      this.showUserList = !this.showUserList;
      if (this.showUserList) {
        this.editUserList();
      }
    },
    toggleBillboard() {
      this.showBillboard = !this.showBillboard;
      if (this.showBillboard) {
        this.editBillboard();
      }
    },
    toggleSessions() {
      this.showSessions = !this.showSessions;
      if (this.showSessions) {
        this.editSessions();
      }
    },
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
    async deleteMovie(movie) {
      const response = await fetch(`http://localhost:8000/api/pelicules/${movie.id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        console.error('Error deleting movie:', response.statusText);
        return;
      }

      console.log('Movie deleted successfully');
      this.editBillboard();  // Refresh the billboard
    },

    async editSessions() {
      console.log('Editing sessions');
      fetch(`http://localhost:8000/api/sessions`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error al obtener los datos de la API");
          }
          return response.json();
        })
        .then((data) => {
          this.sessions = data.sessions;
          console.log('Sessions updated successfully');
          console.log(this.sessions);
        })
        .catch((error) => {
          console.error("Error al obtener datos de la API:", error);
        });
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
  background-color: #f5f5f5;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #333;
  margin-bottom: 20px;
  text-align: center;
  font-size: 24px;
  font-weight: bold;
}

.admin-button {
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-color: #3f51b5;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 10px;
  transition: background-color 0.3s ease;
}

.admin-button:hover {
  background-color: #303f9f;
}

ul {
  list-style-type: none;
  padding: 0;
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
}

li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  margin-bottom: 10px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

button {
  padding: 5px 10px;
  font-size: 14px;
  color: white;
  background-color: #f44336;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #d32f2f;
}
</style>
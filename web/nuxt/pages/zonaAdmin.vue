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
    <button class="admin-button" @click="editSessions">Modificar sesiones</button>
  </div>
</template>

<script>

export default {
  middleware: 'check-admin',
  data() {
    return {
      userList: []
    };
  },
  methods: {
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
    editBillboard() {
      // ...
    },
    editSessions() {
      // ...
    }
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
<template>
    <div class="admin-area">
      <h1>Zona Admin</h1>

      <button class="admin-button" @click="editUserList">Editar lista de usuarios</button>
      <button class="admin-button" @click="editBillboard">Modificar cartelera</button>
      <button class="admin-button" @click="editSessions">Modificar sesiones</button>
    </div>
  </template>
  
  <script>
  export default {
    middleware: 'check-admin',
    methods: {
      editUserList() {
        // ...
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
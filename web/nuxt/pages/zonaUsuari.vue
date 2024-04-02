<template>
    <div>
      <h1>Bienvenido, {{ store.state.email }}</h1>
      <h2>Tus compras:</h2>
      <ul>
        <li v-for="compra in compras" :key="compra.id">
 
          {{ compra.nombre }}
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import { compraStore } from '../stores/compra.js'
  
  const compras = ref([])
  
  onMounted(async () => {
    const ruta = 'http://localhost:8000'
    try {
      const response = await fetch(`${this.ruta}/api/comprasPorUsuario`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ userEmail: compraStore.state.email }),
      })
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      const data = await response.json()
      compras.value = data
    } catch (error) {
      console.error(error)
    }
  })
  </script>
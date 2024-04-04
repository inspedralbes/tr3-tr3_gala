<template>
  <div>
    <h1>Bienvenido, {{ compraStore().email }}</h1>
    <h2>Tus compras:</h2>
    <ul>
      <li v-for="compra in compras" :key="compra.id">
        ID de Compra: {{ compra.id }},
        ID de Sesión: {{ compra.sesion_id }},
        ID de Usuario: {{ compra.id_user }},
        ID de Butaca: {{ compra.butaca_id }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { compraStore } from '../stores/compra.js'

const compras = ref([])

onMounted(async () => {
  try {

    const store = compraStore();
    console.log(`Fetching purchases for user: ${store.email}`);
    const response = await fetch(`http://localhost:8000/api/comprasPorUsuario?userEmail=${store.email}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const data = await response.json()
    compras.value = data
    console.log(data);
  } catch (error) {
    console.error(error)
  }
})
</script>
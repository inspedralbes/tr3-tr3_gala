<template>
  <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4 p-4">
    <div class="md:flex">
    
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Bienvenido, {{ store.usuariosConectados[0].name }}</div>
        <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Tus compras:</h2>
        <ul class="mt-2 text-gray-500">
          <li v-for="compra in paginatedCompras" :key="compra.id" class="py-1">
            <span class="font-bold">ID de Compra:</span> {{ compra.id }},
            <span class="font-bold">ID de Sesión:</span> {{ compra.sesion_id }},
            <span class="font-bold">ID de Usuario:</span> {{ compra.id_user }},
            <span class="font-bold">ID de Butaca:</span> {{ compra.butaca_id }}
          </li>
        </ul>
        <div class="flex justify-between mt-4">
          <button @click="previousPage" :disabled="currentPage === 0" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Anterior</button>
          <button @click="nextPage" :disabled="currentPage >= maxPage" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
        </div>
        <div class="mt-4">
          <router-link to="/perfilUsuario" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar Perfil</router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted, computed } from 'vue'
import { compraStore } from '../stores/compra.js'
const store = compraStore()
const compras = ref([])
const currentPage = ref(0)
const itemsPerPage = 8

const paginatedCompras = computed(() => {
  const start = currentPage.value * itemsPerPage
  const end = start + itemsPerPage
  return compras.value.slice(start, end)
})

const maxPage = computed(() => Math.ceil(compras.value.length / itemsPerPage) - 1)

const nextPage = () => {
  if (currentPage.value < maxPage.value) {
    currentPage.value++
  }
}

const previousPage = () => {
  if (currentPage.value > 0) {
    currentPage.value--
  }
}

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
<template>
  <header class="cine-header w-12/12 mx-auto block" :style="{ backgroundColor: '#ff4081' }">
    <!-- Menú de navegación -->
    <nav class="cine-menu mx-auto flex max-w-5xl items-center justify-between p-6 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <nuxt-link to="/" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-12 w-auto rounded-full lg:block hidden" src="../public/cinemagala.jpeg" alt="" />
          <a v-if="compraStore().email" href="#" @click="tancarSessio"
            class="text-sm font-bold leading-6 text-white lg:hidden">
            Log out <span aria-hidden="true">&rarr;</span>
          </a>
          <a v-else href="/Login" class="text-sm font-bold leading-6 text-white lg:hidden">
            Log in <span aria-hidden="true">&rarr;</span>
          </a>
        </nuxt-link>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
          @click="mobileMenuOpen = true">
          <span class="sr-only">Open main menu</span>
          <!-- Icono de menú para dispositivos móviles -->
        </button>
      </div>
      <!-- Elementos del menú principal -->
      <nav class="block lg:gap-x-12">
        <ul class="flex space-x-4">
          <li><nuxt-link to="/index2" class="font-bold text-white">Inicio</nuxt-link></li>
          <li><nuxt-link to="/peliculas" class="font-bold text-white">Cartelera</nuxt-link></li>
          <li><nuxt-link to="/sesiones" class="font-bold text-white">Sesión del Día</nuxt-link></li>
          <li><nuxt-link to="/zonaUsuari" class="font-bold text-white">Zona Usuari</nuxt-link></li>
        </ul>
      </nav>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a v-if="compraStore().email" href="#" @click="logout"
          class="text-sm font-bold leading-6 text-white lg:hidden">
          Log out <span aria-hidden="true">&rarr;</span>
        </a>
        <a v-else href="/Login" class="text-sm font-bold leading-6 text-white">
          Log in <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </nav>
    <!-- Menú desplegable para dispositivos móviles -->
    <Dialog as="div" class="fixed inset-0 z-10 lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
      <div class="fixed inset-0 z-10" />
      <DialogPanel
        class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <nuxt-link to="/" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
          </nuxt-link>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
            <span class="sr-only">Close menu</span>
          </button>
        </div>
        <div class="py-6">
          <nuxt-link v-if="compraStore.state.email" :to="'/zonaUsuari/' + compraStore.state.email"
            class="font-bold text-white">
            {{ compraStore.state.email }} <span aria-hidden="true">&rarr;</span>
          </nuxt-link>
          <nuxt-link v-else to="/login" class="font-bold text-white">Login</nuxt-link>
        </div>
      </DialogPanel>
    </Dialog>
  </header>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { compraStore } from '../stores/compra.js'

export default {
  components: {
    Dialog,
    DialogPanel
  },
  setup() {
    const mobileMenuOpen = ref(false)

    const tancarSessio = async () => {
      let store = compraStore();
      let url = "http://localhost:8000/api/logout"
     
      let response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': `Bearer ${store.tokenUsuario}`
        },
      })
      let jsonResponse = await response.json()
      store.email = null
      store.tokenUsuario = null
      
    }

    return {
      mobileMenuOpen,
      tancarSessio
    }
  }
}
</script>
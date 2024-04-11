import { defineStore } from 'pinia';

export const compraStore = defineStore('store', {
  state: () => ({
    sessio: {},
    butacas: [],
    email: null,
    usuariosConectados: [],
    usuarioActual: {
      email: null,
      name: null,
      role: null
    },
    tokenUsuario: null,
    pelicula: null,
    imagen: null,
  }),
  actions: {
    agregarUsuarioConectado(nombre) {
      if (!this.usuariosConectados.includes(nombre)) {
        this.usuariosConectados.push(nombre);
      }
    },
    setUsuarioActualRole(role) {
      this.usuarioActual.role = role;
    },
  },
});
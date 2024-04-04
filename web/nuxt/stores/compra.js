import { defineStore } from 'pinia';

export const compraStore = defineStore('store', {
  state: () => ({
    sessio: {},
    butacas: [],
    email: null,
    usuariosConectados: [],
    usuarioActual: null,
    tokenUsuario: null
  }),
  actions: {
    agregarUsuarioConectado(nombre) {
      if (!this.usuariosConectados.includes(nombre)) {
        this.usuariosConectados.push(nombre);
      }
    },
  },
});
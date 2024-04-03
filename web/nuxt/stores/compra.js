import { defineStore } from 'pinia';

export const compraStore = defineStore('store', {
  state: () => ({
    sessio: {},
    butacas: [],
    email: null,
    usuariosConectados: [],
    usuarioActual: null,
  }),
  actions: {
    
    agregarUsuarioConectado(nombre) {
      this.usuariosConectados.push(nombre);
    },
  },
});
import { defineStore } from 'pinia';

export const compraStore = defineStore('store', {
  state: () => ({
    sessio: {},
    butacas: [],
    email: null,
    usuariosConectados: [],
  }),
  actions: {
    
    agregarUsuarioConectado(nombre) {
      this.usuariosConectados.push(nombre);
    },
  },
});
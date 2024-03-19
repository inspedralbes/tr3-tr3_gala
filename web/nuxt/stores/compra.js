import { defineStore } from 'pinia';

export const compraStore = defineStore('compra', {
  state: () => ({
    sessio: {},
    butacas: []
  })
});
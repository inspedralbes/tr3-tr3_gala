// store.js
import { defineStore } from 'pinia';

export const compraStore = defineStore('store', {
  state: () => ({
    sessio: {},
    butacas: [],
    email: null,  
  }),
});
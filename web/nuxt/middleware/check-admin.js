import { compraStore } from '../stores/compra.js'

export default function ({ redirect }) {
  const store = compraStore();
  if (store.usuarioActual.role !== 'admin') {
    return redirect('/')
  }
}
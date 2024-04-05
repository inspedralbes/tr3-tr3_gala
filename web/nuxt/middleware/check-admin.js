import { compraStore } from '../stores/compra.js'

export default function ({ redirect }) {
    const store = compraStore();
    
    if (!store.usuarioActual) {
      return redirect('/'); 
    }

    const usuarioConectado = store.usuariosConectados.find(user => user.name === store.usuarioActual.name);

    if (!usuarioConectado || usuarioConectado.role !== 'admin') {
      return redirect('/'); 
    }
}
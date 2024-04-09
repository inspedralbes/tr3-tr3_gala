<template>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4 p-4">
        <div class="md:flex">
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Perfil de Usuario</div>
                <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Tus Datos:</h2>
                <ul class="mt-2 text-gray-500">
                    <li class="py-1">
                        <span class="font-bold">Nombre:</span> {{ userData.name }}
                        <button @click="editField('name')">Editar</button>
                    </li>              
                    <li class="py-1">
                        <span class="font-bold">Contraseña:</span> ****
                        <button @click="editField('password')">Editar</button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal-->
        <div v-if="editing" class="modal" @click="editing = false">
            <div class="modal-content" @click.stop>
                <label class="modal-label" :for="editing">{{ editing }}</label>
                <input class="modal-input" :id="editing" v-model="newField" :type="editing === 'password' ? 'password' : 'text'">
                <button class="modal-button" @click="saveChanges">Guardar Cambios</button>
            </div>
        </div>
    </div>
</template>
<script>
import { compraStore } from "../stores/compra.js";

export default {
    data() {
        return {
            userData: {
                email: '',
                name: '',
               
            },
            newField: '',
            editing: null,
        };
    },
    methods: {
        editField(field) {
            console.log('editField called with', field);
            this.newField = this.userData[field];
            this.editing = field;
        },
        async saveChanges() {
            console.log('saveChanges called');

            const store = compraStore();
            console.log("ey", store.usuarioActual.email);

            if (!store.usuarioActual) {
                console.error('usuarioActual is not defined in the store');
                return;
            }

            const updatedUserData = {
                email: store.usuarioActual.email,
                [this.editing]: this.newField
            };

            if (this.editing === 'password') {
                updatedUserData.newPassword = this.newField;
            }

            const response = await fetch('http://localhost:8000/api/updateUser', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(updatedUserData),
            });

            if (!response.ok) {
                console.error('Error updating user:', response.statusText);
                return;
            }

            const data = await response.json();

            if (!data.user) {
                console.error('User is not defined in the response');
                return;
            }

            this.userData.email = data.user.email;
            this.userData[this.editing] = this.newField;

            this.editing = null;
        }
    }
};
</script>
<style scoped>
.modal {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease;
}

.modal-content {
    background: rgb(255, 255, 255);
    padding: 20px;
    border-radius: 4px;
    width: 300px;
    box-sizing: border-box;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.modal-label {
    font-size: 1.2em;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
}

.modal-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 20px;
}

.modal-button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.modal-button:hover {
    background-color: #2980b9;
}
</style>
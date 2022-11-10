
<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

let turnos = ref({
    id: '',
    turno: '',
    estado: ''
})

onMounted(async () => {
    getTurno()
})

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})

const getTurno = async () => {
    let response = await axios.get("/api/Pelicula/Turno/" + props.id)
    turnos.value = response.data.turnos
    console.log(turnos.value)
}


const nuevoTurno = (id) => {
    router.push('/Turno/' + id)
}

const editarTurno = (id) => {
    router.push('/Turno/editar/' + id)
}

const eliminarTurno = (id) => {
    Swal.fire({
        title: 'Confirmar Eliminar',
        text: 'Ya no se podra corregir',
        icon: 'warning',
        showCancelButton: true,
        confirmButtomColor: '#3085d6',
        cancelButoomText: '#d33',
        confirmButtomText: 'Si, Eliminar'
    })
        .then((result) => {
            if (result.value) {
                axios.delete('/api/Turno/' + id)
                    .then(() => {
                        Swal.fire(
                            'delete',
                            'pelicula eliminada correctamente',
                            'success'
                        )

                        getTurno()
                    })
                    .catch(() => {
                        Swal.fire('fallo', 'algo sucedio', 'warning')
                    })
            }
        })
}

</script>

<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Turnos</p>
                <button class="btn btn-primary btn-sm" @click="nuevoTurno(props.id)">nuevo</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Turno</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in turnos" :key="item.id">
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.turno }}</td>
                            <td>{{ item.estado }}</td>
                            <td><button class="btn btn-success btn-sm" @click="editarTurno(item.id)">Editar</button>
                                <button class="btn btn-danger btn-sm" @click="eliminarTurno(item.id)">Eliminar</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>
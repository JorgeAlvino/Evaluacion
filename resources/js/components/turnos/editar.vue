<script setup>

import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

let form = ref({
    turno: '',
    estado: ''
})

onMounted(async () => {
    getsingleTurno()
})

const router = useRouter()
const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})


const getsingleTurno = async () => {
    let response = await axios.get('/api/Turno/' + props.id + '/edit')
    form.value = response.data.turno
}

const actualizarTurno = () => {
    axios.put('/api/Turno/' + form.value.id, {
        turno: form.value.turno,
        estado: form.value.estado,
    }).then((response) => {
        form.value.turno = '',
            form.value.estado = '',
            toast.fire({
                icon: "success",
                title: "turno actualizado"
            })
    }).catch((error) => {
    })
    router.push('/pelicula/turno/' + form.value.id_pelicula)
}
</script>
<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Editar Turno</p>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Turno</label>
                        <input type="time" class="form-control" id="turno" v-model="form.turno">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="estado" v-model="form.estado">
                            <label class="form-check-label" for="flexCheckDefault">
                                Activo?
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" @click="actualizarTurno()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
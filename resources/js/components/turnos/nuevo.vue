<script setup>

import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

let form = ref({
    turno: '',
    estado: '',
    id_pelicula: ''
})

const router = useRouter()

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})


const guardarTurno = () => {
    const formData = new FormData()
    formData.append('turno', form.value.turno)
    formData.append('estado', form.value.estado)
    formData.append('id_pelicula', props.id)


    axios.post("/api/Turno", formData)
        .then((response) => {
            form.value.turno = '',
                form.value.estado = '',
                form.value.id_pelicula = ''
            toast.fire({
                icon: "success",
                title: "turno agregada"
            })

        })
        .catch((error) => {

        })
    router.push('/pelicula/turno/' + props.id)


}



</script>

<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Nuevo Turno</p>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Turno</label>
                        <input type="time" class="form-control" id="turno" v-model="form.turno">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="estado" v-model="form.estado">
                        <label class="form-check-label" for="flexCheckDefault">
                            Activo?
                        </label>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" @click="guardarTurno()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
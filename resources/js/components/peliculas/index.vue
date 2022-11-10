
<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';


const router = useRouter()

let peliculas = ref([])

onMounted(async () => {
    getPeliculas()
})
const nuevaPelicula = () => {
    router.push('/pelicula')
}

const editarPelicula = (id) => {
    router.push('/pelicula/editar/' + id)
}

const turnoIndex = (id) => {
    router.push('/pelicula/turno/' + id)
}

const getPeliculas = async () => {
    let response = await axios.get("/api/Pelicula")
    peliculas.value = response.data.peliculas
}

const ourImage = (img) => {
    return "/upload/" + img
}

const eliminarPelicula = (id) => {
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
                axios.delete('/api/Pelicula/' + id)
                    .then(() => {
                        Swal.fire(
                            'delete',
                            'pelicula eliminada correctamente',
                            'success'
                        )
                        getPeliculas()
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
                <p>Peliculas</p>
                <button class="btn btn-primary btn-sm" @click="nuevaPelicula">nuevo</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Fecha Publicación</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in peliculas" :key="item.id">
                            <th scope="row">{{ item.id }}</th>
                            <td>{{ item.nombre }}</td>
                            <td> <img alt=""> </td>
                            <td>{{ item.fecha_publicacion }}</td>
                            <td><button class="btn btn-success btn-sm" @click="editarPelicula(item.id)">Editar</button>
                                <button class="btn btn-danger btn-sm"
                                    @click="eliminarPelicula(item.id)">Eliminar</button>
                                <button class="btn btn-dark btn-sm" @click="turnoIndex(item.id)">Turno</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>
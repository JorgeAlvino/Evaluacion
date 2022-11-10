<script setup>

import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

let form = ref({
    id: '',
    nombre: '',
    fecha_publicacion: '',
    imagen: ''
})

onMounted(async () => {
    getsinglePeliculas()
})

const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})

const router = useRouter()

const getsinglePeliculas = async () => {
    let response = await axios.get('/api/Pelicula/' + props.id + '/edit')
    form.value = response.data.pelicula
}

const getImagen = () => {

    let imagen = "/upload/user.png"
    if (form.value.imagen) {
        if (form.value.imagen.indexOf('base64') != -1) {
            imagen = form.value.imagen
        } else {
            imagen = '/upload/' + form.value.imagen
        }
    }
    return imagen
}

const actualizarPelicula = () => {

    axios.put('/api/Pelicula/' + form.value.id, {
        nombre: form.value.nombre,
        fecha_publicacion: form.value.fecha_publicacion,
        imagen: form.value.imagen
    })
        .then((response) => {
            form.value.nombre = '',
                form.value.fecha_publicacion = '',
                form.value.imagen = '',

                toast.fire({
                    icon: "success",
                    title: "pelicula agregada"
                })

        })
        .catch((error) => {

        })
    router.push('/')
}

const updateImagen = (e) => {

    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if (file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.value.imagen = reader.result;
    }
    reader.readAsDataURL(file);
}
</script>
<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Editar Pelicula</p>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="nombre" class="form-control" id="nombre" v-model="form.nombre">
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_publicacion" class="form-label">Fecha Publicación</label>
                        <input type="date" class="form-control" id="fecha_publicacion" v-model="form.fecha_publicacion">
                    </div>
                    <div class="col-6">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" @change="updateImagen">
                    </div>
                    <div class="col-6">
                        <label for="imagen" class="form-label">Imagen</label>
                        <img :src="getImagen()" alt="">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" @click="actualizarPelicula()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
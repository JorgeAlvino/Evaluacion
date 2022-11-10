<script setup>

import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

let form = ref({
    nombre: '',
    fecha_publicacion: '',
    imagen: ''
})

const router = useRouter()

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

const guardarPelicula = () => {
    const formData = new FormData()
    formData.append('nombre', form.value.nombre)
    formData.append('fecha_publicacion', form.value.fecha_publicacion)
    formData.append('imagen', form.value.imagen)


    axios.post("/api/Pelicula", formData)

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

</script>

<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Nueva Pelicula</p>
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
                        <button class="btn btn-primary" @click="guardarPelicula()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
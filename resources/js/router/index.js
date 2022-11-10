import { createRouter, createWebHistory } from "vue-router";

import peliculaIndex from '../components/peliculas/index.vue';
import nuevaPelicula from '../components/peliculas/nuevo.vue';
import editarPelicula from '../components/peliculas/editar.vue';

import turnoIndex from '../components/turnos/index.vue';
import nuevoTurno from '../components/turnos/nuevo.vue';
import editarTurno from '../components/turnos/editar.vue';

const routes = [

    {
        path: '/',
        component: peliculaIndex
    },
    {
        path: '/pelicula',
        component: nuevaPelicula
    },
    {
        path: '/pelicula/editar/:id',
        component: editarPelicula,
        props: true
    },
    {
        path: '/pelicula/turno/:id',
        component: turnoIndex,
        props: true
    },
    {
        path: '/Turno/:id',
        component: nuevoTurno,
        props: true
    },
    {
        path: '/Turno/editar/:id',
        component: editarTurno,
        props:true
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;
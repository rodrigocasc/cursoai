<template>
    <AppHeader />
    <h1 class="font-bold text-2xl mt-5">
        Cursos adicionados recentemente
    </h1>
    <div v-if="pending">
        Carregando...
    </div>

    <div v-else-if="error">
        Ocorreu algum problema de conexão. Tente novamente
    </div>

    <div v-else v-for="course in data" :key="course.id">
        <ListCourses 
            :course="(course as Course)"
            :subscribe="({} as CourseSubscribe)"
        />
        </div>
</template>

<script setup lang="ts">
import { baseURL } from '~/constants';
import type { Course } from '~/models/Course';
import type { CourseSubscribe } from '~/models/CourseSubscribe';

const { data, pending, error }: any = useFetch(`${baseURL}/courses/all`, {
    method: "GET",
    credentials: "include",
})

</script>
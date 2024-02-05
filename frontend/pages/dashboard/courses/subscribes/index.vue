<template>
    <AppHeader />
    <h1 class="font-bold text-2xl mt-5">
        Minhas inscrições
    </h1>
    
    <div v-if="pending">
        Carregando...
    </div>

    <div v-else-if="error">
        Ocorreu algum problema de conexão. Tente novamente
    </div>

    <div v-else v-for="subscribe in data" :key="subscribe.course_id">
        <ListCourses
            :course="{}"
            :subscribe="(subscribe as CourseSubscribe)"
        /> 
    </div>
</template>

<script setup lang="ts">
import { baseURL } from '~/constants';
import { CourseSubscribe } from '~/models/CourseSubscribe';

const userSession = useUserSession.value
const {data, pending, error }: any = useFetch(`${baseURL}/courses/subscribe/user/${userSession!.id}`, {
    method: "GET",
    credentials: "include"
})

</script>
<template>
    <AppHeader />
    <div class="flex justify-between items-center mt-5">
        <h1 class="font-bold text-2xl">
            Editar usuário
        </h1>
    </div>
    <div class="py-5">
        <div v-if="error">
            Ocorreu um problema. Tente novamente. {{ error }}
        </div>

        <div v-else-if="pending">
            Carregando...
        </div>

        <div v-else>
            <FormEditUser 
                :user="(user as User)"
            />
        </div>
        
    </div>
</template>
<script setup lang="ts">
import { baseURL } from '~/constants';
import type { User } from '~/models/User';

const router = useRoute();

const { data: user, pending, error } = useFetch(`${baseURL}/users/id/${router.params.id}`, {
    method: "GET",
    credentials: "include"
})

</script>~/models/User
<template>
    <AppHeader />
    <div class="flex justify-between items-center mt-5">
        <h1 class="font-bold text-2xl">
            Gerenciar usuários
        </h1>
    </div>

    <div class="grid sm:grid-cols-2 gap-5 py-5">
        <div v-if="error">
            Ocorreu um problema. Tente novamente.
        </div>

        <div v-else-if="pending">
            Carregando...
        </div>

        <div v-else v-for="user in data" :key="user.id">
            <ListUsers
                :user="(user as User)"
                :action="() => navigateTo(`/dashboard/users/manager/${user.id}`)"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { baseURL } from '~/constants';
import type { User } from '~/models/User';

const { data, pending, error }: any = useFetch(`${baseURL}/users/all`, {
    method: "GET",
    credentials: "include",
})

</script>
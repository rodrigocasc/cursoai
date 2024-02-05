<template>
    <AppHeader />

    <div v-if="pending">
            Carregando...
    </div>

    <div v-else-if="error">
        Ocorreu algum problema de conexão. Tente novamente
    </div>
    
    <div v-else>
        <Course 
            :name="data.course.name"
            :description="data.course.description"
            :is-subscribe="isSubscribe"
            :action-subscribe="actionSubscribe"
        />
    </div>
</template>

<script setup lang="ts">
import { baseURL } from '~/constants';

const route = useRoute();
const useSession = useUserSession.value

const { data, pending, error }: any = useAsyncData(
    "courses-subscribe",
    async () => {
        const [course, subscribe] = await Promise.all([
        $fetch(`${baseURL}/courses/id/${route.params.id}`, {
                method: "GET",
                credentials: "include"
            }),
        $fetch(`${baseURL}/courses/subscribe/user/${useSession!.id}`, {
                method: "GET",
                credentials: "include"
            })
        ])

        return { course, subscribe }
    }
)

const isSubscribe = ref(false)

watchEffect(async () => {
    await data.value.subscribe.map((subs: any) => {
        if(subs.course_id == route.params.id) {
            isSubscribe.value = true;
        }
    })
})

const actionSubscribe = async () => {
    if(isSubscribe.value) {
        isLoading.value = true;
        await $fetch(`${baseURL}/courses/unsubscribe/${route.params.id}`, {
            method: "POST",
            credentials: "include",
            onResponseError: (error) => useFetchHandler(error.response._data.error)
        })
        isLoading.value = false;

        return isSubscribe.value = false;
    }

    if(!isSubscribe.value) {
        isLoading.value = true;
        await $fetch(`${baseURL}/courses/subscribe/${route.params.id}`, {
            method: "POST",
            credentials: "include",
            onResponseError: (error) => useFetchHandler(error.response._data.error)
        })
        isLoading.value = false;

        return isSubscribe.value = true;
    }
}

</script>
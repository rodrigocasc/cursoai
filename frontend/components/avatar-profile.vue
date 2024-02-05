<template>
    <UDropdown
        mode="click"
        :items="items"
        :popper="{ placement: 'bottom-start' }"
    >
        <UAvatar
            icon="i-heroicons-user-16-solid"
            size="md"
        />
    </UDropdown>
</template>

<script setup lang="ts">
const userSession = useUserSession.value
const items: Array<any> = [
    [{
        label: "Editar",
        icon: "i-heroicons-pencil-square-20-solid",
        click: () => navigateTo(`/dashboard/users/manager/${userSession!.id}`)
    },
    {
        label: "Cursos",
        icon: "i-heroicons-video-camera-16-solid",
        click: () => {
            return navigateTo("/dashboard/courses/subscribes")
        }
    },
    {
        class: userSession!.is_administrator ? null : "hidden",
        label: "Gerenciar cursos",
        icon: "i-heroicons-film-16-solid",
        click: () => navigateTo("/dashboard/courses/manager")
    },
    {
        class: userSession!.is_administrator ? null : "hidden",
        label: "Gerenciar usuários",
        icon: "i-heroicons-user-group-16-solid",
        click: () => navigateTo("/dashboard/users/manager")
    },
    {
        label: "Sair",
        icon: "i-heroicons-arrow-left-start-on-rectangle-16-solid",
        click: () => {
            const cookie = useCookie('cursoai_session');
            cookie.value = null
            return navigateTo('/')
        }
    }]
]
</script>
<template>
    <div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-4xl py-5">{{ props.name }}</h1>
            <UButton
                :loading="isLoading"
                color="indigo"
                :label="props.isSubscribe ? 'Desinscrever' : 'Inscrever'"
                v-on:click = props.actionSubscribe
            />
        </div>
        <div class="flex w-full border rounded-md border-gray-950 bg-gray-800 p-2 mb-5">
            <div class="grid grid-cols-1">
                <h1 class="font-semibold text-xl">Descrição</h1>
                {{ props.description }}
            </div>
        </div>
        <div>
            <img 
                src="/images/thumbnail-courses.svg"
                class="sm:w-full"
            />
        </div>
    </div>

</template>

<script setup lang="ts">

const props = defineProps({
    id: Number,
    name: String,
    description: String,
    author: String,
    isSubscribe: Boolean,
    actionSubscribe: Function
})

</script>
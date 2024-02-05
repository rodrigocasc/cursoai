<template>
    <UButton
        variant="ghost"
        color="indigo"
        icon="i-heroicons-arrow-left-16-solid"
        v-on:click="router.back()"
    />
</template>

<script setup>
const router = useRouter();
</script>
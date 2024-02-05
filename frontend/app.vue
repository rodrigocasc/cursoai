<template>
  <NuxtLayout>
    <NuxtPage></NuxtPage>
  </NuxtLayout>

  <UNotifications />
</template>

<script setup>
onMounted(() => {
  useUserSession;
})
</script>
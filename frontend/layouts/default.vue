<template>
    <main class="container mx-auto max-w-4xl h-screen p-4">
        <slot></slot>
    </main>
</template>

<script setup>
useHead({
    title: "CursoAí - Plataforma de ensino a distância",
    link: [
        {
            rel: 'preconnect',
            href: 'https://fonts.googleapis.com'
        },
        {
            rel: 'stylesheet',
            href: 'https://fonts.googleapis.com/css2?family=Inter&display=swap',
            crossorigin: ''
        }
    ],
    htmlAttrs: {
    lang: 'pt-BR'
  },
});

useSeoMeta({
  description: '[description]',
  ogTitle: '[og:title]',
  ogDescription: '[og:description]',
  ogImage: '[og:image]',
  ogUrl: '[og:url]',
  twitterTitle: '[twitter:title]',
  twitterDescription: '[twitter:description]',
  twitterImage: '[twitter:image]',
  twitterCard: 'summary'
})
</script>

<style>
body {
    font-family: 'Inter';
}

body {
    @apply bg-gray-900 text-gray-300
}
</style>
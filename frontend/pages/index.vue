<template>
    <div class="flex justify-center items-center h-full">
        <div class="grid grid-rows-1 gap-2">
            <div class="flex justify-center items-center">
                <h1 class="font-bold text-4xl">CursoAí</h1>
            </div>
            <div class="flex justify-center items-center">
                <h1 class="text-xl text-gray-400">Sua plataforma de ensino a distância</h1>
            </div>
            <div>
                <FormLogin />
                
                <UDivider class="py-4" label="Não possuo acesso" />

                <UButton
                    to="/register"
                    size="lg"
                    type="submit" 
                    color="indigo"
                    variant="solid"
                    icon="i-heroicons-arrow-right-end-on-rectangle"
                    class="flex justify-center items-center w-full">
                    Criar conta
                </UButton>
            </div>
        </div>
    </div>
</template>
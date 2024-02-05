<template>
    <AppHeader />
    <div class="flex justify-between items-center mt-5">
        <h1 class="font-bold text-2xl">
            Gerenciar cursos
        </h1>
        <UButton 
            label="Adicionar"
            color="indigo"
            @click="openAdd"
        />
    </div>

    <div v-if="pending">
        Carregando...
    </div>

    <div v-else-if="error">
        Ocorreu um problema. Tente novamente
    </div>

    <div v-else v-for="course in data" :key="course.id">
        <ListCourses
            :course="(course as Course)"
        />

        <div class="flex justify-start items-center gap-2">
            <UButton
                class="bg-indigo-900"
                color="indigo"
                size="sm"
                icon="i-heroicons-pencil-square-16-solid"
                @click="openEdit(course)"
            />
        </div>
    </div>

    <USlideover v-model="isOpen" prevent-close>
            <UCard 
                class="flex flex-col flex-1" 
                :ui="{ body: { base: 'flex-1' }, ring: '', divide: 'divide-y divide-gray-100 dark:divide-gray-800' }">
                <template #header>
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">
                            <div v-if="chooseOption.option == 1">
                                {{ courseRef.name }}
                            </div>

                            <div v-if="chooseOption.option == 2">
                                Adicionar curso
                            </div>
                        </h3>
                        <UButton 
                            color="gray" 
                            variant="ghost" 
                            icon="i-heroicons-x-mark-20-solid" class="-my-1" 
                            @click="closeSlideover" 
                        />
                    </div>
                </template>
                    <div v-if="chooseOption.option == 1" class="space-y-2">
                        <FormEditCourse
                            class="h-full"
                            :course="courseRef"
                        />
                        <UButton 
                            size="xl"
                            class="w-full flex justify-center items-center"
                            color="red"
                            label="Deletar"
                            @click="deleteCourse(courseRef.id!)"
                        />
                    </div>

                    <div v-if="chooseOption.option == 2">
                        <FormAddCourse
                            class="h-full"
                        />
                    </div>
            </UCard>
        </USlideover>
</template>

<script setup lang="ts">
import { baseURL } from '~/constants';
import { Course } from '~/models/Course';

const userSession = useUserSession.value;
const isOpen = ref(false)
const chooseOption = ref({option: 0})

let courseRef = reactive<Course>({})

const { data, pending, error, refresh }: any = useAsyncData(
    "manager-courses",
    async () => await $fetch(`${baseURL}/courses/manager/${userSession!.id}`, {
        method: "GET",
        credentials: "include",
    })
)

const deleteCourse = async (id: number) => {
    isLoading.value = true
    await $fetch(`${baseURL}/courses/delete/${id}`, {
        method: "DELETE",
        credentials: "include",
        onRequestError: (error) => useFetchHandler(error.response?._data.error)
    })
    isLoading.value = false

    useFetchHandler("Deletado", true)
}

const openEdit = (course: Course): void => {
    chooseOption.value.option = 1
    isOpen.value = true
    courseRef = course
}

const openAdd = (): void => {
    chooseOption.value.option = 2
    isOpen.value = true
}

const closeSlideover = (): void => {
    chooseOption.value.option = 0
    isOpen.value = false
    return refresh()
}
</script>~/models/Course
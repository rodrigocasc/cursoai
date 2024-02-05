<template>
    <div class="grip grid-cols-1 space-y-3">
        <UForm :schema="schema" :state="state" @submit="onSubmit" class="space-y-2">
            <UFormGroup name="name">
                <UInput
                    size="xl"
                    v-model="state.name"
                    color="indigo"
                    type="text"
                />
            </UFormGroup>
            
            <UFormGroup name="description">
                <UTextarea
                    size="xl"
                    color="indigo"
                    v-model="state.description" 
                    autoresize
                />
            </UFormGroup>

            <UButton
                :loading="isLoading"
                class="w-full flex justify-center items-center"
                size="xl"
                color="indigo"
                label="Salvar"
                type="submit"
            />
        </UForm>
    </div>
</template>
<script setup lang="ts">
import type { FormSubmitEvent } from '@nuxt/ui/dist/runtime/types';
import { z } from 'zod';
import { baseURL } from '~/constants';
import { Course } from '~/models/Course';
import { CourseValidator } from '~/validators/CourseValidator';

const props = defineProps({
    course: Course
})

const schema = CourseValidator.schema

type Schema = z.output<typeof schema>

const state = reactive<Course>(props.course!)

const onSubmit = async (event: FormSubmitEvent<Schema>) => {
    isLoading.value = true
    await $fetch(`${baseURL}/courses/update/${state.id}`, {
        method: "PATCH",
        body: state,
        credentials: "include",
        onRequestError: (error) => useFetchHandler(error.response?._data.error),
    })
    isLoading.value = false

    useFetchHandler("Atualizado", true)

}
    
</script>~/models/Course
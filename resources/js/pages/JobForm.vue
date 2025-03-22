<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';

const form = useForm({
  title: null,
  description: null,
  email: null,
})

const submit = () => {
  form.post(route('jobs.store'), {
    onSuccess: () => {
      form.reset()
      form.recentlySuccessful = true
    },
  })
}
</script>

<template>
    <Head title="Create">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <div class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div
                    class="flex-1 rounded-bl-lg rounded-br-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] lg:rounded-br-none lg:rounded-tl-lg lg:p-20"
                >
                    <div class="flex flex-col space-y-6">
                    <HeadingSmall title="Create a new job" description="Job details" />

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <Input id="title" class="mt-1 block w-full" v-model="form.title" autocomplete="title" placeholder="Job title" />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="description">Description</Label>
                            <Textarea id="description" class="mt-1 block w-full" v-model="form.description" placeholder="Job description" />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                autocomplete="username"
                                placeholder="Email address"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="flex items-center gap-4">
                            <Button :disabled="form.processing">Save</Button>
                            <Button as="a" href="/" variant="outlined">Cancel</Button>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Job successfully created.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import JobCard from '../components/JobCard.vue';
import { Button } from '@/components/ui/button';
import { SquarePlus  } from 'lucide-vue-next'

interface Props {
    jobs: Array<Job>;
}

defineProps<Props>();
</script>

<template>
    <Head title="Lstings">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <div class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div
                    class="flex-1 rounded-bl-lg rounded-br-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] lg:rounded-br-none lg:rounded-tl-lg lg:p-20"
                >
                    <Button as="a" href="/jobs/create" variant="outlined"><SquarePlus class="w-4 h-4" /> Create a Job</Button>
                    <h1 class="scroll-m-20 text-4xl font-extrabold tracking-tight lg:text-5xl mb-5">
                        Job Listings
                    </h1>
                    <JobCard v-for="job in jobs" :key="job.id" :job="job" />
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>

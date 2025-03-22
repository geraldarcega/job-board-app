<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button'
import { ChevronLeft } from 'lucide-vue-next'

interface Props {
    job: Job;
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
                    <Button as="a" href="/" variant="outlined"><ChevronLeft class="w-4 h-4" /> Back to listings</Button>
                    <h3 class="scroll-m-20 text-2xl font-extrabold tracking-tight lg:text-3xl mb-5">
                        {{ job.title }}
                    </h3>
                    <div v-if="job.external_id">
                        <p><strong>Company:</strong> {{ job.external_details?.id ? job.external_details?.subcompany : '' }}</p>
                    </div>
                    <div v-if="job.external_id">
                        <p>
                            <strong>Office:</strong> {{ job.external_details.office }}
                            <span v-if="job.external_details?.additional_offices"> / {{ job.external_details.additional_offices.office }}</span>
                        </p>
                    </div>
                    <div v-if="job.external_id">
                        <p>
                            <strong>Seniority:</strong> {{ job.external_details.seniority }}
                        </p>
                    </div>
                    <div v-if="job.external_id">
                        <p>
                            <strong>Schedule:</strong> {{ job.external_details.schedule }}
                        </p>
                    </div>
                    <div v-if="job.external_id">
                        <p>
                            <strong>Years of experience:</strong> {{ job.external_details.years_of_experience }} years
                        </p>
                    </div>
                    <div>
                        <strong>Details:</strong> 
                        <p>{{ job.description }}</p>
                        <div v-if="job.external_id">
                            <div v-for="(jobDescription, index) in job.external_details.job_descriptions.jobDescription" :key="index">
                                <p>{{ jobDescription.name }}</p>
                                <div v-html="jobDescription.value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>

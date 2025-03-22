<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import { Link } from '@inertiajs/vue3';

interface Props {
    job: Job;
}

const props = defineProps<Props>();
</script>

<template>
    <Link :href="`/jobs/${props.job.slug}`">
        <Card class="w-full mb-3 cursor-pointer">
            <CardHeader>
                <CardTitle>{{ props.job.title }}</CardTitle>
                <CardDescription>{{ props.job.external_details?.id ? props.job.external_details?.subcompany : '' }}</CardDescription>
            </CardHeader>
            <CardContent class="p-4">
                <div v-if="props.job.external_details?.id" class="text-sm text-gray-500 mt-2">
                    <ul>
                        <li>
                            {{ props.job.external_details.office }}
                            <span v-if="props.job.external_details?.additional_offices"> / {{ props.job.external_details.additional_offices.office }}</span>
                        </li>
                        <li>{{ props.job.external_details.seniority }}</li>
                        <li>{{ props.job.external_details.years_of_experience }} years of experience</li>
                    </ul>
                </div>
            </CardContent>
        </Card>
    </Link>
</template>

<style scoped>
.cursor-pointer {
  transition: transform 0.2s ease-in-out;
}
.cursor-pointer:hover {
  transform: scale(1.02);
}
</style>
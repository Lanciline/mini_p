<template>
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ property.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ property.title }}</h1>
                                <p class="text-gray-600 dark:text-gray-400">{{ property.city }} - {{ property.address }}</p>

                                <div class="mt-4">
                                    <p class="text-gray-600 dark:text-gray-300">{{ property.description }}</p>
                                </div>
                            </div>
                            <div>
                                <DateRangeCalendar :property-id="property.id" @reserved="onReserved" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import DateRangeCalendar from '@/Components/DateRangeCalendar.vue'
import Layout from '@/Layouts/AppLayout.vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'

const { props } = usePage()
const property = props.value.property

async function onReserved(payload) {
  try {
    const res = await axios.post('/reservations', {
      property_id: property.id,
      start_date: payload.start_date,
      end_date: payload.end_date,
    });

    // on success, redirect to user's reservations page
    Inertia.visit('/my/reservations');
  } catch (err) {
    const message = err.response?.data?.message || 'Erreur lors de la réservation';
    alert(message);
  }
}
</script>

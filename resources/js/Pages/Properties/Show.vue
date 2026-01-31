<template>
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ property.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                        <!-- Image Gallery -->
                        <div class="mb-6">
                            <div v-if="property.images && property.images.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-1">
                                    <img :src="`/storage/${property.images[0].path}`" :alt="property.title"
                                         class="w-full h-96 object-cover rounded-lg shadow-md" />
                                </div>
                                <div class="grid grid-cols-2 gap-4 md:col-span-1">
                                    <img v-for="(image, index) in property.images.slice(1, 5)" :key="image.id"
                                         :src="`/storage/${image.path}`" :alt="property.title"
                                         class="w-full h-48 object-cover rounded-lg shadow-md" />
                                </div>
                            </div>
                            <div v-else class="w-full h-96 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-500 dark:text-gray-400">
                                No Images Available
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-4xl font-bold text-gray-800 dark:text-white">{{ property.title }}</h1>
                                    <div class="flex items-center">
                                        <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.962a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.446a1 1 0 00-.364 1.118l1.286 3.962c.3.921-.755 1.688-1.54 1.118l-3.368-2.446a1 1 0 00-1.176 0l-3.368 2.446c-.784.57-1.838-.197-1.54-1.118l1.286-3.962a1 1 0 00-.364-1.118L2.051 9.389c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                        </svg>
                                        <span class="ml-1 text-gray-800 dark:text-white font-bold text-xl">{{ (property.reviews_avg_rating || 0).toFixed(1) }}</span>
                                        <span class="text-gray-500 dark:text-gray-400 ml-2">({{ property.reviews.length }} reviews)</span>
                                    </div>
                                </div>
                                <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">{{ property.city }} - {{ property.address }}</p>

                                <div class="mt-6">
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">Description</h3>
                                    <p class="text-gray-700 dark:text-gray-300 mt-2">{{ property.description }}</p>
                                </div>

                                <div class="mt-8">
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">Reviews</h3>
                                    <div v-if="property.reviews && property.reviews.length > 0" class="mt-4 space-y-6">
                                        <div v-for="review in property.reviews" :key="review.id" class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                            <div class="flex items-center mb-2">
                                                <div class="font-bold text-gray-800 dark:text-white">{{ review.user.name }}</div>
                                                <div class="ml-auto flex items-center">
                                                    <svg class="h-4 w-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.962a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.446a1 1 0 00-.364 1.118l1.286 3.962c.3.921-.755 1.688-1.54 1.118l-3.368-2.446a1 1 0 00-1.176 0l-3.368 2.446c-.784.57-1.838-.197-1.54-1.118l1.286-3.962a1 1 0 00-.364-1.118L2.051 9.389c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                                    </svg>
                                                    <span class="ml-1 text-gray-800 dark:text-white">{{ review.rating }}</span>
                                                </div>
                                            </div>
                                            <p class="text-gray-700 dark:text-gray-300">{{ review.comment }}</p>
                                        </div>
                                    </div>
                                    <div v-else class="mt-4 text-gray-500 dark:text-gray-400">
                                        No reviews yet. Be the first to review this property!
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-1">
                                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md">
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Book Your Stay</h3>
                                    <div class="text-3xl font-bold text-gray-800 dark:text-white mb-6">€{{ property.price_per_night }} <span class="text-lg font-normal">/ night</span></div>
                                    <DateRangeCalendar :property-id="property.id" @reserved="onReserved" />
                                </div>
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

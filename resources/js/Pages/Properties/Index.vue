<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Properties
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Properties</h1>
                            <a href="/properties/create" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                                New Property
                            </a>
                        </div>

                        <div v-if="properties.data.length === 0" class="text-gray-500 dark:text-gray-400">
                            No properties found.
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <div v-for="prop in properties.data" :key="prop.id"
                                 class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                <a :href="`/properties/${prop.id}`" class="block">
                                    <img :src="prop.images.length > 0 ? `/storage/${prop.images[0].path}` : 'https://via.placeholder.com/300'"
                                         :alt="prop.title"
                                         class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h2 class="font-bold text-xl text-gray-800 dark:text-white mb-2">{{ prop.title }}</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ prop.city }} — {{ prop.address }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 h-12 overflow-hidden">{{ prop.description }}</p>
                                        <div class="flex items-center justify-between">
                                            <div class="font-bold text-lg text-gray-800 dark:text-white">€{{ prop.price_per_night }}
                                                <span class="text-sm font-normal">/ night</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.962a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.446a1 1 0 00-.364 1.118l1.286 3.962c.3.921-.755 1.688-1.54 1.118l-3.368-2.446a1 1 0 00-1.176 0l-3.368 2.446c-.784.57-1.838-.197-1.54-1.118l1.286-3.962a1 1 0 00-.364-1.118L2.051 9.389c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                                </svg>
                                                <span class="ml-1 text-gray-800 dark:text-white font-bold">{{ (prop.reviews_avg_rating || 0).toFixed(1) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="mt-8">
                            <nav v-if="properties.links.length > 3" class="flex justify-center">
                                <template v-for="(link, key) in properties.links" :key="key">
                                    <a v-if="link.url"
                                       :href="link.url"
                                       class="px-4 py-2 mx-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700"
                                       :class="{ 'bg-blue-500 text-white dark:bg-blue-600 dark:text-white': link.active }"
                                       v-html="link.label"
                                    />
                                    <span v-else
                                          class="px-4 py-2 mx-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                          v-html="link.label"
                                    />
                                </template>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
  props: {
    properties: Object,
  },
  components: { AppLayout },
}
</script>

<style scoped>
</style>

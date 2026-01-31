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

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div v-for="prop in properties.data" :key="prop.id" class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-4">
                                <h2 class="font-bold text-lg text-gray-800 dark:text-white">{{ prop.title }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ prop.city }} — {{ prop.address }}</p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ prop.description }}</p>
                                <div class="mt-3 flex items-center justify-between">
                                    <div class="font-medium text-gray-800 dark:text-white">€{{ prop.price_per_night }} / night</div>
                                    <a :href="`/properties/${prop.id}`" class="text-sm text-blue-500 dark:text-blue-400 underline">View</a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <nav v-if="properties.links">
                                <span v-for="link in properties.links" :key="link.label" class="mx-1 text-sm" v-html="link.label"></span>
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

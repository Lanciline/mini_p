<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Mes réservations</h1>

      <ul>
        <li v-for="r in reservations" :key="r.id" class="mb-3 border p-3 bg-white rounded">
          <div class="flex justify-between">
            <div>
              <div class="font-semibold">{{ r.property.title }}</div>
              <div class="text-sm text-gray-600">{{ r.start_date }} → {{ r.end_date }}</div>
            </div>
            <div>
              <a :href="`/my/reservations/${r.id}`" class="text-blue-600">Voir</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </Layout>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/AppLayout.vue'

const { props } = usePage()
const reservations = props.value.reservations || []
</script>

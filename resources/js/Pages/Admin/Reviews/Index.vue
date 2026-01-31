<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Modération des avis</h1>

      <div v-if="reviews.length">
        <div v-for="rev in reviews" :key="rev.id" class="mb-3 p-3 bg-white rounded border">
          <div class="font-semibold">{{ rev.user.name }} — {{ rev.rating }}★</div>
          <div class="text-sm text-gray-700">{{ rev.comment }}</div>
          <div class="mt-2">
            <form :action="`/admin/reviews/${rev.id}/approve`" method="POST" class="inline">
              <button class="px-3 py-1 bg-green-600 text-white rounded">Approuver</button>
            </form>
            <form :action="`/admin/reviews/${rev.id}/reject`" method="POST" class="inline ml-2">
              <button class="px-3 py-1 bg-red-600 text-white rounded">Rejeter</button>
            </form>
          </div>
        </div>
      </div>
      <div v-else class="text-gray-600">Aucun avis en attente.</div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '@/Layouts/AppLayout.vue'
import { usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()
const reviews = props.value.reviews || []
</script>

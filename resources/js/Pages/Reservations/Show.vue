<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-4">
      <h1 class="text-2xl font-bold">Réservation pour {{ reservation.property.title }}</h1>
      <div class="mt-4 bg-white p-4 rounded">
        <div><strong>Période:</strong> {{ reservation.start_date }} → {{ reservation.end_date }}</div>
        <div><strong>Statut:</strong> {{ reservation.status }} / {{ reservation.payment_status }}</div>
        <div><strong>Total:</strong> {{ reservation.total_amount }} €</div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/AppLayout.vue'

const { props } = usePage()
const reservation = props.value.reservation
</script>

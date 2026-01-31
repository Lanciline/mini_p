<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-4">
      <h1 class="text-2xl font-bold">{{ property.title }}</h1>
      <p class="text-gray-600">{{ property.city }} - {{ property.address }}</p>

      <div class="mt-6">
        <DateRangeCalendar :property-id="property.id" @reserved="onReserved" />
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

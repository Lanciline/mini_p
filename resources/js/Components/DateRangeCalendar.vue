<template>
    <div class="p-4 border rounded bg-white dark:bg-gray-700">
        <h2 class="font-semibold mb-2 text-gray-800 dark:text-white">Sélectionner une période</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label class="block text-sm text-gray-600 dark:text-gray-400">Début</label>
                <input type="date" v-model="start" :min="today" @change="validateRange" class="mt-1 p-2 border rounded w-full dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>

            <div>
                <label class="block text-sm text-gray-600 dark:text-gray-400">Fin</label>
                <input type="date" v-model="end" :min="start || today" @change="validateRange" class="mt-1 p-2 border rounded w-full dark:bg-gray-600 dark:border-gray-500 dark:text-white" />
            </div>
        </div>

        <div class="mt-3 text-sm text-red-600 dark:text-red-400" v-if="error">{{ error }}</div>

        <div class="mt-4">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700" @click="reserve" :disabled="!canReserve">Réserver</button>
        </div>

        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            Dates bloquées:
            <ul class="list-disc ml-5">
                <li v-for="(r, i) in blocked" :key="i">{{ r.start }} → {{ r.end }}</li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const props = defineProps({ propertyId: { type: [Number,String], required: true } })
const emit = defineEmits(['reserved'])

const start = ref('')
const end = ref('')
const blocked = ref([])
const error = ref(null)

const today = new Date().toISOString().slice(0,10)

const canReserve = computed(() => start.value && end.value && !error.value)

onMounted(async () => {
  const res = await axios.get(`/api/properties/${props.propertyId}/availability`)
  blocked.value = res.data.blocked || []
})

function overlaps(rangeStart, rangeEnd) {
  const s = new Date(rangeStart)
  const e = new Date(rangeEnd)

  return blocked.value.some(b => {
    const bs = new Date(b.start)
    const be = new Date(b.end)
    return s <= be && e >= bs
  })
}

function validateRange() {
  error.value = null
  if (!start.value || !end.value) return
  if (new Date(end.value) < new Date(start.value)) {
    error.value = 'La date de fin doit être après la date de début.'
    return
  }
  if (overlaps(start.value, end.value)) {
    error.value = 'La période chevauche des réservations existantes.'
    return
  }
}

function reserve() {
  validateRange()
  if (error.value) return
  emit('reserved', { start_date: start.value, end_date: end.value })
}
</script>


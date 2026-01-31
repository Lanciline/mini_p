<template>
  <AppLayout>
    <div>
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Properties</h1>
        <Button variant="default">New Property</Button>
      </div>

      <div v-if="properties.data.length === 0" class="text-muted-foreground">No properties found.</div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <Card v-for="prop in properties.data" :key="prop.id">
          <h2 class="font-bold text-lg">{{ prop.title }}</h2>
          <p class="text-sm text-muted-foreground">{{ prop.city }} — {{ prop.address }}</p>
          <p class="mt-2 text-sm text-foreground">{{ prop.description }}</p>
          <div class="mt-3 flex items-center justify-between">
            <div class="font-medium">€{{ prop.price_per_night }} / night</div>
            <a :href="`/properties/${prop.id}`" class="text-sm text-primary underline">View</a>
          </div>
        </Card>
      </div>

      <div class="mt-6">
        <nav v-if="properties.links">
          <span v-for="link in properties.links" :key="link.label" class="mx-1 text-sm" v-html="link.label"></span>
        </nav>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from '@/Components/Button.vue';
import Card from '@/Components/Card.vue';

export default {
  props: {
    properties: Object,
  },
  components: { AppLayout, Button, Card },
}
</script>

<style scoped>
</style>

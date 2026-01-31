<template>
  <div class="min-h-screen bg-background text-foreground">
    <NavBar />
    <main class="max-w-7xl mx-auto px-4 py-8">
      <slot />
    </main>
    <footer class="border-t border-border mt-12">
      <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-muted-foreground">© {{ new Date().getFullYear() }} MiniStay</div>
    </footer>
  </div>
</template>

<script>
import NavBar from '@/Components/NavBar.vue';
export default {
  components: { NavBar },
  name: 'AppLayout',
}
</script>

<style scoped>
</style>

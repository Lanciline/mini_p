<template>
  <header class="bg-background border-b border-border">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center space-x-3">
        <a href="/" class="text-lg font-semibold text-foreground">MiniStay</a>
        <nav class="hidden md:flex space-x-2 text-sm text-muted-foreground">
          <a href="/properties" class="px-2 py-1 rounded hover:bg-muted">Properties</a>
          <a href="/my/reservations" class="px-2 py-1 rounded hover:bg-muted">Reservations</a>
        </nav>
      </div>
      <div class="flex items-center space-x-3">
        <a href="/login" class="text-sm text-foreground/80">Log in</a>
        <a href="/register" class="inline-flex items-center px-3 py-1.5 bg-primary text-primary-foreground rounded-md text-sm">Sign up</a>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'NavBar',
}
</script>

<style scoped>
</style>

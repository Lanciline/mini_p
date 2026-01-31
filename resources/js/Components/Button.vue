<template>
  <button :class="classes" v-on="$listeners"><slot /></button>
</template>

<script>
export default {
  name: 'Button',
  props: {
    variant: { type: String, default: 'default' },
    size: { type: String, default: 'md' },
  },
  computed: {
    classes() {
      const base = 'inline-flex items-center justify-center rounded-md font-medium transition-colors';
      const sizes = {
        sm: 'px-2.5 py-1.5 text-sm',
        md: 'px-3 py-2 text-sm',
      };
      const variants = {
        default: 'bg-primary text-primary-foreground',
        ghost: 'bg-transparent text-foreground',
        destructive: 'bg-destructive text-destructive-foreground',
      };
      return [base, sizes[this.size] || sizes.md, variants[this.variant] || variants.default].join(' ');
    }
  }
}
</script>

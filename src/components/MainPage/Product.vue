<template>
  <v-col cols="4">
    <v-card>
      <v-card-title>{{ product.title }}</v-card-title>
    </v-card>
  </v-col>
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
      required: false
    }
  }
}
</script>

<style scoped>

</style>
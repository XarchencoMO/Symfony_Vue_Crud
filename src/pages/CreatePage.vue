<template>
  <ProductForm @addProduct="addProduct"/>
</template>

<script>
import ProductForm from "@/components/CreatePage/ProductForm";

export default {
  components: {
    ProductForm
  },
  addProduct(product) {
    this.products.push(product)
  }
}
</script>

<style scoped>

</style>
<template>
  <div class="inputBox">
    <input
      v-bind:id="inputItemData.id"
      v-bind:type="inputItemData.type"
      value=""
      required
    />
    <label>{{ inputItemData.label }}</label>
  </div>
</template>
<script>
export default {
  props: ["inputItemData"],
};
</script>

<style scoped>
.inputBox {
  position: relative;
}
.inputBox input {
  width: 100%;
  padding: 0.625rem 0;
  font-size: 1rem;
  color: #fff;
  letter-spacing: 0.062rem;
  margin-bottom: 1.875rem;
  border: none;
  border-bottom: 0.065rem solid #fff;
  outline: none;
  background: transparent;
}
.inputBox label {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.625rem 0;
  font-size: 0.8rem;
  color: #fff;
  pointer-events: none;
  transition: 0.5s;
}
.inputBox input:focus ~ label,
.inputBox input:valid ~ label,
.inputBox input:not([value=""]) ~ label {
  top: -1.125rem;
  left: 0;
  color: #03a9f4;
  font-size: 0.65rem;
}

</style>
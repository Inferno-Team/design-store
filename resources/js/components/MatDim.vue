<template>
  <div class="dim_mat">
    <b-form-group
      style="width: 50%; display: inline-block; max-width: fit-content"
      id="input-group-1"
      label="المادة"
      label-for="input-1"
    >
      <b-form-select id="input-1" :options="materials" required></b-form-select>
    </b-form-group>
    <b-form-group
      style="width: 50%; display: inline-block; max-width: fit-content"
      id="input-group-2"
      label="الابعاد"
      label-for="input-2"
    >
      <b-form-select
        id="input-2"
        style="direction: ltr"
        :options="dimensions"
        required
      ></b-form-select>
    </b-form-group>
  </div>
</template>
<script>
export default {
  props: ["dimensions", "materials"],
};
</script>
<template>
  <div class="card" style="width: 12rem; margin: 0.75rem">
    <img class="card-img-top" :src="design.img_url" alt="Card image cap" />
    <div class="card-body" :class="{ show_body: this.visable }">
      <h6>اسم التصميم :</h6>
      <p class="card-text">{{ design.name }}</p>
      <font-awesome-icon
        v-if="!this.visable"
        @click.prevent="show_more"
        icon="fa-solid fa-circle-plus"
        size="3x"
        style="position: absolute; left: 40%; bottom: -20px"
      />
      <font-awesome-icon
        v-if="this.visable"
        @click.prevent="show_more"
        icon="fa-solid fa-circle-minus"
        size="3x"
        style="position: absolute; left: 40%; bottom: -20px"
      />
    
      <div :class="{ show: this.visable }" class="d-content">
        <div v-for="(d, index) in design.design_dms" :key="index">
          <h6>اسم الابعاد :</h6>
          <p class="card-text">{{ d.d_m.name }}</p>
          <h6>السعر :</h6>
          <p class="card-text">{{ d.price }}</p>
          <h6>اسم المادة :</h6>
          <p class="card-text">{{ d.d_m.mat.name }}</p>
          <h6 class="card-text">الابعاد</h6>
          <p class="card-text dim" style="direction: ltr">
            <!-- d.d_m.dim.width -->
            {{ d.d_m.dim.width }} سم x {{ d.d_m.dim.height }} سم x
            {{ d.d_m.dim.thickness }} سم
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["design"],
  data() {
    return {
      visable: false,
    };
  },
  methods: {
    show_more() {
      this.visable = !this.visable;
    },
  },
};
</script>
<style scoped>
.dim {
  font-size: 0.75rem;
  text-align: center;
}
.d-content {
  border: 1px dashed #ddd;
  margin: 0.4rem;
  padding: 1rem 0;
  transition: 0.5s;
  /* transform: translateY(200%); */
  opacity: 0;
  visibility: hidden;
}
.card-body {
  max-height: 8rem;
  transition: max-height 1s ease-out;
  transition: 1s;
}
.show_body {
  max-height: fit-content;
  transition: max-height 1s ease-in;
}
.show {
  opacity: 1;
  visibility: visible;
}
</style>
 
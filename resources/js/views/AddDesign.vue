<template>
  <div class="add-desgin-container">
    <div class="control-container">
      <InputDesign @onAdd="onAddPressed" />
    </div>
    <div class="desgin-container">
      <Design v-for="(design, i) in desgins" :key="i" :design="design" />
    </div>
  </div>
</template>

<script>
import Design from "../components/Design.vue";
import InputDesign from "../components/InputDesign.vue";

export default {
  components: { Design, InputDesign },
  data() {
    return {
      desgins: [],
    };
  },
  mounted() {
    this.loadDesign();
  },

  methods: {
    onAddPressed(desgin) {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      let formData = new FormData();
      formData.append("image", desgin.image);
      formData.append("name", desgin.name);
      for (var i = 0; i < desgin.matDim.length; i++) {
        formData.append("matDim[]", desgin.matDim[i]);
      }
      formData.append("price", desgin.price);
      axios
        .post("/design/add_design", formData, config)
        .then((response) => this.desgins.unshift(response.data.desgin))
        .catch((error) => console.log(error));
    },
    loadDesign() {
      axios
        .get("/design/get_designes")
        .then((res) => (this.desgins = res.data))
        .catch((err) => console.log(err.data));
    },
  },
};
</script>

<style  scoped>
.control-container {
  width: 25%;
  height: 100%;
}

.add-desgin-container {
  display: flex;
  background: linear-gradient(45deg, #0000dd, #0dfdfe);
  max-height: 100%;
  height: 100%;
}

.desgin-container {
  display: flex;
  justify-content: space-around;
  width: 70%;
  flex-wrap: wrap;
  align-content: flex-start;
}
</style>
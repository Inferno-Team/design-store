<template>
  <div
    class="card"
    style="width: 18rem; margin: 0.75rem; height: auto; background: transparent"
  >
    <DropZone class="card-img-top" @onDrop="onDrop" />
    <div class="box" id="login-form">
      <h2>إضافة تصميم جديد</h2>
      <form @click.prevent>
        <InputItem
          v-for="(item, index) in inputItems"
          :key="index"
          :inputItemData="item"
        />
        <input
          style="margin-top: 0; padding: 0 0.3rem"
          type="button"
          @click.prevent="onAddDimMat"
          name="sign-in"
          value="+"
        />
        <div v-if="this.dimMatIndex > 0">
          <MatDim
            v-for="(_, index) in dimMatIndex"
            :key="index"
            :materials="materials"
            :dimensions="dimensions"
          />
        </div>
        <input
          style="margin-top: 1rem"
          type="button"
          @click.prevent="onAddDesign"
          name="sign-in"
          value="اضافة"
        />
      </form>
    </div>
  </div>
</template>
<script>
import InputItem from "../components/InputItem.vue";
import DropZone from "../components/DropZone.vue";
import MatDim from "../components/MatDim.vue";
export default {
  components: { InputItem, DropZone, MatDim },
  mounted() {
    this.loadMaterials();
    this.loadDimensions();
  },
  data() {
    return {
      enteredDesign: {
        name: "",
        price: 0,
        image: {},
        matDim: [],
      },

      dimMatIndex: 1,
      inputItems: [
        {
          label: "اسم التصميم",
          id: "design_name",
          type: "text",
        },
        {
          label: "سعر التصميم",
          id: "design_price",
          type: "number",
        },
      ],
      materials: [],
      dimensions: [],
    };
  },
  methods: {
    onAddDesign(event) {
      let nameInput = document.getElementById(`${this.inputItems[0].id}`);
      let priceInput = document.getElementById(`${this.inputItems[1].id}`);
      let dimMatArray = document.getElementsByClassName("dim_mat");
      for (let index = 0; index < 1; index++) {
        const element = dimMatArray[index];
        let _mat = element.children[0].children[1].children[0].value;
        let _dim = element.children[1].children[1].children[0].value;
        this.enteredDesign.matDim.push({
          mat: _mat,
          dim: _dim,
        });
      }
      this.enteredDesign.name = nameInput.value;
      this.enteredDesign.price = priceInput.value;
      this.$emit("onAdd", this.enteredDesign);
    },
    loadMaterials() {
      axios
        .get("/design/get_materials")
        .then((res) => {
          res.data.forEach((mat) => {
            this.materials.push(mat.name);
          });
        })
        .catch((err) => console.log(err));
    },
    loadDimensions() {
      axios
        .get("/design/get_dimensions")
        .then((res) => {
          res.data.forEach((dim) => {
            this.dimensions.push(
              `${dim.width} x ${dim.height} x ${dim.thickness}`
            );
          });
        })
        .catch((err) => console.log(err));
    },
    onAddDimMat() {
      this.dimMatIndex = this.dimMatIndex + 1;
    },
    onDrop(files) {
      this.enteredDesign.image = files[0];
    },
  },
};
</script>
<style scoped>
.box {
  width: 16rem;
  height: 21rem;
  visibility: visible;
  margin: 1rem auto;
  padding: 0.5rem;
  background: rgba(0, 0, 0, 0.6);
  border-radius: 0.625rem;
}

.box h2 {
  margin: 0 0 1.875rem;
  padding: 0;
  color: #fff;
  text-align: center;
  font-size: 1rem;
}

.box .inputBox {
  position: relative;
}

.box .inputBox input {
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

.box .inputBox label {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0.625rem 0;
  font-size: 0.8rem;
  color: #fff;
  pointer-events: none;
  transition: 0.5s;
}

.box .inputBox input:focus ~ label,
.box .inputBox input:valid ~ label,
.box .inputBox input:not([value=""]) ~ label {
  top: -1.125rem;
  left: 0;
  color: #03a9f4;
  font-size: 0.65rem;
}

.box input[type="button"] {
  border: none;
  outline: none;
  color: #fff;
  background-color: #03a9f4;
  padding: 0.625rem 1.25rem;
  cursor: pointer;
  border-radius: 0.312rem;
  font-size: 1rem;
}

.box input[type="button"]:hover {
  background-color: #1cb1f5;
}
</style>
<template>
  <div class="container">
    <CardElement
      v-for="(_, index) in 3"
      :data="op_data[index]"
      :key="index"
      :index="index"
      @event="move"
    />
  </div>
</template>
<script>
import CardElement from "../components/CardElement.vue";
export default {
  components: { CardElement },
  mounted() {
    const token = localStorage.getItem("design-store-token");
    if (token !== undefined && token !== null && token !== "undefined")
      this.getUser();
    else this.$router.push({ name: "login" });
  },
  data() {
    return {
      user: {},
      op_data: [
        {
          title: "إضافة تصميم",
          desc: "إضافة تصميم الى قاعدة بيانات مع صورة للتصميم",
          path: "add-design",
        },
        {
          title: "عرض طلبات زباين",
          desc: "الاستجابة لطلب الزباين مع عرض كافة الطلبات",
          path: "show-requests",
        },
        {
          title: "تسجيل خروج",
          desc: "تسجيل خروج وحذف بيانات الحساب من الجهاز",
          path: "logout",
        },
      ],
    };
  },
  methods: {
    getUser() {
      axios.post("/api/user").then((res) => {
        this.user = res.data;
      });
    },
    move(event) {
      const _index = event.target.id;
      if (_index == 2) {
        localStorage.removeItem("design-store-token");
        this.$router.push({ name: "login" });
        return;
      }
      console.log(this.$route.path);
      let name = this.op_data[_index].path;
      this.$router.push({ name: name }).catch((e) => console.log(e));
    },
  },
};
</script>
<style scoped>
.container {
  background: linear-gradient(45deg, #0000dd, #0dfdfe);
  height: 100% !important;
  max-width: 100% !important;
}
.container {
  /* position: relative;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  z-index: 1;
   */
  display: grid;
  grid-template-columns: repeat(2, minmax(92px, 0.5fr));
  justify-items: center;
  gap: 10px;
}
</style>
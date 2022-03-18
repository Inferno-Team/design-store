<template>
  <div
    id="dropZone"
    class="card-img-top"
    style="
      background: rgb(255, 255, 255);
      border-radius: 6px;
      margin: 1rem;
      width: 90%;
    "
  >
    <h4 id="text" style="margin: 0.6rem">اسحب وافلت الملف هنا</h4>
    <input id="file-input" type="file" name="name" style="display: none" />
    <img
      src="/images/upload_image.png"
      style="width: 128px; height: 96px; margin: 1rem 20%; cursor: pointer"
      id="image"
      @click.prevent="onChooseFile"
    />
  </div>
</template>
<script>
export default {
  mounted() {
    this.onDrop();
    this.onFile();
  },
  data() {
    return {
      outputFiles: [],
    };
  },
  methods: {
    chooseFile(files) {
      for (var i = 0, file; (file = files[i]); i++) {
        if (file.type.match(/image.*/)) {
          var reader = new FileReader();
          reader.readAsDataURL(file);
          this.outputFiles.push(file);
          reader.onload = (e2) => {
            var img = e2.target.result;
            let image = document.getElementById("image");
            image.src = img;
            image.style.width = "100%";
            image.style.height = "50%";
            image.style.margin = "";
            document.getElementById("text").innerText = "الملف جاهز للرفع";
          };
          this.$emit("onDrop", this.outputFiles);
        }
      }
    },
    onDrop() {
      var dropZone = document.getElementById("dropZone");
      dropZone.addEventListener("dragover", function (e) {
        e.stopPropagation();
        e.preventDefault();
        e.dataTransfer.dropEffect = "copy";
      });
      dropZone.addEventListener("drop", (e) => {
        e.stopPropagation();
        e.preventDefault();
        var files = e.dataTransfer.files;
        this.chooseFile(files);
      });
    },
    onChooseFile(event) {
      document.getElementById("file-input").click();
    },
    onFile() {
      document.getElementById("file-input").onchange = () => {
        let files = document.getElementById("file-input").files;
        this.chooseFile(files);
      };
    },
  },
};
</script>
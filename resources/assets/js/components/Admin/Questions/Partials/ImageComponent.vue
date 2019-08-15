<template>
  <div class="container">
    <div class="row mb-3">
      <div>
        <img :src="image.preview" style="width:300px;height:300px;" v-if="image.preview">
      </div>

      <div class="col-12 col-md-9">
        <input type="file" class="form-control" v-on:change="onFileInput($event)"/>
      </div>
      
      <div class="col-12 col-md-2">
        <div class="btn btn-primary btn-info" @click="onDeleteClick()">Delete</div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultImage', 'defaultIndex'],
    data: function(){
      return {
        image: {}
      };
    },
    watch: {
      defaultAnswers: function() {
        this.setDefault();
      }
    },
    mounted() {
      this.setDefault();
    },
    methods: {  
      setDefault: function() {
        if(!this.defaultImage) {
          return;
        }
        this.image = this.defaultImage;
      },
      onDeleteClick: function(){
        
      },
      onFileInput: function(e) {
        if(!e.target.files[0]) {
          this.image.file = '';
          return;
        }
        
        this.image.identifier = Math.floor(Date.now() / 1000);
        this.image.file = e.target.files[0];
        this.image.preview = URL.createObjectURL(e.target.files[0]);

        if(this.image.hasOldImage) {
          this.image.hasOldImage = false;
        }
      }
    }
  }
</script>
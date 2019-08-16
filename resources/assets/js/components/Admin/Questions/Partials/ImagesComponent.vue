<template>
  <div class="form-group has-label">
    <label>Images</label> 

    <div class="container">
      <div class="row mb-3" v-for="(image, index) in images" :key="index" v-if="!image.deleted">
        <div>
          <img :src="image.preview" style="width:300px;height:300px;" v-if="image.preview">
        </div>

        <div class="col-12 col-md-9">
          <input type="file" class="form-control" v-on:change="onFileInput($event, image)"/>
        </div>
        
        <div class="col-12 col-md-2">
          <div class="btn btn-primary btn-info" @click="onDeleteClick(index)">Delete</div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-2">
          <div class="btn btn-primary btn-info" @click="onAddClick()">Add New Image</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultImages'],
    data: function(){
      return {
        images: []
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
        if(!this.defaultImages) {
          return;
        }
        this.images = this.defaultImages;
      },
      onAddClick: function(){
        this.images.push({
          preview: '',
          file: ''
        });
      },
      onDeleteClick: function(index){
        if(this.images[index].id) {
          Vue.set(this.images[index], 'deleted', true); 
        }else {
          this.images.splice(index, 1);
        }
      },
      onFileInput: function(e, image) {
        if(!e.target.files[0]) {
          image.file = '';
          return;
        }
        
        image.file = e.target.files[0];
        image.preview = URL.createObjectURL(e.target.files[0]);
      }
    }
  }
</script>
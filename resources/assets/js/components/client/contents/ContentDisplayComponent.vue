<template>
  <div>
    <div v-for="(content, index) in contents" :key="index">
      <img class="img-fluid" :src="content.item.preview" v-if="content.type == 'Image'">

      <table-display-component :default-item="content.item" v-if="content.type == 'Table'"></table-display-component>

      <paragraph-display-component :default-item="content.item" :index=index v-if="content.type == 'Paragraph'"></paragraph-display-component>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultContents'],
    data: function(){
      return {
        contents: []
      };
    },
    watch: {
      defaultContents: function() {
        this.setDefault();
      }
    },
    mounted() {
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        if(!this.defaultContents) {
          return;
        }
        this.contents = this.defaultContents;
        this.parseContent();
      },
      parseContent: function() {
        var self = this;
        if(this.contents.length > 0) {
          this.contents.forEach((content, index) => {
            if(content.type == 'Table' || content.type == 'Paragraph') {
              content.item = JSON.parse(content.item);
            }
          });
        }
      }
    }
  }
</script>
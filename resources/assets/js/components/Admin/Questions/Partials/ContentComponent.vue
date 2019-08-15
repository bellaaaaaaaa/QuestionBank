<template>
  <div class="form-group has-label">
    <label>Contents</label> 

    <div v-for="(content, index) in contents" :key="index">
      <table-component :default-table="content.item" :default-index="index" ref="tableChild" v-if="content.type == 'Table'"></table-component>

      <image-component :default-image="content.item" :default-index="index" ref="imageChild" v-if="content.type == 'Image'"></image-component>
    </div>

    <div class="dropdown">
      <button class="btn btn-secondary btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Add Content
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click="onNewTable()">Add New Table</a>
        <a class="dropdown-item" @click="onNewImage()">Add New Image</a>
        <a class="dropdown-item" href="#">Add New Paragraph</a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultQuestion'],
    data: function(){
      return {
        question: {},
        contents: []
      };
    },
    watch: {
      defaultQuestion: function() {
        this.setDefault();
      }
    },
    mounted() {
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        if(!this.defaultQuestion) {
          return;
        }
        this.question = this.defaultQuestion;
        this.contents = this.question.contents ? this.question.contents : [];
      },
      onNewTable: function() {
        this.contents.push({
          type: 'Table',
          item: {
            headings: [
              {
                content: 'Heading 1',
                colspan: 1
              },
              {
                content: 'Heading 2',
                colspan: 1
              }
            ],
            rows: [
              {
                cols: [
                  {
                    content: 'New Content'
                  },
                  {
                    content: 'New Content'
                  }
                ]
              }
            ]
          }
        });
      },
      onNewImage: function() {
        this.contents.push({
          type: 'Image',
          item: {
            identifier: null, // for testing
            file: null,
            preview: null
          }
        });
      }
    }
  }
</script>
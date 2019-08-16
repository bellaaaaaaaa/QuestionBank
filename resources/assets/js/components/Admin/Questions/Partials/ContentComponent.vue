<template>
  <div class="form-group has-label">
    <label>Contents</label> 

    <draggable v-model="contents" group="contents" handle=".handle">
      <div v-for="(content, index) in contents" :key="index">
        <div class="card p-3">
          <i class="fa fa-align-justify handle"></i>
          <table-component :default-item="content.item" :default-index="index" @delete="onDelete" v-if="content.type == 'Table' && !content.deleted"></table-component>

          <image-component :default-item="content.item" :default-index="index" @delete="onDelete" v-if="content.type == 'Image' && !content.deleted"></image-component>

          <paragraph-component :default-item="content.item" :default-index="index" @delete="onDelete" @change="onChange" v-if="content.type == 'Paragraph' && !content.deleted"></paragraph-component>
        </div>
      </div>
    </draggable>

    <div class="dropdown">
      <button class="btn btn-secondary btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Add Content
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click="onNewTable()">Add New Table</a>
        <a class="dropdown-item" @click="onNewImage()">Add New Image</a>
        <a class="dropdown-item" @click="onNewParagraph()">Add New Paragraph</a>
      </div>
    </div>
  </div>
</template>

<script>
  import draggable from 'vuedraggable';

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
            identifier: null, 
            file: null,
            preview: null
          }
        });
      },
      onNewParagraph: function() {
        this.contents.push({
          type: 'Paragraph',
          item: ''
        })
      },
      onDelete: function(index) {
        var content = this.contents[index];

        if(content.id) {
          Vue.set(this.contents[index], 'deleted', true);
        }else {
          this.contents.splice(index, 1);
        }
      },
      onChange: function(index, value) {
        this.contents[index].item = value;
      }
    }
  }
</script>
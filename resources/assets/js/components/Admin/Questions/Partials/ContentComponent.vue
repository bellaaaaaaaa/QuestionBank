<template>
  <div class="form-group has-label">
    <label>Contents</label> 

    <div v-for="(content, index) in contents" :key="index">
      <table-component :default-table="content.table" ref="tableChild" v-if="content.type == 'table'"></table-component>

      <images-component :default-image="content.image" ref="imageChild" v-if="content.type == 'image'"></images-component>
    </div>

    <div class="dropdown">
      <button class="btn btn-secondary btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Add Content
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click="onNewTable()">Add New Table</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
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
        this.question = this.defaultQuestion;
      },
      onNewTable: function() {
        this.contents.push({
          type: 'table',
          table: {
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
      }
    }
  }
</script>
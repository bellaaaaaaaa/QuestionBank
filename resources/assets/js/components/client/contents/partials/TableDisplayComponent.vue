<template>
  <div>
    <table align="center" class="table-striped">
      <tr>
        <td :colspan="heading.colspan" v-for="(heading, headingIndex) in item.headings" :key="headingIndex">
          {{ heading.content }}
        </td>  
      </tr>
      <tr v-for="(row, rowIndex) in item.rows" :key="rowIndex">
        <td v-for="(col, colIndex) in row.cols" :key="colIndex">
          {{ col.content }}
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
  export default {
    props: ['defaultItem'],
    data: function(){
      return {
        item: []
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
        if(!this.defaultItem) {
          return;
        }
        this.item = this.defaultItem;
      }
    }
  }
</script>
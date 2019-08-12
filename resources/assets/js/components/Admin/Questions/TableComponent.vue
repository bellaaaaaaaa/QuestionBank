<template>
  <div class="page-container m-3 m-sm-5">
    
    <div v-for="(table, tableIndex) in tables" :key="tableIndex">
      <div class="btn btn-primary btn-info" @click="onNewHeading(table.content)">Add Heading</div>
      <div class="btn btn-primary btn-info" @click="onNewRow(table.content)">Add Row</div>
      <div class="btn btn-primary btn-info" @click="onNewColumn(table.content)">Add Column</div>
      
      <table class="table table-bordered" >
        <thead>
          <tr>
            <td colspan="1"></td>
            <td :colspan="heading.colspan" v-for="(heading, headingIndex) in table.content.headings" :key="headingIndex">
              <input type="text" class="form-control" name="headings" v-model="heading.content">

              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table.content, headingIndex, 'headings')"></i>
              <i class="fa fa-unlink" aria-hidden="true" @click="onLinkHeading(table.content, heading, -1)"></i>
              <i class="fa fa-link" aria-hidden="true" @click="onLinkHeading(table.content, heading, 1)"></i>
            </td>
          </tr>
        </thead>

        <tbody>
          <tr v-for="(row, rowIndex) in table.content.rows" :key="rowIndex">
            <td>
              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table.content, rowIndex, 'rows')"></i>
            </td>

            <td v-for="(col, colIndex) in row.cols" :key="colIndex">
              <textarea class="form-control" rows="4" cols="20" name="headings" v-model="col.content"></textarea>

              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table.content, colIndex, 'cols', rowIndex)"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>  

<script>
  export default{
    props: ['defaultTables'],
    data: function(){
      return {
        tables: []
      };
    },
    watch: {
      defaultTables: function() {
        this.setDefault();
      }
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        if(!this.defaultTables) {
          this.onNewTable();
          return;
        }

        this.tables = _.cloneDeep(this.defaultTables);
        this.tables.forEach((table) => {
          table.content = JSON.parse(table.content)
        });
      },
      onNewTable: function() {
        this.tables.push({
          content: {
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
      onNewHeading: function(table) {
        table.headings.push({
          content: 'New Heading',
          colspan: 1
        });
      },
      onLinkHeading: function(table, heading, value) {
        if(value != 1 && heading.colspan == 1) {
          return;
        }
        heading.colspan += value;
      },
      onNewRow: function(table) {
        table.rows.push({
          cols: []
        });

        var numOfCols = table.rows[0].cols.length;
        var newCol = table.rows[table.rows.length - 1];

        for(var i = 0; i < numOfCols; i++) {
          newCol.cols.push({
            content: 'New Content'
          });
        }
      },
      onNewColumn: function(table) {
        table.rows.forEach((row) => {
          row.cols.push({
            content: 'New Content'
          })
        });
      },
      onRemoveItem: function(table, index, type, rowIndex = null) {
        if(rowIndex != null || rowIndex != undefined) {
          if(table.rows[rowIndex][type].length <= 1) {
            return;
          }
          table.rows[rowIndex][type].splice(index, 1);
          return;
        }

        if(table[type].length <= 1) {
          return;
        }
        table[type].splice(index, 1);
      }
    }
  }
</script>
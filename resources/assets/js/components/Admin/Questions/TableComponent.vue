<template>
  <div class="page-container m-3 m-sm-5">
    
    <div v-for="(table, tableIndex) in tables" :key="tableIndex">
      <div class="btn btn-primary btn-info" @click="onNewHeading(table)">Add Heading</div>
      <div class="btn btn-primary btn-info" @click="onNewRow(table)">Add Row</div>
      <div class="btn btn-primary btn-info" @click="onNewColumn(table)">Add Column</div>
      
      <table class="table table-bordered" >
        <thead>
          <tr>
            <th colspan="1"></th>
            <th :colspan="heading.colspan" v-for="(heading, headingIndex) in table.headings" :key="headingIndex">
              <input type="text" class="form-control" name="headings" v-model="heading.content">

              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table, headingIndex, 'headings')"></i>
              <i class="fa fa-unlink" aria-hidden="true" @click="onLinkHeading(table, heading, -1)"></i>
              <i class="fa fa-link" aria-hidden="true" @click="onLinkHeading(table, heading, 1)"></i>
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="(row, rowIndex) in table.rows" :key="rowIndex">
            <td>
              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table, rowIndex, 'rows')"></i>
            </td>

            <td v-for="(col, colIndex) in row.cols" :key="colIndex">
              <textarea class="form-control" rows="4" cols="20" name="headings" v-model="col.content"></textarea>

              <i class="fa fa-times" aria-hidden="true" @click="onRemoveItem(table, colIndex, 'cols', rowIndex)"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>  

<script>
  export default{
    props: ['defaultTable'],
    data: function(){
      return {
        tables: []
      };
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        if(!this.defaultTable) {
          this.onNewTable();
          return;
        }

        this.tables = JSON.parse(this.defaultTable);
      },
      onNewTable: function() {
        this.tables.push({
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
                  content: 'Col 1'
                },
                {
                  content: 'Col 2'
                },
                {
                  content: 'Col 2'
                }
              ]
            }
          ]
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
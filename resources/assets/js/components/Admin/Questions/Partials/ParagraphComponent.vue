<template>
  <div class="form-group has-label">
    <label>Paragraph</label> 
    <div class="col-12 col-md-2">
      <div class="btn btn-primary btn-info" @click="onDeleteClick()">Delete</div>
    </div>
    <div class="container">
      <div :id="'editor' + defaultIndex" style="height:350px;">
        <input type="hidden" name="content" id="content-input"/>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultItem', 'defaultIndex'],
    data: function(){
      return {
        paragraph: null,
        quill: null
      };
    },
    watch: {
      defaultItem: function(newVal) {
        if(newVal != this.paragraph) {
          this.setDefault();
        }
      }
    },
    mounted() {
      this.quill = new Quill('#editor' + this.defaultIndex, {
        theme: 'snow',
        placeholder: 'Write the contents of your paragraph here....'
      });

      let self = this;
      this.quill.on('text-change', function(delta, olddelta, source) {
        var delta = JSON.stringify(self.quill.getContents());
        self.paragraph = delta;
        self.$emit('change', self.defaultIndex, self.paragraph);
      });

      this.setDefault();
    },
    methods: {  
      setDefault: function() {
        var item = typeof this.defaultItem;

        this.paragraph = this.defaultItem;
        if(item == 'object') {
          this.paragraph = this.defaultItem;
        }else if(item == 'string' && this.defaultItem == '') {
          this.paragraph = this.defaultItem;
        } else {
          this.paragraph = JSON.parse(this.defaultItem);
        }
        this.quill.setContents(this.paragraph);
      },
      onDeleteClick: function(){
        this.$emit('delete', this.defaultIndex);
      },
    }
  }
</script>
<template>
  <div :class="'quill-content' + index"></div>
</template>

<script>
  export default {
    props: ['defaultItem', 'index'],
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
        var contentTag = $('.quill-content' + this.index);
        var delta = this.item;
        var converter = new QuillDeltaToHtmlConverter(delta['ops'], {});
        contentTag.html(converter.convert());
      }
    }
  }
</script>
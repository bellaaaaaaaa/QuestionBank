<template>
  <div class="row" v-if="question.result != undefined">
    <div class="col-sm-12">
      <div class="box row">
        <h2>Explanation</h2>
        <p>{{ question.explanation }}</p>

        <input type="button" name="read_chapter" value="Read Chapter" class="buttons read-btn">
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestion'],
    data: function(){
      return {
        question: {}
      };
    },
    watch: {
      defaultQuestion: function() {
        this.setDefault();
      }
    },
    methods: {
      setDefault: function() {
        this.question = this.defaultQuestion;
      }
    }
  }
</script>
<template>
  <div class="row" v-if="question.result != undefined">
    <div class="col-sm-12">
      <div class="box row">
        <h2>Explanation</h2>
        <div class="col-sm-12">
          <p class="my-2">{{ question.explanation }}</p>
        </div>
        <div class="col-sm-12 d-flex">
          <input type="button" name="read_chapter" value="Read Chapter" class="buttons read-btn">
        </div>

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
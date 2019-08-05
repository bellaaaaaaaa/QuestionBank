<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="box questions">
        <h2>Questions</h2>
        <h3>Question 1 of 7</h3>
        <p><small>Question Chapter : Chapter 2  - <a href="#">Biology Organisms</a></small></p>

        <p>Which one of the following statements is incorrect?</p>
        <ul>
          <li><input type="radio" id="a-option" name="selector">
              <label for="a-option" class="correct">Viviparity is the productive pattern shown by most mammals</label>
              <div class="check"></div>
          </li>
          <li><input type="radio" id="b-option" name="selector">
              <label for="b-option" class="wrong">Viviparity is the productive pattern shown by most mammals</label>
              <div class="check"></div>
          </li>
          <li><input type="radio" id="c-option" name="selector">
              <label for="c-option">Viviparity is the productive pattern shown by most mammals</label>
              <div class="check"></div>
          </li>
          <li><input type="radio" id="d-option" name="selector">
              <label for="d-option">Viviparity is the productive pattern shown by most mammals</label>
              <div class="check"></div>
          </li>
        </ul>
        <!-- <input type="button" name="next" value="Submit Answer" class="buttons submit-btn"> -->
        <input type="button" name="next" value="Next" class="buttons next-btn">
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions'],
    data: function(){
      return {
        questions: []
      };
    },
    watch: {
      defaultQuestions: function() {
        this.setDefault();
      }
    },
    methods: {
      setDefault: function() {
        this.questions = this.defaultQuestions;
      }
    }
  }
</script>
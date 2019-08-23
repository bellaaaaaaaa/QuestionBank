<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="box questions">
        <h2>Questions</h2>
        <div class="row" v-if="noAnswerSubmitted">
          <div class="col-8 offset-2 text-center notification">
           <i class="fas fa-exclamation-circle"></i> Please submit answer before proceeding.
          </div>
        </div>
        <h3>Question {{ currentIndex + 1 }} of {{ questions.length }}</h3>
        <h4 v-if="currentQuestion.submitted">Submitted</h4>

        <p>{{ currentQuestion.description }}</p>

        <content-display-component :default-contents="currentQuestion.contents" v-if="currentQuestion.contents"></content-display-component>
        
        <ul>
          <li v-for="(answer, index) in currentQuestion.answers" v-bind:key="index">
            <input type="radio" :id="index + '-option'" :value="answer.id" v-model="currentQuestion.selected" @click="onAnswerClick($event, answer)">
            <label :for="index + '-option'">{{ answer.description }}</label>
            <div class="check"></div>
          </li>
        </ul>

        <div class="pagination-buttons">
          <input type="button" name="back" value="Back" class="buttons back-btn" @click="onBackClick()" v-if="currentIndex != 0">

          <input type="button" name="submit" value="Submit" class="buttons submit-btn" @click="onSubmitClick()">

          <input type="button" name="skip" value="Skip" class="buttons skip-btn" @click="onSkipClick()" v-if="currentIndex + 1 < questions.length">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['questions', 'defaultCurrentQuestion', 'currentIndex'],
    data: function(){
      return {
        currentQuestion: {},
        noAnswerSubmitted: false
      };
    },
    watch: {
      defaultCurrentQuestion: function() {
        this.noAnswerSubmitted = false;
        this.currentQuestion = this.defaultCurrentQuestion;
      }
    },
    mounted: function() {
      this.currentQuestion = this.defaultCurrentQuestion;
      console.log(this.currentQuestion, 'Examqeuesion');
    },
    methods: {
      onAnswerClick: function(e, answer) {
        if(this.currentQuestion.submitted == answer.id) {
          e.preventDefault();
        }else {
          this.currentQuestion.submitted = false;
        }
      },
      onBackClick: function(e) {
        this.$emit('questionBack');
      },
      onSubmitClick: function() {
        if(!this.currentQuestion.selected || this.currentQuestion.submitted) {
          this.noAnswerSubmitted = true;
          return;
        }

        if(this.noAnswerSubmitted) {
          this.noAnswerSubmitted = false;
        }

        this.currentQuestion.submitted = true;
        var result = null;

        this.currentQuestion.answers.forEach((answer) => {
          if(answer.id == this.currentQuestion.selected) {
            if(answer.correct == true) {
              result = true;
            }else {
              result = false;
            }
          }
        });

        Vue.set(this.currentQuestion, 'result', result);
        this.$emit('questionSubmitted', this.currentQuestion);
      },
      onSkipClick: function() {
        if(this.currentIndex < this.questions.length) {
          this.$emit('questionSkip');
        }
      }
    }
  }
</script>
<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="box questions">
        <h2>Questions</h2>
        <h3>Question {{ currentIndex + 1 }} of {{ this.questions.length }}</h3>
        <p><small>Question Chapter : {{ defaultTopic.name }}</small></p>

        <p>{{ currentQuestion.description }}</p>
        <ul>
          <li v-for="(answer, index) in currentQuestion.answers" v-bind:key="index">
            <input type="radio" name="selector" :id="index + '-option'" :value="answer.id" v-model="currentQuestion.selected" @click="onAnswerClick($event)">
            <label :for="index + '-option'" :class="questionSubmitted(answer)">{{ answer.description }}</label>
            <div class="check"></div>
          </li>
        </ul>
        <input type="button" name="next" value="Submit Answer" class="buttons submit-btn" @click="onSubmitClick">

        <input type="button" name="next" value="Next" class="buttons next-btn" @click="onNextClick(false)" v-if="currentIndex + 1 < questions.length">

        <input type="button" name="submit" value="Submit" class="buttons next-btn" @click="onNextClick(true)" v-else>
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions', 'defaultCurrentQuestion', 'defaultCurrentIndex', 'defaultTopic'],
    data: function(){
      return {
        questions: [],
        currentQuestion: {},
        currentIndex: 0
      };
    },
    watch: {
      defaultQuestions: function() {
        this.questions = this.defaultQuestions;
      },
      defaultCurrentQuestion: function() {
        this.currentQuestion = this.defaultCurrentQuestion;
      },
      defaultCurrentIndex: function() {
        this.currentIndex = this.defaultCurrentIndex;
      }
    },
    mounted: function() {
      this.questions = this.defaultQuestions;
      this.currentQuestion = this.defaultCurrentQuestion;
      this.currentIndex = this.defaultCurrentIndex;
    },
    methods: {
      questionSubmitted: function(answer) {
        if(!this.currentQuestion.submitted) {
          return;
        }

        if(answer.correct) {
          return 'correct';
        }

        if(this.currentQuestion.selected == answer.id) {
          return 'wrong';
        }

        return '';
      },
      onAnswerClick: function(e) {
        if(this.currentQuestion.submitted) {
          e.preventDefault()
        }
      },
      onSubmitClick: function() {
        if(!this.currentQuestion.selected || this.currentQuestion.submitted) {
          return;
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
        this.$emit('questionSubmitted', this.currentQuestion, this.currentQuestion.selected);
      },
      onNextClick: function(finalQuestion) {
        if(!this.currentQuestion.submitted) {
          return;
        } 

        if(this.currentIndex < this.questions.length) {
          this.$emit('questionNext', finalQuestion);
        }
      }
    }
  }
</script>
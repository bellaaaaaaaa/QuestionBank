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
            <input type="radio" name="selector" :id="index + '-option'" :value="answer.id" v-model="selected">
            <label :for="index + '-option'" :class="questionSubmitted(answer)">{{ answer.description }}</label>
            <div class="check"></div>
          </li>
        </ul>
        <input type="button" name="next" value="Submit Answer" class="buttons submit-btn" @click="onSubmitClick">
        <input type="button" name="next" value="Next" class="buttons next-btn" @click="onNextClick">
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions', 'defaultTopic'],
    data: function(){
      return {
        questions: [],
        currentQuestion: {},
        currentIndex: 0,
        submitted: false,
        selected: false
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
        this.currentQuestion = this.questions[this.currentIndex];
      },
      questionSubmitted: function(answer) {
        if(!this.submitted) {
          return;
        }

        return answer.correct ? 'correct' : 'wrong';
      },
      onSubmitClick: function() {
        if(!this.selected) {
          return;
        }
        
        this.submitted = true;
        var result = null;

        this.currentQuestion.answers.forEach((answer) => {
          if(answer.id == this.selected) {
            if(answer.correct == true) {
              result = true;
            }else {
              result = false;
            }
          }
        });

        Vue.set(this.currentQuestion, 'result', result);
        this.$emit('questionSubmitted', this.currentIndex, this.currentQuestion);
      },
      onNextClick: function() {
        if(!this.submitted) {
          return;
        } 

        if(this.currentIndex < this.questions.length) {
          this.currentIndex++;
          this.currentQuestion = this.questions[this.currentIndex];
          this.$emit('questionNext', this.currentIndex, this.currentQuestion);
        }
      }
    }
  }
</script>
<template>
  <div class="box row">
    <h2>Legend</h2>
    <div class="q-links col-sm-12">
        <ol> 
          <li class="review-1" :class="changeQuestionColour(question)" v-for="(question, index) in questions" v-bind:key="index" @click="changeQuestionClick(question, index)"> 
            <a href="javascript:void(0)">
              {{ index + 1 }}
            </a>           
          </li>
        </ol>
      </div>
      <div class="q-revsec col-sm-12">
        <div>
          <span class="wpProQuiz_reviewColor correct">&nbsp;</span>
          <span class="wpProQuiz_reviewText">Correct</span>
        </div>

        <div>
          <span class="wpProQuiz_reviewColor wrong">&nbsp;</span>
          <span class="wpProQuiz_reviewText">Wrong</span>
        </div>      
    </div>
    <div class="box q-stats col-lg-6" v-if="currentQuestion.result != undefined">
      <h2>Question Stats</h2>
      <ul>
        <li v-for="(answer, index) in currentQuestion.answers" v-bind:key="index">
          <div class="row stats-col">
            <div class="col-md-10 bar-col">
              <div class="progress-bar" :class="changeProgressBar(answer)" role="progressbar" :aria-valuenow="answer.answered" aria-valuemin="0" aria-valuemax="100" :style="{ width: answer.answered + '%'}">
                %
              </div>
            </div>
            <div class="col-md-2">{{ answer.answered }}%</div>
          </div>
        </li>
      </ul>

      <p>{{ correctPercentage }}% of users answered this question correctly</p>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions', 'defaultCurrentIndex', 'defaultCurrentQuestion'],
    data: function(){
      return {
        questions: [],
        currentQuestion: {},
        currentIndex: 0,
        correctPercentage: 0
      };
    },
    watch: {
      defaultQuestions: function() {
        this.questions = this.defaultQuestions;
      },
      defaultCurrentIndex: function() {
        this.currentIndex = this.defaultCurrentIndex;
      },
      defaultCurrentQuestion: function() {
        this.currentQuestion = this.defaultCurrentQuestion;
        this.updateStats();
      }
    },
    mounted: function() {
      this.questions = this.defaultQuestions;
      this.currentIndex = this.defaultCurrentIndex;
      this.currentQuestion = this.defaultCurrentQuestion;
    },
    methods: {
      changeQuestionColour: function(question) {
        if(question.id == this.currentQuestion.id) {
          return 'active';
        } 
        
        var questionClass = '';

        switch(question.result) {
          case true:
          questionClass = 'correct';
          break;

          case false:
          questionClass = 'wrong';
          break;

          default:
          questionClass = '';
          break;
        }

        return questionClass;
      },
      changeProgressBar: function(answer) {
        return answer.correct ? 'progress-bar-correct' : 'progress-bar-wrong';
      },
      changeQuestionClick: function(question, index) {
        this.currentIndex = index;
        this.currentQuestion = question;

        this.$emit('questionChanged', this.currentQuestion, index);
      },
      updateStats: function() {
        this.currentQuestion.answers.forEach((answer, index) => {
          var answered = 0;
          
          if(this.currentQuestion.totalAnswers != 0) {
            answered = parseInt(answer.students.length / this.currentQuestion.totalAnswers * 100);
          }
           
          if(answer.correct) {
            this.correctPercentage = answered;
          }

          Vue.set(this.currentQuestion.answers[index], 'answered', answered);
        });
      }
    }
  }
</script>
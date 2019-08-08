<template>
  <div class="page-container m-3 m-sm-5">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="my-3 mb-sm-0 mb-sm-5">{{ title }} - {{ subject.name }}</h1>
        <question-stats-component :default-questions="questions" :default-current-index="currentIndex" :default-current-question="currentQuestion" @questionChanged="onQuestionChanged" v-if="!completed"></question-stats-component>
      </div>
    </div>

    <quiz-question-component :default-questions="questions" :default-current-question="currentQuestion" :default-topic="topic" :default-current-index="currentIndex" @questionSubmitted="onQuestionSubmitted" @questionNext="onQuestionNext" v-if="!completed"></quiz-question-component>

    <question-explanation-component :default-question="currentQuestion" v-if="!completed"></question-explanation-component>

    <quiz-result-component :default-questions="questions" @reset="onReset" v-if="completed"></quiz-result-component>
  </div>
</template>  

<script>
  export default{
    props: ['defaultSubject', 'defaultTopic' , 'defaultQuestions'],
    data: function(){
      return {
        title: 'Quiz',
        questions: [],
        subject: {},
        topic: {},
        currentQuestion: {},
        currentIndex: 0,
        completed: false
      };
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        if(window.location.href.indexOf('/trials') > -1) {
          this.title = 'Trial';
        }

        this.subject = JSON.parse(this.defaultSubject);
        this.topic = JSON.parse(this.defaultTopic);
        this.questions = JSON.parse(this.defaultQuestions);
        this.currentQuestion = this.questions[this.currentIndex];
      },
      onQuestionSubmitted: function(currentQuestion, answer) {
        var self = this;
        axios.post('/quizzes/topics/answer', { answer_id: answer })
        .then(({data}) => {
          self.questions[self.currentIndex] = currentQuestion;
        }, (error) => {
          console.log(error);
        });
      },
      onQuestionNext: function(finalQuestion) {
        if(finalQuestion) {
          this.completed = true;
        } else {
          this.currentIndex += 1;
          this.currentQuestion = this.questions[this.currentIndex];
        }
      },
      onQuestionChanged: function(currentQuestion, currentIndex) {
        this.currentQuestion = currentQuestion;
        this.currentIndex = currentIndex;
      },
      onReset: function() {
        this.currentIndex = 0;
        this.completed = false;
        this.setDefault();
      }
    }
  }
</script>
<template>
  <div class="page-container m-3 m-sm-5">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="my-3 mb-sm-0 mb-sm-5">Quiz - {{ subject.name }}</h1>
        <question-stats-component :default-questions="questions" :default-stats="showStats" :default-current-index="currentIndex"></question-stats-component>
      </div>
    </div>

    <quiz-question-component :default-questions="questions" @questionSubmitted="onQuestionSubmitted" @questionNext="onQuestionNext" :default-topic="topic"></quiz-question-component>

    <question-explanation-component v-if="showStats"></question-explanation-component>
  </div>
</template>  
<script>
  export default{
    props: ['defaultSubject', 'defaultTopic' , 'defaultQuestions'],
    data: function(){
      return {
        subject: {},
        topic: {},
        questions: [],
        showStats: false,
        currentIndex: 0
      };
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        this.subject = JSON.parse(this.defaultSubject);
        this.topic = JSON.parse(this.defaultTopic);
        this.questions = JSON.parse(this.defaultQuestions);
      },
      onQuestionSubmitted: function(currentIndex, currentQuestion) {
        this.questions[this.currentIndex] = currentQuestion;
        this.currentIndex = currentIndex;
        this.showStats = true;
      },
      onQuestionNext: function(currentIndex, currentQuestion) {
        this.currentIndex = currentIndex;
        this.questions[this.currentIndex] = currentQuestion;
        this.showStats = false;
      }
    }
  }
</script>

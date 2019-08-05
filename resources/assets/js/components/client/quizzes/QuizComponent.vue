<template>
  <div class="page-container m-3 m-sm-5">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="my-3 mb-sm-0 mb-sm-5">Quiz -{{ subject.name }}</h1>
        <question-stats-component :default-stats="stats" v-if="stats.show"></question-stats-component>
      </div>
    </div>

    <quiz-question-component :default-questions="questions"></quiz-question-component>

    <question-explanation-component v-if="stats.show"></question-explanation-component>
  </div>
</template>  
<script>
  export default{
    props: ['defaultSubject', 'defaultQuestions'],
    data: function(){
      return {
        subject: {},
        questions: [],
        stats: {
          show: false
        },
        currentIndex: 0
      };
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        this.subject = JSON.parse(this.defaultSubject);
        this.questions = JSON.parse(this.defaultQuestions);
      }
    }
  }
</script>

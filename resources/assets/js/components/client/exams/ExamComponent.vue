<template>
  <div class="page-container m-3 m-sm-5">
    <div class="row my-3 mb-sm-0 mb-sm-5">
      <div class="col-sm-12">
        <h1 class="">MCQ - {{ this.subject.name }}</h1>
        <p>{{ this.subject.description }}</p>
      </div>
    </div>
    
    <exam-question-component :questions="questions" :default-current-question="currentQuestion" :current-index="currentIndex"  @questionBack="onQuestionBack" @questionSubmitted="onQuestionSubmitted" @questionSkip="onQuestionSkip" v-if="!completed"></exam-question-component>

    <exam-result-component :default-questions="questions" v-if="completed"></exam-result-component>
  </div>
</template>  

<script>
  export default{
    props: ['defaultSubject', 'defaultQuestions'],
    data: function(){
      return {
        title: 'Quiz',
        questions: [],
        subject: {},
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
        this.subject = JSON.parse(this.defaultSubject);
        this.questions = JSON.parse(this.defaultQuestions);
        this.currentQuestion = this.questions[this.currentIndex];
      },
      onQuestionBack: function() {
        this.currentIndex -= 1;
        this.currentQuestion = this.questions[this.currentIndex];
      },
      onQuestionSubmitted: function(currentQuestion) {
        var self = this;
        var data = {
          question_id: currentQuestion.id,
          answer_id: currentQuestion.selected
        };

        axios.post('/mcq-exam/answer', data)
        .then(({data}) => {
          if(self.currentIndex + 1 < self.questions.length) {
            self.questions[self.currentIndex] = currentQuestion;
            self.currentIndex += 1;
            self.currentQuestion = this.questions[self.currentIndex];
          }else {
            self.completed = true;
          }
        }, (error) => {
          console.log(error);
        });
      },
      onQuestionSkip: function() {
        this.currentIndex += 1;
        this.currentQuestion = this.questions[this.currentIndex];
      },
      onQuestionChanged: function(currentQuestion, currentIndex) {
        this.currentQuestion = currentQuestion;
        this.currentIndex = currentIndex;
      }
    }
  }
</script>
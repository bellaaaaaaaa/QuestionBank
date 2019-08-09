<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="box results text-center">
        <h2>Results</h2>

        <h3>You have scored {{ score }}%</h3>

        <div class="q-links col-md-6 offset-md-3">
          <ol> 
            <li class="review-1" :class="changeClassResult(question)" v-for="(question, index) in questions" v-bind:key="index">
              <a href="javascript:void(0)">
                  {{ index + 1 }}
                </a>           
            </li> 
          </ol>
        </div>

        <input type="button" name="re-attempt" value="Attempt Again" class="buttons reattempt-btn" @click="onReset">
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions'],
    data: function(){
      return {
        questions: [],
        score: 0
      };
    },
    mounted: function() {
      this.questions = this.defaultQuestions;
      this.calculateScore();
    },
    methods: {
      changeClassResult: function(question) {
        if(question.result) {
          return 'correct';
        } else {
          return 'wrong';
        }
      },
      calculateScore: function() {
        if(this.questions.length == 0) {
          return;
        }
        
        this.questions.forEach((question, index) => {
          if(question.result) {
            this.score += 1;
          }
        });

        this.score = parseInt(this.score / this.questions.length * 100);
      },
      onReset: function() {
        location.reload();
      }
    }
  }
</script>
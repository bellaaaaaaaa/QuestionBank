<template>
  <div class="box row">
    <h2>Legend</h2>
    <div class="q-links col-sm-12">
        <ol> 
          <li class="review-1 active"> <!--add class correct/wrong for different outcome-->
            <a href="javascript:void(0)">
                1 
              </a>           
          </li>
        <li class="review-2">
            <a href="javascript:void(0)">
                2 
              </a>           
          </li>
          <li class="review-3">
            <a href="javascript:void(0)">
                3 
              </a>           
          </li>
          <li class="review-4">
            <a href="javascript:void(0)">
                4 
              </a>           
          </li>
          <li class="review-5">
            <a href="javascript:void(0)">
                5 
              </a>           
          </li>
          <li class="review-6">
            <a href="javascript:void(0)">
                6 
              </a>           
          </li>
          <li class="review-7">
            <a href="javascript:void(0)">
                7 
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
    <div class="box q-stats col-lg-6" v-if="showStats">
      <h2>Question Stats</h2>
      <ul>
        <li v-for="(answer, index) in currentQuestion.answers" v-bind:key="index">
          <div class="row stats-col">
            <div class="col-md-10 bar-col">
              <div class="progress-bar progress-bar-correct" role="progressbar" :aria-valuenow="answer.answered" aria-valuemin="0" aria-valuemax="100" :style="{ width: answer.answered + '%'}">
                %
              </div>
            </div>
            <div class="col-md-2">{{ answer.answered }}%</div>
          </div>
        </li>

        <!-- <div class="row stats-col">
          <div class="col-md-1">B</div>
          <div class="col-md-9 bar-col">
            <div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100" style="width:8%">
              %
            </div>
          </div>
          <div class="col-md-2 col-xl-1">8%</div>
        </div>
        <div class="row stats-col">
          <div class="col-md-1">C</div>
          <div class="col-md-9 bar-col">
            <div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100" style="width:16%">
              %
            </div>
          </div>
          <div class="col-md-2">16%</div>
        </div>
        <div class="row stats-col">
          <div class="col-md-1">D</div>
          <div class="col-md-9 bar-col">
            <div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width:4%">
              %
            </div>
          </div>
          <div class="col-md-2">4%</div>
        </div> -->
      </ul>

      <p>72% of users answered this question correctly</p>

    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions', 'defaultStats', 'defaultCurrentIndex'],
    data: function(){
      return {
        questions: [],
        currentQuestion: {},
        showStats: false,
        currentIndex: 0,
      };
    },
    watch: {
      defaultQuestions: function() {
        this.setDefault();
      },
      defaultStats: function() {
        this.setDefault();
      },
      defaultCurrentIndex: function() {
        this.setDefault();
      }
    },
    methods: {
      setDefault: function() {
        this.questions = this.defaultQuestions;
        this.showStats = this.defaultStats;
        this.currentIndex = this.defaultCurrentIndex;
        this.currentQuestion = this.questions[this.currentIndex];
        this.updateStats();
      },
      updateStats: function() {
        this.currentQuestion.answers.forEach((answer, index) => {
          var answered = answer.students.length / this.currentQuestion.totalAnswers * 100;
          Vue.set(this.currentQuestion.answers[index], 'answered', answered);
        });
      }
    }
  }
</script>
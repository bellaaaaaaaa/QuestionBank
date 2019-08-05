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
    <div class="box q-stats col-lg-6">
      <h2>Question Stats</h2>
      <div class="row stats-col">
        <div class="col-md-1">A</div>
        <div class="col-md-9 bar-col">
          <div class="progress-bar progress-bar-correct" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width:72%">
            %
          </div>
        </div>
        <div class="col-md-2">72%</div>
      </div>
      <div class="row stats-col">
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
      </div>

      <p>72% of users answered this question correctly</p>

    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultStats'],
    data: function(){
      return {
        stats: {}
      };
    },
    watch: {
      defaultStats: function() {
        this.setDefault();
      }
    },
    methods: {
      setDefault: function() {
        this.stats = this.defaultStats;
      }
    }
  }
</script>
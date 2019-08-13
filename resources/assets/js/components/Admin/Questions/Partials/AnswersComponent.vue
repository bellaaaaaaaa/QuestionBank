<template>
  <div class="form-group has-label">
    <label>Answers
      <span class="star">*</span>
    </label> 

    <div class="container">
        <div class="row mb-3" v-for="(answer, index) in answers" :key="index" v-if="!answer.deleted">
          <div class="col-12 col-md-9">
            <input type="text" name="answers" class="form-control" v-model="answer.description"> 
          </div>
          
          <div class="col-12 col-md-1">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="correct[]" type="checkbox" v-model="answer.correct" @click="checkboxToggle(index)">
                <span class="form-check-sign"></span> 
              </label>
            </div>
          </div>
          
          <div class="col-12 col-md-2">
            <div class="btn btn-primary btn-info" @click="deleteClick(index)">Delete</div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-10">
            <input type="text" class="form-control" name="description" v-model="newAnswer">
          </div>

          <div class="col-12 col-md-2">
            <div class="btn btn-primary btn-info" @click="onClick()">Create</div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultAnswers'],
    data: function(){
      return {
        answers:[
          {description: '',correct: false},
          {description: '',correct: false}
        ],
        newAnswer: ''
      };
    },
    watch: {
      defaultAnswers: function() {
        this.setDefault();
      }
    },
    mounted() {
      this.setDefault();
    },
    methods: {  
      setDefault: function() {
        if(!this.defaultAnswers) {
          return;
        }
        this.answers = this.defaultAnswers;
      },
      onClick: function(){
       if(this.newAnswer != ''){
          this.answers.push({description: this.newAnswer, correct: false})};
            this.newAnswer = '';
      },
      deleteClick: function(index){
        if(this.answers[index].id) {
          Vue.set(this.answers[index], 'deleted', true); 
        }else {
          this.answers.splice(index, 1);
        }
      },
      checkboxToggle: function(index){
        this.answers[index].correct = true;
          for (let [key, answer] of Object.entries(this.answers)) {
            if(key != index) {
              answer.correct = false;
          }
        }
      }
    }
  }
</script>
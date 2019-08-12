<template>
  <div class="card-body">
    <div class="form-group has-label">
      <label>Questions
        <star class="star">*</star>
      </label> 
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12">
          <textarea class="form-control" v-model="description" placeholder="Enter a question..."></textarea>
        </div>
      </div>
    </div>
  <br>

    <div class="form-group has-label">
      <label>Answers
        <star class="star">*</star>
      </label> 
    </div> 

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
        
        <br>
        
        <div class="row">
          <div class="form-group has-label">
            <label>Topics
              <star class="star">*</star>
            </label> 
          </div>  
        </div>

        <div>
          <select class="form-control" v-model="topic"></select>
        </div>

        <table-component :default-tables="question.tables" @tableChanged="onTableChanged" ref="tableChild"></table-component>

        <br>

        <div class="card-category form-category">
          <star class="star">*</star> Required fields
        </div>

      <div class="card-footer text-right">
        <button class="btn btn-info btn-fill btn-wd" @click="onSubmit()">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultQuestion'],
    data: function(){
      return {
        question: {},
        description: '',
        answers:[
          {description: '',correct: false},
          {description: '',correct: false}
        ],
        newAnswer: '',

        topic: ''
      };
    },
    mounted() {
      this.setDefault();
    },
    methods: {  
      setDefault: function() {
        if(!this.defaultQuestion) {
          return;
        }

        this.question = JSON.parse(this.defaultQuestion);
        this.description = this.question.description;
        this.answers = this.question.answers;
        // this.topic = this.question.topic;
      },
      onTableChanged: function(tables) {
        this.question.tables = tables;
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
      },
    
      onSubmit: function(){
        var count = 0;
        var method = 'POST';
        var url = '/admin/questions';

        this.answers.forEach(function(answer) {
          if(answer.correct == true) {
            count++;
          }
        })

        if(count != 1) {
          return;
        }

        if(this.defaultQuestion) {
          method = 'PUT';
          url = url + '/' + this.question.id;
        }

        var table = JSON.stringify(this.$refs.tableChild.tables);

        var fields = {
          'description': this.description, 
          'answers': this.answers,
          'topic': this.topic,
          'tables': table
        };

        axios({
          method: method,
          url: url,
          data: fields
        })
        .then (({ data }) => {
          location.href = data
        }, (error) => {
          console.log(error);
        });
      }
    }
  }
</script>
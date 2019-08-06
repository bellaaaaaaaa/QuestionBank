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
          <textarea class="form-control" v-model="name" placeholder="Enter a question..."></textarea>
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
        <div class="row mb-3" v-for="(answer, index) in answers" v-if="!answer.deleted">
          <div class="col-12 col-md-9">
            <input type="text" name="answers" class="form-control" v-model="answer.name"> 
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
            <input type="text" class="form-control" name="name" v-model="newAnswer">
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
        name: '',
        answers:[
          {name: '',correct: false},
          {name: '',correct: false}
        ],
        newAnswer: '',

        topic: ''
      };
    },
    mounted() {
      this.default();
    },
    methods: {  
      default: function() {
        if(!this.defaultQuestion) {
          return;
        }

        this.question = JSON.parse(this.defaultQuestion);
        this.name = this.question.name;
        this.answers = this.question.answers;
        // this.topic = this.question.topic;
      },

      // getAnswers: function(){
      //   axios.get('/admin/answers')
      //   .then(({ data }) => {
      //     if(data.length > 0) {
      //       this.answers = data;
      //     } else {
      //       this.answers.push({name: '', correct: false});
      //     }
      //   }, (error) => {
      //     console.log(error);
      //   });
      // },

      onClick: function(){
       if(this.newAnswer != ''){
          this.answers.push({name: this.newAnswer, correct: false})};
            this.newAnswer = '';
      },

      deleteClick: function(index){
        // if(this.answers.length > 2){
      // this.answers.splice(index, 1)};
        // this.answers[index].deleted = true;
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

        var fields = {
          'name': this.name, 
          'answers': this.answers,
          'topic': this.topic
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

        // axios.post('/admin/questions', fields)
        // .then (({ data }) => {
        //   location.href = data
        // }, (error) => {
        //   console.log(error);
        // });
      }
    }
  }
</script>
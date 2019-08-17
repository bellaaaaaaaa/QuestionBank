<template>
  <div class="card-body">
    <div class="alert alert-danger" role="alert" v-if="error.show">
      {{ error.message[0] }}
    </div>

    <div class="form-group has-label">
      <label>Questions
        <span class="star">*</span>
      </label> 

      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <textarea class="form-control" v-model="question.description" placeholder="Enter a question..."></textarea>
          </div>
        </div>
      </div>
    </div>

    <br>

    <answers-component :default-answers="question.answers" ref="answerChild"></answers-component>
        
    <div class="form-group has-label">
      <label>Explanation
        <span class="star">*</span>
      </label> 

      <div class="container">
        <div class="row">
          <div class="col-12 col-md-12">
            <textarea class="form-control" v-model="question.explanation" placeholder="Enter an explanation..."></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group has-label">
      <label>Topics 
        <span class="star">*</span>
      </label> 

      <div class="container">
        <input type="text" class="form-control" placeholder="Enter Topic" v-model="searchTopic" v-on-clickaway="closeList" @keyup="onInputChange" @click="onInputChange">
        
        <div class="vue-dropdown" v-if="haveData">
          <div class="dropdown-menu">
            <div class="dropdown-item text-capitalize" v-for="(topic, index) in topics" :key="index" @click="onSearchClick(topic)">
              <div class="row">
                <div class="col-12">
                  {{ topic.name }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>  

    <div class="form-group has-label">
      <label>Image
        <span class="star">*</span>
      </label> 

      <div class="container">
        <select class="form-control" v-model="question.image">
          <option disabled value="">Please select one</option>
          <option value="1">True</option>
          <option value="0">False</option>
        </select>
      </div>
    </div>  

    <br>

    <content-component :default-question="question" ref="contentChild" v-if="question.image == 1"></content-component>

    <div class="card-category form-category">
      <label class="star">*</label> Required fields
    </div>

    <div class="card-footer text-right">
      <button class="btn btn-info btn-fill btn-wd" @click="onSubmit()">Submit</button>
    </div>
  </div>
</template>

<script>
  import { mixin as clickaway } from 'vue-clickaway';

  export default {
    mixins: [clickaway],
    props: ['defaultQuestion'],
    data: function(){
      return {
        question: {},
        topics: [],
        searchTopic: '',
        haveData: false,
        error: {
          show: false,
          message: ''
        }
      };
    },
    mounted() {
      this.setDefault();
    },
    methods: {  
      setDefault: function() {
        if(!this.defaultQuestion) {
          this.question.contents = [];
          return;
        }

        this.question = JSON.parse(this.defaultQuestion);
        this.searchTopic = this.question.searchTopic;
      },
      onSubmit: function(){
        var count = 0;
        var method = 'POST';
        var url = '/admin/questions';
        var answers = this.$refs.answerChild.answers;

        answers.forEach(function(answer) { 
          if(answer.correct == true) {
            count++;
          }
        })

        if(count != 1) {
          this.error.show = true;
          this.error.message = ["Please choose a correct answer."];
          $(window).scrollTop(0);
          return;
        }
        
        var fields = new FormData();

        if(this.defaultQuestion) {
          url = url + '/update/' + this.question.id;
        }

        fields.append('description', this.question.description);
        fields.append('answers', JSON.stringify(answers));
        fields.append('explanation', this.question.explanation);
        fields.append('topic', this.question.topic_id);
        fields.append('image', this.question.image);

        if(this.question.image == 1) {
          var contents = this.$refs.contentChild.contents;
          fields.append('contents', JSON.stringify(contents));
          
          contents.forEach((content, index) => {
            if(content.type == 'Image') {
              fields.append(`images[${content.item.identifier}]`, content.item.file);
            }
          });
        }

        axios({
          method: method,
          url: url,
          data: fields
        })
        .then (({ data }) => {
          location.href = data
        }, (error) => {
          this.error.show = true;
          this.error.message = _.values(error.response.data.errors)[0];
          $(window).scrollTop(0);
        });
      },
      onInputChange: function() {
        axios.post('/admin/topics/search', {search: this.searchTopic})
        .then(({data}) => {
          if(data.length > 0) {
            this.topics = data;
            this.openList();
          }else {
            this.topics = [];
            this.topics.push({
              name: 'No Topics Found',
              none: true
            });
          }
        }, (error) => {});         
      },
      onSearchClick: function(topic) {
        if(topic.none) {
          this.question.topic_id = null;
          this.searchTopic = null;
          return;
        }
        this.question.topic_id = topic.id;
        this.searchTopic = topic.name;
        this.closeList();
      },
      openList: function() {
        this.haveData = true; 
      },
      closeList: function() {
        this.haveData = false;
      }
    }
  }
</script>
<template>
  <div class="card-body">
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
      <label>Topics 
        <span class="star">*</span>
      </label> 

      <div class="container">
        <select class="form-control" v-model="topic"></select>
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
<!-- 
    <tables-component :default-tables="question.tables" ref="tableChild" v-if="question.image == 1"></tables-component> -->

    <br>

    <content-component :default-question="question" ref="contentChild" v-if="question.image == 1"></content-component>

    <!-- <images-component :default-images="question.images" ref="imageChild" v-if="question.image == 1"></images-component> -->

    <div class="card-category form-category">
      <label class="star">*</label> Required fields
    </div>

    <div class="card-footer text-right">
      <button class="btn btn-info btn-fill btn-wd" @click="onSubmit()">Submit</button>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['defaultQuestion'],
    data: function(){
      return {
        question: {},
        topic: '',
        showImage: false
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
        // this.topic = this.question.topic;
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
          return;
        }

        if(this.defaultQuestion) {
          url = url + '/update/' + this.question.id;
        }
        
        var fields = new FormData();
        fields.append('description', this.question.description);
        fields.append('answers', JSON.stringify(answers));
        fields.append('topic', this.topic);
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
          console.log(error);
        });
      }
    }
  }
</script>
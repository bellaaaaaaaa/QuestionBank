<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="box row">
        <h2>Explanation</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque bibendum elit eget auctor mattis. Suspendisse id tortor nec tellus placerat varius. Sed nec molestie nunc, sit amet posuere nisi. Nulla at tincidunt lectus, a venenatis erat. Aenean in ex quam. Nam diam turpis, rutrum eget mattis non, feugiat vitae sem. Nulla pellentesque egestas aliquet.</p>

        <p>Fusce nec odio ipsum. Maecenas pretium sapien tortor. Praesent sagittis efficitur libero, non aliquet orci posuere eu. Fusce pellentesque neque orci, ut hendrerit tortor blandit eget. Nam ultrices mi in fringilla rhoncus. Ut egestas ultrices hendrerit. Quisque odio ipsum, vestibulum sit amet nisi nec, hendrerit rhoncus mauris. Vivamus vitae nisi ac nisl malesuada laoreet id non nulla. Vestibulum mi urna, dignissim ac placerat quis, pellentesque eu nunc. Aenean sagittis justo ut quam porta, eget interdum neque fringilla.</p>

        <input type="button" name="read_chapter" value="Read Chapter" class="buttons read-btn">
      </div>
    </div>
  </div>
</template>

<script>
  export default{
    props: ['defaultQuestions'],
    data: function(){
      return {
        questions: []
      };
    },
    watch: {
      defaultQuestions: function() {
        this.setDefault();
      }
    },
    methods: {
      setDefault: function() {
        this.questions = this.defaultQuestions;
      }
    }
  }
</script>
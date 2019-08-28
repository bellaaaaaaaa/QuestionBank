<template>
  <div class="login-register">
    <div class="container">
      <div class="row">
        <div class="login-register-form">
          <i class="fa fa-arrow-left" aria-hidden="true" @click="backArrow()"></i>
          <div class="card-login">
            <div>
              <h5>Enter Guardian Email:</h5>
              <p>Your guardian will receive an email with the link to proceed with your purchase</p>
              <div class="form-inline">
                <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input  v-model="email" type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                </div>

                <button type="submit" class="btn btn-primary mb-2" @click="onSubmit()">Submit</button>
              </div>
            </div> 
          </div> 
        </div>
      </div>
    </div>
  </div>
</template>  

<script>
  export default{
  //   props: ['defaultSubject', 'defaultCurrency', 'defaultMonth'],
    data: function(){
      return {
        email: '',
      };
    },
    methods: {
      onSubmit: function() {
        this.$emit('submitEmail', this.email);
      },
      backArrow: function(){
        this.$emit('backArrow')
      }
    }
  }
</script>
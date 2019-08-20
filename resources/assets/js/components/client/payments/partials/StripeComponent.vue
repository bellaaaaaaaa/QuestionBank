<template>
  <div class="login-register">
    <div class="container">
      <div class="row">
        <div class="login-register-form">
          <div class=" card-login">
            <div class="text-center">
              <h4 class="header text-center"><img :src="getImagePath('stripe.png')"></h4>
            </div> 
            
            <div class="stripe-info">
              <div class="form-group has-label">
                <label>Cardholder Name
                  <span class="star">*</span>
                </label> 
                <input name="cardholder-name" type="text" required="required" class="form-control">
              </div>

              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary login-btn">Submit</button>
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
    props: ['defaultSubject', 'defaultCurrency', 'defaultMonth'],
    data: function(){
      return {
        subject: {},
        currency: 'MYR',
        month: 1
      };
    },
    watch: {
      defaultSubject: function() {
        this.subject = this.defaultSubject;
      },
      defaultCurrency: function() {
        this.currency = this.defaultCurrency;
      },
      defaultMonth: function() {
        this.month = this.defaultMonth;
      }
    },
    methods: {
      onCurrencyChange: function(currency) {
        this.currency = currency;
      },
      onMonthChange: function(month) {
        this.month = month;
      },
      getImagePath: function(image) {
        var url = window.location.origin;
        return url + '/images/' + image;
      },
      onSubmit: function(type) {
        this[type] = true;
      }
    }
  }
</script>
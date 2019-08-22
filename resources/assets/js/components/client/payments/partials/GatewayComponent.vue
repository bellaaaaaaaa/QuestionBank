<template>
  <div class="login-register">
    <div class="container">
      <div class="row">
        <div class="login-register-form">
          <div class="card-login">
            <div class="text-center">
              <h4 class="header text-center">Payment</h4>
              <p>Select the payment gateway you would like to use</p>
            </div> 

            <div class="payment-gateway">
              <div class="form-group has-label row">
                <div class="col-sm-6" id="paypal">
                  <img :src="getImagePath('paypal-long.png')" @click="onClick('paypal')">
                </div>
                
                <div class="col-sm-6" id="stripe">
                  <img :src="getImagePath('stripe.png')" @click="onClick('stripe')">
                </div>
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
      };
    },
    methods: {
      getImagePath: function(image) {
        var url = window.location.origin;
        return url + '/images/' + image;
      },
      onClick: function(type) {
        if(type == 'stripe') {
          this.$emit('submit', type);
          return;
        }

        location.href = `/payments/${this.defaultSubject.id}/paypal?month=${this.defaultMonth}&currency=${this.defaultCurrency}`;
      }
    }
  }
</script>
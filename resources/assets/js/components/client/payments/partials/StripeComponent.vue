<template>
  <div class="login-register">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12 mx-auto">
          <div class="alert alert-danger" role="alert" v-if="error.show">
            {{ error.message }}
          </div>
        </div>

        <div class="login-register-form">
          <div class="card-login">
            <div class="text-center">
              <h4 class="header text-center"><img :src="getImagePath('stripe.png')"></h4>
            </div> 
            
            <div class="stripe-info">
              <div class="form-group has-label">
                <label>Cardholder Name
                  <span class="star">*</span>
                </label> 
                <input name="cardholder-name" type="text" required="required" class="form-control" v-model="cardName">

                <div id="card-element" class="mt-3"></div>
              </div>

              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary login-btn" @click="onSubmitClick">Submit</button>
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
        stripe: null,
        cardElement: null,
        cardName: '',
        error: {
          show: false,
          message: ''
        }
      };
    },
    mounted: function() {
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        this.stripe = Stripe(process.env.MIX_STRIPE_KEY);
        var elements = this.stripe.elements();
        this.cardElement = elements.create('card');
        this.cardElement.mount('#card-element');
      },
      onSubmitClick: function() {
        var self = this;

        if(this.error.show) {
          this.hideErrorMessage();
        }

        this.stripe.createPaymentMethod('card', self.cardElement, {
          billing_details: { name: self.cardName }
        }).then(function(result) {
          if(!result.error) {
            axios(`/payments/${self.defaultSubject.id}/stripe?month=${self.defaultMonth}&currency=${self.defaultCurrency}&complete=create`, {
              method: 'POST',
              data: { paymentMethodId: result.paymentMethod.id}
            }).then(function(data) {
              self.handleServerResponse(data);  
            }, (error) => {
              self.showErrorMessage(error.response.data);
            });
          }
        });
      },
      handleServerResponse(response) {
        var self = this;
        
        if (response.data.requires_action) {
          this.stripe.handleCardAction(
            response.data.payment_intent_client_secret
          ).then(function(result) {
            if (result.error) {
              this.error.showErrorMessage(result.error);
            } else {
              axios(`/payments/${self.defaultSubject.id}/stripe?month=${self.defaultMonth}&currency=${self.defaultCurrency}&complete=create`, {
                method: 'POST',
                data: { paymentIntentId: result.paymentIntent.id }
              }).then(function(data) {
                self.handleServerResponse(data);
              }, (error) => {
                self.showErrorMessage(error.response.data);
              });
            }
          });
        } else {
          location.href = response.data;
        }
      },
      showErrorMessage: function(message) {
        if(this.error.show) {
          return;
        }

        this.error.show = true;
        this.error.message = message;
      },
      hideErrorMessage: function() {
        if(!this.error.show) {
          return;
        }

        this.error.show = false;
        this.error.message = '';
      },
      getImagePath: function(image) {
        var url = window.location.origin;
        return url + '/images/' + image;
      }
    }
  }
</script>
<template>
  <div class="login-register">
    <div class="container">
      <div class="row">
        <div class="col-10 col-sm-8 col-lg-4 login-register-form">
          <div class="card-payment">
            <div class="text-center">
              <h4 class="header text-center">Payment</h4>
              <p>Select the plan you would like to commit to</p>
            </div>

            <div>
              <div class="row form-group has-label">
                <label class="col-12">Subject
                  <span class="star">*</span>
                </label> 
               <h4 class="header col-12">{{ subject.name }}</h4>
              </div>

              <div class="row form-group has-label">
                <label class="col-12">Payment Plan
                  <span class="star">*</span>
                </label> 

                <div class="form-group col-12">
                  <select class="form-control" id="currency" v-model="currency" @change="onCurrencyChange()">
                    <option value="MYR" selected>MYR</option>
                    <option value="USD">USD</option>
                  </select>
                </div>

                <div class="payment-plan justify-content-between col-12">
                  <div class="form-check" @click="onMonthChange(1)">
                    <input class="form-check-input" name="payment_plan" type="radio" id="1month" value="1" v-model="month">
                    <label class="form-check-label" for="1month">
                      1 Month <br> <span class="currency"></span><span id="amount1">{{ currency + ' ' + price.oneMonth.toFixed(2) }}</span>
                    </label>
                  </div>
 
                  <div class="form-check" @click="onMonthChange(2)">
                    <input class="form-check-input" name="payment_plan" type="radio" id="2months" value="2" v-model="month">
                    <label class="form-check-label" for="2months">
                      2 Months <br> <span class="currency"></span><span id="amount2">{{ currency + ' ' + price.twoMonth.toFixed(2) }}</span>
                    </label>
                  </div>
                  
                  <div class="form-check" @click="onMonthChange(3)">
                    <input class="form-check-input" name="payment_plan" type="radio" id="3months" value="3" v-model="month">
                    <label class="form-check-label" for="3months">
                      3 Months <br> <span class="currency"></span><span id="amount3">{{ currency + ' ' + price.threeMonth.toFixed(2) }}</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
                  
            <div class=" form-category">
              <label class="star">*</label> 
              Required fields
            </div>
          </div> 

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary login-btn" @click="onSubmit()">Submit</button>
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
        month: 1,
        currency: 'MYR',
        price: {
          oneMonth: 0,
          twoMonth: 0,
          threeMonth: 0
        }
      };
    },
    mounted(){
      this.setDefault();
    },
    watch: {
      defaultSubject: function() {
        this.subject = this.defaultSubject;
        this.setDefault();
        console.log(this.price, 'second time')
      },
      defaultCurrency: function() {
        this.currency = this.defaultCurrency;
      },
      defaultMonth: function() {
        this.month = this.defaultMonth;
      }
    },
    methods: {
      setDefault: function() {
        this.subject = this.defaultSubject;
        this.price.oneMonth = this.subject.one_month_price;
        this.price.twoMonth = this.subject.two_month_price;
        this.price.threeMonth = this.subject.three_month_price;
      },
      onCurrencyChange: function() {
        if(this.currency == 'MYR') {
          this.setDefault();
          return;
        }

        var self = this;
        
        axios.get(`/rates/${self.currency}`)
        .then(({data}) => {
          if(data.length == 0) {
            self.setDefault();
            return;
          }
          
          data.forEach((rate, index) => {
            switch(rate.month) {
              case 1:
              self.price.oneMonth /= rate.amount;
              break;

              case 2:
              self.price.twoMonth /= rate.amount;
              break;

              case 3:
              self.price.threeMonth /= rate.amount;
              break;

              default:
              break;
            }
          });
        }, (error) => {});

        this.$emit('currencyChange', this.currency);
      },
      onMonthChange: function(month) {
        this.month = month;
        this.$emit('monthChange', this.month);
      },
      onSubmit: function() {
        if(!this.month) {
          return;  
        }

        this.$emit('submit', 'gateway');
      }
    }
  }
</script>
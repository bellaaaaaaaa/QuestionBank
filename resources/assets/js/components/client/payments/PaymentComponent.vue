<template>
  <div>
    <plan-component :default-subject="subject" :default-currency="currency" :default-month="month" @currencyChange="onCurrencyChange" @monthChange="onMonthChange" @submit="onSubmit" v-if="!gateway"></plan-component>

    <gateway-component :default-subject="subject" :default-currency="currency" :default-month="month" @submit="onSubmit" v-if="gateway && !stripe"></gateway-component>

    <stripe-component :default-subject="subject" :default-currency="currency" :default-month="month" @submit="onSubmit" v-if="stripe"></stripe-component>
  </div>
</template>  

<script>
  export default{
    props: ['defaultSubject'],
    data: function(){
      return {
        subject: {},
        currency: 'MYR',
        month: 1,
        gateway: false,
        stripe: false
      };
    },
    mounted(){ 
      this.setDefault();
    },
    methods: {
      setDefault: function() {
        this.subject = JSON.parse(this.defaultSubject);
      },
      onCurrencyChange: function(currency) {
        this.currency = currency;
      },
      onMonthChange: function(month) {
        this.month = month;
      },
      onSubmit: function(type) {
        this[type] = true;
      }
    }
  }
</script>
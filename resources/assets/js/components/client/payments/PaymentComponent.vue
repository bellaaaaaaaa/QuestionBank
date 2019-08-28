<template>
  <div>
    <plan-component :default-subject="subject" :default-currency="currency" :default-month="month" @currencyChange="onCurrencyChange" @monthChange="onMonthChange" @submit="onSubmit" v-if="!gateway && !emailGuardian"></plan-component>

    <gateway-component :default-subject="subject" :default-currency="currency" :default-month="month" @emailForm='showEmailForm' @submit="onSubmit" v-if="gateway && !stripe"></gateway-component>

    <stripe-component :default-subject="subject" :default-currency="currency" :default-month="month" @submit="onSubmit" v-if="stripe"></stripe-component>
    <email-guardian-component @submitEmail="onSubmitEmail"  @backArrow="hideEmailForm" v-if='emailGuardian'></email-guardian-component>
  </div>
</template>  

<script>
  import axios from 'axios'
  export default{
    props: ['defaultSubject', 'siteUrl'],
    data: function(){
      return {
        subject: {},
        currency: 'MYR',
        month: 1,
        gateway: false,
        stripe: false,
        emailGuardian: false,
        emailUrl: ''
      };
    },
    mounted(){ 
      this.setDefault();
      console.log('defaultSubject', this.defaultSubject)
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
      },
      onSubmitEmail: function(email){
        const config = { headers: { 'Content-Type': undefined}}
        var formData = new FormData
        formData.append('email', email)
        var paymentRedirect = this.siteUrl + this.emailUrl
        formData.append('url', paymentRedirect)
        axios.post(`/sendMail`, formData, config)
        .then(response => {
          	location.href = response.data;
        })
        .catch(err => {
          console.log(err)
        })
      },
      showEmailForm: function(url){
        console.log('url', url)
        this.emailUrl = url
        this.gateway = false;
        this.emailGuardian = true;

      },
      hideEmailForm: function(){
        this.emailGuardian = false;
        console.log('hideEmailForm', this.defaultSubject, this.subject);
      }
    }
  }
</script>
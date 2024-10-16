<template>
    <li class="top-nav-account" v-if="isAuth">
        <div class="profileLink">
            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8327 4.00008C11.8327 5.84103 10.3403 7.33341 8.49935 7.33341C6.6584 7.33341 5.16602 5.84103 5.16602 4.00008C5.16602 2.15913 6.6584 0.666748 8.49935 0.666748C10.3403 0.666748 11.8327 2.15913 11.8327 4.00008ZM10.4993 4.00008C10.4993 5.10465 9.60392 6.00008 8.49935 6.00008C7.39478 6.00008 6.49935 5.10465 6.49935 4.00008C6.49935 2.89551 7.39478 2.00008 8.49935 2.00008C9.60392 2.00008 10.4993 2.89551 10.4993 4.00008Z" fill="black"/>
                <path d="M15.8327 15.3334H14.4993C14.4993 12.0197 11.8131 9.33341 8.49935 9.33341C5.18564 9.33341 2.49935 12.0197 2.49935 15.3334H1.16602C1.16602 11.2833 4.44926 8.00008 8.49935 8.00008C12.5494 8.00008 15.8327 11.2833 15.8327 15.3334Z" fill="black"/>
            </svg>
            {{ name }}
        </div>
        <div class="popup_account" style="display: none">
            <a :href="route('account.profile.edit')" >
                {{ $trans('storefront::account.pages.my_profile') }}
            </a>
            <a :href="route('account.orders.index')" >
                {{ $trans('storefront::account.pages.my_orders')  }}
            </a>
            <a :href="route('logout')" >
                {{ $trans('storefront::account.pages.logout') }}
            </a>
        </div>
    </li>
    <li v-else>
        <a :href="route('login')" class='color-black font-14-16-normal'>
            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8327 4.00008C11.8327 5.84103 10.3403 7.33341 8.49935 7.33341C6.6584 7.33341 5.16602 5.84103 5.16602 4.00008C5.16602 2.15913 6.6584 0.666748 8.49935 0.666748C10.3403 0.666748 11.8327 2.15913 11.8327 4.00008ZM10.4993 4.00008C10.4993 5.10465 9.60392 6.00008 8.49935 6.00008C7.39478 6.00008 6.49935 5.10465 6.49935 4.00008C6.49935 2.89551 7.39478 2.00008 8.49935 2.00008C9.60392 2.00008 10.4993 2.89551 10.4993 4.00008Z" fill="black"/>
                <path d="M15.8327 15.3334H14.4993C14.4993 12.0197 11.8131 9.33341 8.49935 9.33341C5.18564 9.33341 2.49935 12.0197 2.49935 15.3334H1.16602C1.16602 11.2833 4.44926 8.00008 8.49935 8.00008C12.5494 8.00008 15.8327 11.2833 15.8327 15.3334Z" fill="black"/>
            </svg>
            {{ $trans('storefront::layout.login') }}
        </a>
    </li>

</template>
<script>

//import LoginForm from "./LoginForm.vue";

export default {
   // components: {LoginForm},
    props: ['isAuth','user'],

    // data(){
    //     return {
    //         showLoginForm: false,
    //         showRegisterForm: false
    //     }
    // },
    computed: {
      login(){
        return isAuth ? "need login" : "nont need";
      },
      name(){
          return (this.isAuth) ? this.user.first_name + " " + this.user.last_name : '';
      },
    },
}

</script>


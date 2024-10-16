import store from "../../store";
import Errors from "../../Errors";
import CartHelpersMixin from "../../mixins/CartHelpersMixin";
import CartItemHelpersMixin from "../../mixins/CartItemHelpersMixin";
import noUiSlider from "nouislider";
import flatpickr from "flatpickr";
import { Russian } from "flatpickr/dist/l10n/ru.js";
import { Romanian } from "flatpickr/dist/l10n/ro.js";

export default {
    mixins: [CartHelpersMixin, CartItemHelpersMixin],

    props: [
        "customerEmail",
        "customerPhone",
        "gateways",
        "defaultAddress",
        "addresses",
        "countries",
        "variants",
        "actions",
        "from",
        "to",
        "locale",
    ],

    data() {
        return {
            form: {
                customer_email: this.customerEmail,
                customer_phone: this.customerPhone,
                billing: {
                    first_name: null,
                    last_name: null,
                    address_1: null,
                    email: null,
                    city: null,
                    zip: 2000,
                    country:'MD',
                    state: null,
                },
                shipping: {
                    first_name: null,
                    last_name: null,
                    address_1: null,
                    email: null,
                    city: null,
                    zip: 2000,
                    country:'MD',
                    state: null,
                },
                billingAddressId: null,
                shippingAddressId: null,
                newBillingAddress: false,
                newShippingAddress: false,
                terms_and_conditions: 'accepted',
                shipping_method: 'free_shipping',
                payment_method: 'paynet',
                ship_to_a_different_address: false,
                timeFrom: this.minTime,
                timeTo: this.maxTime,
                delivery_comment: null,
                delivery_date: null,
                takePhotoOnDelivery: false,
                sendMePhotoBeforeDelivery: false,
                recipient_action: null,
                delivery_action: null

            },
            states: {
                billing: {},
                shipping: {},
            },
            errorslist: {},
            controller: null,
            placingOrder: false,
            errors: new Errors(),
            authorizeNetToken: null,
            payFastFormFields: null,
            showHintStatus: false,
            choosenVariant: 1,
            showRecipientblock: true,
            showresult: null,
            variantResult: null,
            choosenAction: 1,
            showActionsStatus: false,
            minTime: '8',
            maxTime: '18',
            locales: {
                'ru': Russian,
                'ro': Romanian,
                'en': null
            },
            choosencity: null,
            citesitems: null,


        };
    },

    computed: {
        hasAddress() {
            return Object.keys(this.addresses).length !== 0;
        },

        firstCountry() {
            return Object.keys(this.countries)[0];
        },

        hasBillingStates() {
            return Object.keys(this.states.billing).length !== 0;
        },

        hasShippingStates() {
            return Object.keys(this.states.shipping).length !== 0;
        },

        hasNoPaymentMethod() {
            return Object.keys(this.gateways).length === 0;
        },

        firstPaymentMethod() {
            return Object.keys(this.gateways)[0];
        },

        shouldShowPaymentInstructions() {
            return ["bank_transfer", "check_payment"].includes(
                this.form.payment_method
            );
        },
        showTimeTo(){
          return this.form.timeTo ;
        },
        showTimeFrom(){
            return this.form.timeFrom ;
        },
        paymentInstructions() {
            if (this.shouldShowPaymentInstructions) {
                return this.gateways[this.form.payment_method].instructions;
            }
        },

        hasFreeShipping() {
            return this.cart.coupon?.free_shipping ?? false;
        },
        /*errors methods*/
        hasbillingNameError(){
            return (this.errorslist && this.errorslist['billing.first_name']);
        },
        getbillingNameError(){
            return (this.hasbillingNameError) ? this.errorslist['billing.first_name'][0] : '';
        },
        hasbillingPhoneError(){
            return (this.errorslist && this.errorslist['billing.phone']);
        },
        getbillingPhoneError(){
            return (this.hasbillingPhoneError) ? this.errorslist['billing.phone'][0] : '';
        },
        hasbillingEmailError(){
            return (this.errorslist && this.errorslist['billing.email']);
        },
        getBillingEmailError(){
            return (this.hasbillingEmailError) ? this.errorslist['billing.email'][0] : '';
        },

        hasshippingPhoneError(){
            return (this.errorslist && this.errorslist['shipping.phone']);
        },
        getshippingPhoneError(){
            return (this.hasshippingPhoneError) ? this.errorslist['shipping.phone'][0] : '';
        },
        hasshippingNameError(){
            return (this.errorslist && this.errorslist['shipping.first_name']);
        },
        getshippingNameError(){
            return (this.hasshippingNameError) ? this.errorslist['shipping.first_name'][0] : '';
        },
        hasDeliveryDateError(){
            return (this.errorslist && this.errorslist['delivery_date']);
        },
        getDeliveryDateError(){
            return (this.hasDeliveryDateError) ? this.errorslist['delivery_date'][0] : '';
        },
        hasBillindAdressError(){
            return (this.errorslist && this.errorslist['billing.address_1']);
        },
        getBillingAdressError(){
            return (this.hasBillindAdressError) ? this.errorslist['billing.address_1'][0] : '';
        },

        /*------------------*/
    },

     //watch: {

    //     "form.billing.city": function (newCity) {
    //         if (newCity) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.shipping.city": function (newCity) {
    //         if (newCity) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.billing.zip": function (newZip) {
    //         if (newZip) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.shipping.zip": function (newZip) {
    //         if (newZip) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.billing.state": function (newState) {
    //         if (newState) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.shipping.state": function (newState) {
    //         if (newState) {
    //             this.addTaxes();
    //         }
    //     },
    //
    //     "form.ship_to_a_different_address": function (newValue) {
    //         if (newValue && this.form.shippingAddressId) {
    //             this.form.shipping =
    //                 this.addresses[this.form.shippingAddressId];
    //         } else {
    //             this.form.shipping = {};
    //             this.resetAddressErrors("shipping");
    //         }
    //
    //         this.addTaxes();
    //     },
    //
    //     "form.terms_and_conditions": function () {
    //         this.errors.clear("terms_and_conditions");
    //     },
    //
    //     "form.payment_method": function (newPaymentMethod) {
    //         if (newPaymentMethod === "paypal") {
    //             this.$nextTick(this.renderPayPalButton);
    //         }
    //     },
    // },

    created() {
        // if (this.defaultAddress.address_id) {
        //     this.form.billingAddressId = this.defaultAddress.address_id;
        //     this.form.shippingAddressId = this.defaultAddress.address_id;
        //
        //     this.mergeSavedBillingAddress();
        //     this.mergeSavedShippingAddress();
        // }
        //
        // if (!this.hasAddress) {
        //     this.form.newBillingAddress = true;
        //     this.form.newShippingAddress = true;
        // }
        //
        // this.$nextTick(() => {
        //     this.changePaymentMethod(this.firstPaymentMethod);
        //
        //     if (store.state.cart.shippingMethodName) {
        //         this.changeShippingMethod(store.state.cart.shippingMethodName);
        //     } else {
        //         this.updateShippingMethod(this.firstShippingMethod);
        //     }
        // });

    },
    mounted() {
        this.checkVariant(1);
        this.checkAction(1);
        this.initTimeRanger();
        $('.noUi-value.noUi-value-horizontal.noUi-value-large').each(function() {
            var val = $(this).html();
            val = val + ":00";
            $(this).html(val);
        });
        this.dateTimePicker();
        this.updateShippingMethod(this.shipping_default);
        this.initAddress();
        let th = this;
        $('.cityItem').each(function(){
            $(this).on('click',function (e){
                th.initAddress();
            })
        })


    },
    methods: {

        initAddress(){
          this.choosencity = JSON.parse(localStorage.getItem('choosencity'));
          this.form.billing.city = this.choosencity.name;
          this.form.billing.state = this.choosencity.key;
          this.form.shipping.city = this.choosencity.name;
          this.form.shipping.state = this.choosencity.key;
        },
        checkVariant(index){
            let chosenVariant = this.variants[index];
            this.choosenVariant = index;
            this.form.recipient_action = index;
            this.showHintStatus = false;
            $(".autocomlete_input").val(this.variants[index].title);
            this.showresult = this.variants[index].description.split('/');
            this.variantResult = this.variants[index].description;

            if(this.showresult[1]!==undefined && this.showresult[2]!==undefined) {
                this.variantResult = this.showresult[0] + "<div class='div_tooltip'>" + this.showresult[1]
                    + "<span class='tooltip_text'>" + this.variants[index].hint +"</span></div> " + this.showresult[2];
            }

            $(".showhint").html(this.variantResult);
        },

        checkAction(index){
            this.choosenAction = index;
            this.form.delivery_action = index;
            $(".autocomlete_input_action").val(this.actions[index].title);
            this.showActionsStatus = false;
        },

        showAction(){
            this.showActionsStatus = !this.showActionsStatus;
        },

        showHint(){
            this.showHintStatus = !this.showHintStatus;
        },

        hideRecipientblock(){
            this.showRecipientblock = !this.showRecipientblock
            this.form.ship_to_a_different_address = !this.showRecipientblock;
        },
        changedata(id){
           let item = $("#"+id);
           let value = item.val();
           this.form[id] = value;
        },
        changebilling(id){
            let item = $("#"+id);
            let value = item.val();
            this.form.billing[id] = value;
        },
        changeCheckbox(id){
            this.form[id] = !this.form[id];
        },



        initTimeRanger() {
            noUiSlider.create(this.$refs.timeRanger, {
                connect: true,
                direction: window.FleetCart.rtl ? "rtl" : "ltr",
                start: [this.minTime, this.maxTime],
                step: 1,
                range: {
                    min: [0],
                    max: [24],
                },
                pips: {
                    mode: 'values',
                    values: [2.00, 6.00, 10.00, 14.00, 18.00, 22.00],
                    density: 4
                }
            });

            this.$refs.timeRanger.noUiSlider.on("update", (values, handle) => {
                let value = values[handle];

                if (handle === 0) {
                    this.form.timeFrom = value.replace(".",":");
                } else {
                    this.form.timeTo = value.replace(".",":");
                }
            });
        },

        dateTimePicker(elements) {
            elements = elements || $(".datetime-picker");

            elements = elements instanceof jQuery ? elements : $(elements);


            for (let el of elements) {
                $(el).flatpickr({
                    mode: el.hasAttribute("data-range") ? "range" : "single",
                    enableTime: el.hasAttribute("data-time"),
                    noCalender: el.hasAttribute("data-no-calender"),
                    altInput: true,
                    dateFormat: "d.m.Y",
                    altFormat: "d.m.Y",
                    locale: this.locales[this.locale]
                });
            }
        },

        changeBillingName(){
            let name = $('#billing_name').val();

            if(name.match(" ")){
                name = name.split(" ");
                this.form.billing.first_name = name[0];
                this.form.billing.last_name = name[1];
                if(!this.showRecipientblock){
                    this.form.shipping.first_name = name[0];
                    this.form.shipping.last_name = name[1];
                }
            } else {
                this.form.billing.first_name = name;
                this.form.billing.last_name = '';
                if(!this.showRecipientblock){
                    this.form.shipping.first_name = name;
                    this.form.shipping.last_name = '';
                }
            }
        },

        changeBillingPhone() {
            let phone = $("#billing_phone").val();
            this.form.billing.phone = phone;

            if(!this.showRecipientblock){
                this.form.shipping.phone = phone;
            }

        },

        changeBillingEmail() {
            let email = $("#billing_email").val();
            this.form.billing.email = email;

            if(!this.showRecipientblock){
                this.form.shipping.email = email;
            }

        },

        changeShippingName(){
            let name = $('#shipping_name').val();

            if(name.match(" ")){
                name = name.split(" ");
                this.form.shipping.first_name = name[0];
                this.form.shipping.last_name = name[1];

            } else {
                this.form.shipping.first_name = name;
                this.form.shipping.last_name = '';
            }
        },

        changeShippingPhone() {
            let phone = $("#shipping_phone").val();
            this.form.shipping.phone = phone;

        },

        changeShippingEmail() {
            let email = $("#shipping_email").val();
            this.form.shipping.email = email;
        },

        // changeBillingAddress(address) {
        //     if (
        //         this.form.newBillingAddress ||
        //         this.form.billingAddressId === address.id
        //     ) {
        //         return;
        //     }
        //
        //     this.form.billingAddressId = address.id;
        //
        //     this.mergeSavedBillingAddress();
        // },
        //
        // addNewBillingAddress() {
        //     this.resetAddressErrors("billing");
        //
        //     this.form.billing = {};
        //     this.form.newBillingAddress = !this.form.newBillingAddress;
        //
        //     if (!this.form.newBillingAddress) {
        //         this.mergeSavedBillingAddress();
        //     }
        // },
        //
        // changeShippingAddress(address) {
        //     if (
        //         this.form.newShippingAddress ||
        //         this.form.shippingAddressId === address.id
        //     ) {
        //         return;
        //     }
        //
        //     this.form.shippingAddressId = address.id;
        //
        //     this.mergeSavedShippingAddress();
        // },
        //
        // addNewShippingAddress() {
        //     this.resetAddressErrors("shipping");
        //
        //     this.form.shipping = {};
        //     this.form.newShippingAddress = !this.form.newShippingAddress;
        //
        //     if (!this.form.newShippingAddress) {
        //         this.mergeSavedShippingAddress();
        //     }
        // },
        //
        // // reset address errors based on address type
        // resetAddressErrors(addressType) {
        //     Object.keys(this.errors.errors).map((key) => {
        //         key.indexOf(addressType) !== -1 && this.errors.clear(key);
        //     });
        // },
        //
        // mergeSavedBillingAddress() {
        //     this.resetAddressErrors("billing");
        //
        //     if (!this.form.newBillingAddress && this.form.billingAddressId) {
        //         this.form.billing = this.addresses[this.form.billingAddressId];
        //     }
        // },
        //
        // mergeSavedShippingAddress() {
        //     this.resetAddressErrors("shipping");
        //
        //     if (
        //         this.form.ship_to_a_different_address &&
        //         !this.form.newShippingAddress &&
        //         this.form.shippingAddressId
        //     ) {
        //         this.form.shipping =
        //             this.addresses[this.form.shippingAddressId];
        //     }
        // },
        //
        // changeBillingCity(city) {
        //     this.$set(this.form.billing, "city", city);
        // },
        //
        // changeShippingCity(city) {
        //     this.$set(this.form.shipping, "city", city);
        // },
        //
        // changeBillingZip(zip) {
        //     this.$set(this.form.billing, "zip", zip);
        // },
        //
        // changeShippingZip(zip) {
        //     this.$set(this.form.shipping, "zip", zip);
        // },
        //
        // changeBillingCountry(country) {
        //     this.$set(this.form.billing, "country", country);
        //
        //     if (country === "") {
        //         this.form.billing.state = "";
        //         this.states.billing = {};
        //
        //         return;
        //     }
        //
        //     this.fetchStates(country, (response) => {
        //         this.$set(this.states, "billing", response.data);
        //         this.$set(this.form.billing, "state", "");
        //     });
        // },
        //
        // changeShippingCountry(country) {
        //     this.$set(this.form.shipping, "country", country);
        //
        //     if (country === "") {
        //         this.form.shipping.state = "";
        //         this.states.shipping = {};
        //
        //         return;
        //     }
        //
        //     this.fetchStates(country, (response) => {
        //         this.$set(this.states, "shipping", response.data);
        //         this.$set(this.form.shipping, "state", "");
        //     });
        // },
        //
        // fetchStates(country, callback) {
        //     axios
        //         .get(route("countries.states.index", { code: country }))
        //         .then(callback);
        // },
        //
        // changeBillingState(state) {
        //     this.$set(this.form.billing, "state", state);
        // },
        //
        // changeShippingState(state) {
        //     this.$set(this.form.shipping, "state", state);
        // },
        //
        // changePaymentMethod(paymentMethod) {
        //     this.$set(this.form, "payment_method", paymentMethod);
        // },
        //
        // changeShippingMethod(shippingMethodName) {
        //     this.$set(this.form, "shipping_method", shippingMethodName);
        // },
        //
        async updateShippingMethod(shippingMethodName) {
            if (!shippingMethodName) {
                return;
            }

            this.loadingOrderSummary = true;

            this.changeShippingMethod(shippingMethodName);

            try {
                const response = await axios.post(
                    route("cart.shipping_method.store"),
                    {
                        shipping_method: shippingMethodName,
                    }
                );

                store.updateCart(response.data);
            } catch (error) {
                this.$notify(error.response.data.message);
            } finally {
                this.loadingOrderSummary = false;
            }
        },

        // async addTaxes() {
        //     this.loadingOrderSummary = true;
        //
        //     try {
        //         const response = await axios.post(
        //             route("cart.taxes.store"),
        //             this.form
        //         );
        //
        //         store.updateCart(response.data);
        //     } catch (error) {
        //         this.$notify(error.response.data.message);
        //     } finally {
        //         this.loadingOrderSummary = false;
        //     }
        // },
        //
        // updateCart(cartItem, qty) {
        //     this.loadingOrderSummary = true;
        //
        //     if (this.controller) {
        //         this.controller.abort();
        //     }
        //
        //     this.controller = new AbortController();
        //
        //     axios
        //         .put(
        //             route("cart.items.update", {
        //                 id: cartItem.id,
        //             }),
        //             {
        //                 qty: qty || 1,
        //             },
        //             {
        //                 signal: this.controller.signal,
        //             }
        //         )
        //         .then((response) => {
        //             store.updateCart(response.data);
        //         })
        //         .catch((error) => {
        //             if (error.code !== "ERR_CANCELED") {
        //                 store.updateCart(error.response.data.cart);
        //
        //                 this.$notify(error.response.data.message);
        //             }
        //         })
        //         .finally(() => {
        //             this.loadingOrderSummary = false;
        //         });
        // },

        placeOrder() {
            if (!this.form.terms_and_conditions || this.placingOrder) {
                return;
            }

            this.placingOrder = true;

            axios
                .post(route("checkout.store"), {
                    ...this.form,
                    ship_to_a_different_address:
                        +this.form.ship_to_a_different_address,
                })
                .then(({ data }) => {
                    if (data.redirectUrl) {
                        window.location.href = data.redirectUrl;
                    } else {
                        this.confirmOrder(
                            data.orderId,
                            this.form.payment_method
                        );
                    }
                })
                .catch(({ response }) => {
                    if (response.status === 422) {
                        this.errors.record(response.data.errors);
                    }

                    this.$notify(response.data.message);
                    this.errorslist = response.data.errors;
                    this.placingOrder = false;
                });
        },

        confirmOrder(orderId, paymentMethod, params = {}) {
            axios
                .get(
                    route("checkout.complete.store", {
                        orderId,
                        paymentMethod,
                        ...params,
                    })
                )
                .then(() => {
                    window.location.href = route("checkout.complete.show");
                })
                .catch((error) => {
                    this.placingOrder = false;
                    this.loadingOrderSummary = false;

                    this.deleteOrder(orderId);
                    this.$notify(error.response.data.message);
                });
        },

        deleteOrder(orderId) {
            if (!orderId) {
                return;
            }

            axios
                .get(route("checkout.payment_canceled.store", { orderId }))
                .then((response) => {
                    this.$notify(response.data.message);
                });
        },
    },
};

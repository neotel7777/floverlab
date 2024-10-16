<template>
    <div class="deliveryWrapp">
        <div class="devWrapper gap-20 flex-row-start-center"
             @click="showcitiesClick"
        >
            <img :src="getDeliveryIcon">
            <div class="devDescription jkl;kjlkj flex-column-start-start">
                <div class="title font-14-16-normal color-neutral-500">{{ $trans("order::delivery.delivery_sity")}}</div>
                <div class="city font-16-20-normal color-white" v-html="chosenCity"></div>
            </div>
        </div>
        <div class="popupLocalites white_box"
             :class="showcities ? 'active' : ''">
            <div class="localitesWrap flex-column-start-start">

                <div class="titlerow">
                    <div class="title font-20-26-500" >{{ $trans("order::delivery.delivery_sity")}}</div>
                    <div class="closepopup" @click="hidepopup"></div>
                </div>
                <div class="citiesWrap flex-row-between-center flex-wrap gap-10">
                    <div class="cityItem" v-for="(item,index) in data"
                        :class="selectedCity==index ? 'active' : ''"
                        :key="index"
                        :index="index"
                        :item="item"
                        @click="changeCity(index)"
                    v-html="item">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['data'],
    computed: {
        chosenCity(){
            return this.data[this.selectedCity];
        },
        getDeliveryIcon(){
            return `${window.FleetCart.baseUrl}/storage/media/SityDeliverIcon.png`;
        }
    },
    data() {
        return {
            selectedCity: '',
            showcities: false,
        }
    },
    created(){
        this.selectedCity = this.getLocalStorage();
    },
    methods:{
        showcitiesClick(){
            this.showcities = !this.showcities;
        },
        setLocalStorage(index){
            localStorage.setItem('choosencity',JSON.stringify({'key':index,'name':this.data[index]}));
        },
        getLocalStorage(){
            if(!localStorage.getItem('choosencity')){
                this.setLocalStorage('C');
            }
            return JSON.parse(localStorage.getItem('choosencity')).key;
        },
        changeCity(index){
            this.selectedCity = index;
            this.setLocalStorage(index);
            this.$emit('changeCity',{'index':index});
        },
        hidepopup(){
            this.showcities = false;
        }

    }

}
</script>


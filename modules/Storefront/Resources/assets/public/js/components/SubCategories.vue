<template>
    <li class="nav-item flex-row-center-center">
        <a  class="nav-link menu-item" v-html="name"
            @click="getProductsByCatId">
        </a>
    </li>
</template>

<script>

export default {
    props: ['item','index'],
    computed: {
        name(){
            return this.item.name;
        },
        id(){
          return this.item.id;
        },

    },
    methods: {
        getProductsByCatId(){
            this.$emit("get-products-by-cat-id",this.index);
        }
    }
}

</script>


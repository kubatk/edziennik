<template>
    <Footer></Footer>
</template>

<script>
// import HelloWorld from "../Headmaster/HelloWorld.vue";
import Footer from "@/components/Footer.vue";

export default {
    name: 'App_H',
    data() {
        return {
            parentValue: 'menu',
        }
    },
    components: {
        Footer,
    },
    methods: {
        changeParentValue(newValue) {
            this.parentValue = newValue;
        },
    },
}
</script>

<style>
#headmaster_app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}
</style>

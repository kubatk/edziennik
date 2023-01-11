<template>
    <div v-on:click="parentValue='menu'" class="navbarH"><span style="color: #E38F10;line-height: 1;">E</span>DZIENNIK</div>
    <div v-if="parentValue==='menu'">
        <HelloWorld v-bind:value="parentValue" v-on:update:value="changeParentValue"></HelloWorld>
    </div>
    <Footer></Footer>
</template>

<script>
import HelloWorld from "../Headmaster/HelloWorld.vue";
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
        HelloWorld
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
    margin-top: 10px;

}

.navbarH
{
    position: absolute;
    width: 249px;
    height: 41px;
    left: 35px;
    top: 25px;

    font-family: 'Arial',serif;
    font-style: normal;
    font-weight: 400;
    font-size: 40px;
    line-height: 55px;
    color: #2c3e50;


}

.navbarH:hover
{
    cursor: pointer;
}
</style>

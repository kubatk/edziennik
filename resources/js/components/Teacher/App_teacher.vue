<template>
    <div v-on:click="parentValue='menu'" class="navbarT"><span style="color: #E38F10;line-height: 1;">E</span>DZIENNIK</div>
    <div v-if="parentValue==='menu'">
        <HelloWorld v-bind:value="parentValue" v-on:update:value="changeParentValue"></HelloWorld>
    </div>
    <div v-else-if="parentValue==='oceny'">
        <OcenyPage></OcenyPage>
    </div>
    <div v-else-if="parentValue==='sprawdziany'">
        <SprawdzianyPage></SprawdzianyPage>
    </div>
    <div v-else-if="parentValue==='plan'">
        <PlanZajecPage></PlanZajecPage>
    </div>
</template>

<script>
import HelloWorld from "../Teacher/HelloWorld.vue";
import OcenyPage from "../Teacher/OcenyPage.vue";
import SprawdzianyPage from "../Teacher/SprawdzianyPage.vue";
import PlanZajecPage from "../Teacher/PlanZajecPage.vue";

export default {
    name: 'App_T',
    data() {
        return {
            parentValue: 'menu',
        }
    },
    components: {
        PlanZajecPage,
        SprawdzianyPage,
        OcenyPage,
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
#teacher_app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 10px;

}

.navbarT
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

.navbarT:hover
{
    cursor: pointer;
}
</style>

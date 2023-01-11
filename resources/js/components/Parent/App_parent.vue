<template>
    <div v-on:click="parentValue='menu'" class="navbarP"><span style="color: #E38F10">E</span>DZIENNIK</div>
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
    <div v-else-if="parentValue==='komunikator'">
        <KomunikatorPage></KomunikatorPage>
    </div>
    <div v-else-if="parentValue==='usprawiedliwienia'">
        <UsprawiedliwieniaPage></UsprawiedliwieniaPage>
    </div>
    <Footer></Footer>
</template>

<script>
import HelloWorld from "../Parent/HelloWorld.vue";
import OcenyPage from "../Student/OcenyPage.vue";
import SprawdzianyPage from "../Student/SprawdzianyPage.vue";
import PlanZajecPage from "../Student/PlanZajecPage.vue";
import KomunikatorPage from "../Student/KomunikatorPage.vue";
import AktualnosciPage from "../Student/UdostepnionePlikiPage.vue";
import Footer from "@/components/Footer.vue";
import UsprawiedliwieniaPage from "@/components/Parent/UsprawiedliwieniaPage.vue";

export default {
    name: 'App_P',
    data() {
        return {
            parentValue: 'menu',
        }
    },
    components: {
        UsprawiedliwieniaPage,
        Footer,
        PlanZajecPage,
        SprawdzianyPage,
        OcenyPage,
        HelloWorld,
        KomunikatorPage,
        AktualnosciPage,
    },
    methods: {
        changeParentValue(newValue) {
            this.parentValue = newValue;
        },
    },
}
</script>

<style>
#parent_app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 10px;

}

.navbarP
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
.navbarP:hover
{
    cursor: pointer;
}
</style>

<template>
    <div class="contener">
        <div class="News">
            <div class="name"> AKTUALNOŚCI </div>
            <div class="line"></div>
            <div class="single_new">
                W dniu 21.02.2023 za zastępstwo za Panią Kasię zajęcia odbędą się z Panem Dyrektorem
            </div>
            <div class="single_new">
                W dniu 22.02.2023 zajęcia odwołane
            </div>
        </div>

        <div class="columns">
            <button v-on:click="changeValue(value1)" class="column"><img src="../assets/clipboard2-check.svg"><br>OBECNOŚĆ</button>
            <button v-on:click="changeValue(value2)" class="column"><img src="../assets/journal-bookmark-fill.svg"><br>DODAJ SPRAWDZIAN</button>
            <button v-on:click="changeValue(value3)" class="column"><img src="../assets/trophy.svg"><br>OCENY</button>
        </div>
        <div class="columns">
            <button v-on:click="changeValue(value4)" class="column"><img src="../assets/calendar2-week.svg"><br>PLAN ZAJĘĆ</button>
            <button v-on:click="changeValue(value5)" class="column"><img src="../assets/envelope-at.svg"><br>KOMUNIKATOR</button>
            <button v-on:click="changeValue(value5)" class="column"><img src="../assets/folder.svg"><br>UDOSTĘPNIJ PLIKI</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "HelloWorld",
    data() {
        return {
            value1: 'ocecność',
            value2: 'sprawdziany',
            value3: 'oceny',
            value4: 'plan',
            value5: 'komunikator',
            value6: 'udostepnione',
        }
    },
    methods: {
        changeValue(test) {
            this.$emit('update:value', test);
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
.contener{
    background: url("../assets/nav_back.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
    min-height: 80vh;
    padding: 40px;
    justify-content: center;
}
.columns {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    padding: 0 100px 0 100px;
}
.News{
    text-align: left;
    background: white;
    border-radius: 5px;
    min-height: 200px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 500;
    font-size: 26px;
    line-height: 58px;
    color: #1B2647;
    border: none;
    padding-bottom: 20px;

}
.line{
    border: 2px solid #E38F10;
    background-color: #E38F10;
    margin: 0 0 10px 35px;
    width: 150px;
}
.name{
    margin-left: 35px;
}
.column {
    width: 25%;
    background: #D9D9D9;
    border-radius: 21px;
    margin: 20px;
    height: 200px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 500;
    font-size: 26px;
    line-height: 58px;
    color: #1B2647;
    border: none;
}
.column:hover {
    opacity: 0.7;
    cursor: pointer;
}
.single_new{
    background: #D9D9D9;
    border-radius: 5px;
    margin: 20px;
    min-height: 50px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 30px;
    color: #1B2647;
    padding-left: 20px;
    text-align: left;
}
</style>

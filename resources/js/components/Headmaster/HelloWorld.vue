<template>
    <div class="contener">
        <div class="columns">
            <button v-on:click="changeValue(value1)" class="column"><img src="../assets/trophy.svg"><br>OCENY</button>
            <button v-on:click="changeValue(value2)" class="column"><img src="../assets/clipboard2-check.svg"><br>SPRAWDZIANY</button>
            <button v-on:click="changeValue(value3)" class="column"><img src="../assets/calendar2-week.svg"><br>PLAN ZAJĘĆ</button>
        </div>
        <div class="columns">
            <button class="column"><img src="../assets/calendar2-week.svg"><br>KOMUNIKATOR</button>
            <button class="column"><img src="../assets/pin-angle.svg"><br>AKTUALNOŚĆI</button>
            <button class="column"><img src="../assets/folder.svg"><br>UDOSTĘPNIONE PLIKI</button>
        </div>
        <div class="columns">
            <button class="column"><img src="../assets/calendar2-week.svg"><br>KOMUNIKATOR</button>
            <button class="column"><img src="../assets/pin-angle.svg"><br>AKTUALNOŚĆI</button>
            <button class="column"><img src="../assets/folder.svg"><br>UDOSTĘPNIONE PLIKI</button>
        </div>
        <div class="columns">
            <button class="column"><img src="../assets/calendar2-week.svg"><br>KOMUNIKATOR</button>
            <button class="column"><img src="../assets/pin-angle.svg"><br>AKTUALNOŚĆI</button>
            <button class="column"><img src="../assets/folder.svg"><br>UDOSTĘPNIONE PLIKI</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "HelloWorld",
    data() {
        return {
            value1: 'oceny',
            value2: 'sprawdziany',
            value3: 'plan',
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
    min-height: 90vh;
    padding-bottom: 40px;
}
.columns {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    padding: 0 100px 0 100px;
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
</style>

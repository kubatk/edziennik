<template>
    <div class="contener">
        <div class="name"> OCENY </div>
        <div class="line"></div>
        <div class="window">
            <div class="table">
                <div class="Subject">
                    PRZEDMIOT
                </div>
                <div class="Grades" style="background: #1B2647">
                    OCENY
                </div>
            </div>

            <div v-for="(item, index) in items" :key="index">
                <div class="Subject">{{ item.text }} :
                </div>
                <div class="Grades">
                    <span v-for="grade in item.grades" :key="grade">{{ grade }}, </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OcenyPage",
    data() {
        return {
            items: [
                { text: 'FIZYKA', grades: [5, 3, 5, 3, 3] },
                { text: 'INFORMATYKA', grades: [2, 4, 3, 4, 5] },
                { text: 'MATEMATYKA', grades: [3, 5, 5, 4, 4] },
            ],
        };
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
.name{
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 400;
    font-size: 96px;
    line-height: 131px;
    text-align: left;
    margin-left: 40px;

    color: #D9D9D9;
}
.line{
    border: 2px solid #E38F10;
    background-color: #E38F10;
    margin: 0 0 50px 50px;
    width: 150px;
}
.window
{
    margin: 30px;
    border-radius: 21px;
    background: #D9D9D9;
    padding: 30px 0 50px 0;
    min-height: 500px;
}
.table{
}
.Subject
{
    display: inline-block;
    margin: 5px 10px 5px 20px;
    background: #1B2647;
    padding: 5px 5px 5px 30px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: #FFFFFF;
    text-align: left;
    width: 15vw;
}
.Grades{
    display: inline-block;
    width: 75vw;
    margin: 5px 20px 5px 10px;
    background: #69707b;
    padding: 5px 5px 5px 30px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: #FFFFFF;
    text-align: left;
}


</style>

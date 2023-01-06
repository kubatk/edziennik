<template>
    <div class="contener">
        <div class="name"> OCENY </div>
        <div class="line"></div>
        <div class="window">
            <div v-for="(item, index) in items" :key="index">
                <div class="Subject" v-bind:textContent="item.text"></div>
                <div v-for="(item, index) in marks" :key="index">
                    <div class="Mark" v-bind:textContent="item.text"></div>
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
                { text: 'FIZYKA' },
                { text: 'INFORMATYKA' },
                { text: 'MATEMATYKA' },
            ],
            marks: [
                { text: '5.0' },
                { text: '4.5' },
            ],
        };
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
.contener{
    background: url("../assets/nav_back.jpg");
    background-size: 100%;
    background-repeat: no-repeat;
    min-height: 95vh;
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
}
.Subject
{
    margin: 30px;
    background: #A65353;
    padding: 5px 5px 5px 30px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: #FFFFFF;
    text-align: left;
}
.Mark
{
    background: #AE8383;
    margin: 30px;
    height: 40px;

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

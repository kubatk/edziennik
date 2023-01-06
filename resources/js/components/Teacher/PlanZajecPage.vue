<template>
    <div class="contener">
        <div class="name"> PLAN ZAJĘĆ </div>
        <div class="line"></div>
        <div class="window">

        </div>
    </div>
</template>

<script>
export default {
    name: "PlanZajecPage",
    computed: {
        currentMonth() {
            return getMonthName(this.currentDate.getMonth())
        },
    }
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
    height: 500px;
}


</style>

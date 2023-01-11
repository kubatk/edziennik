<template>
    <div class="contener">
        <div class="name"> SPRAWDZIANY </div>
        <div class="line"></div>
        <div class="window">
            <template v-if="exams.length > 0">
                <div>
                    <div>
                        <div class="column_name" style="width: 20%;">Przedmiot</div>
                        <div class="column_name" style="width: 15%;">Data</div>
                        <div class="column_name" style="width: 55%;">Temat</div>
                    </div>
                    <div v-for="exam in exams" :key="exam.date" style="margin-left: 10px" >
                        <div class="contents"  style="width: calc(20% + 23px);">{{ exam.subject }}</div>
                        <div  class="contents" style="width: calc(15% + 23px);">{{ exam.date }}</div>
                        <div class="contents" style="width: calc(55% + 23px);">{{ exam.theme }}</div>
                    </div>
                </div>
            </template>
            <template v-else>
                <p>Brak zapowiedzianych sprawdzianów</p>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ExamsPage',
    data() {
        return {
            exams: []
        }
    },
    created() {
        this.fetchExams();
    },
    methods: {
        async fetchExams() {
            try {
                this.exams = [
                    { "date": "2022-05-01", "subject": "Matematyka", "theme": "Kąty i figury" },
                    { "date": "2022-05-03", "subject": "Język angielski", "theme": "Unit 6" },
                    { "date": "2022-05-07", "subject": "Historia", "theme": "II wojna światowa" }
                ];
            } catch (error) {
                console.error(error);
            }
        }
    }
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
    height: 500px;
}
.column_name{
    background: #1B2647;
    padding: 5px 5px 5px 30px;
    margin: 5px 10px 5px 20px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: #FFFFFF;
    text-align: left;
    display: inline-block;

}
.contents{
    margin: 5px 0 5px 0;
    background: #9dabb9;
    padding: 10px 5px 10px 30px;
    font-family: 'Inter',serif;
    font-style: normal;
    font-weight: 700;
    font-size: 24px;
    line-height: 29px;
    color: black;
    text-align: left;
    display: inline-block;
}

</style>

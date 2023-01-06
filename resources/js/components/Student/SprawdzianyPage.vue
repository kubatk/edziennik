<template>
    <div class="contener">
        <div class="name"> SPRAWDZIANY </div>
        <div class="line"></div>
        <div class="window">
            <template v-if="exams.length > 0">
                <table class="table">
                    <tr>
                        <th>Data</th>
                        <th>Przedmiot</th>
                    </tr>
                    <tr v-for="exam in exams" :key="exam.date">
                        <td>{{ exam.date }}</td>
                        <td>{{ exam.subject }}</td>
                    </tr>
                </table>
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
                const response = await axios.get('/exams.txt');
                this.exams = response.data;
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
.test
{
    height: 400px;
    color: #1E1E1E;
}
</style>

<template>
    <div class="contener">
        <div class="name"> PLAN ZAJĘĆ </div>
        <div class="line"></div>
        <div class="window">
            <div class="class_name">
                Klasa: {{ classa }}
            </div>
            <table class="table">
                <tr>
                    <th class="first">Godzina</th>
                    <th class="first">Poniedziałek</th>
                    <th class="first">Wtorek</th>
                    <th class="first">Środa</th>
                    <th class="first">Czwartek</th>
                    <th class="first">Piątek</th>
                </tr>
                <tr v-for="lesson in lessons" :key="lesson.time">
                    <td>{{ lesson.time }}</td>
                    <td>{{ lesson.monday }}</td>
                    <td>{{ lesson.tuesday }}</td>
                    <td>{{ lesson.wednesday }}</td>
                    <td>{{ lesson.thursday }}</td>
                    <td>{{ lesson.friday }}</td>
                </tr>
            </table>
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
    },
    data() {
        return {
            classa: '4C',
            lessons: [
                {    "time": "8:00",    "monday": "Język angielski",    "tuesday": "Matematyka",    "wednesday": "",    "thursday": "Matematyka",    "friday": "Historia"  },  {    "time": "9:00",    "monday": "Matematyka",    "tuesday": "Historia",    "wednesday": "Matematyka",    "thursday": "Historia",    "friday": "Język angielski"  },  {    "time": "10:00",    "monday": "Historia",    "tuesday": "Język angielski",    "wednesday": "Historia",    "thursday": "Język angielski",    "friday": "Matematyka"  }
            ]
        };
    },
    created() {
        this.fetchLessons();
    },
    methods: {
        async fetchLessons() {
            try {
                const response = await axios.get('lessons.txt');
                this.lessons = response.data;
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
.class_name
{
    font-size: 30px;
    text-align: left;
    margin: 15px 0 5px 30px

}
.table{
    justify-content: space-around;
}
.first{
    font-size: 20px;
    background: #1B2647;
    color: white;

}
</style>

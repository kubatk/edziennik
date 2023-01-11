<template>
    <div class="footer">
        <div class="logo"> <span style="color: #E38F10">E</span>Dziennik </div>
        <div> Kontakt: <br> tel:123 123 123 <br> mail: EDziennik@Mail.pl </div>
        <div> Adress: <br> Rzeszów, <br> ul.Rodowicza 30  </div>
        <div> Stworzone przez <br> TaniaFirma.com  </div>

    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>
.footer
{
    width: 100%;
    background: #D9D9D9;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    text-align: left;
    padding: 20px 100px 20px 100px;
}
.logo
{
    font-style: normal;
    font-weight: 400;
    font-size: 40px;
    line-height: 55px;
    color: #1E1E1E;
}
</style>

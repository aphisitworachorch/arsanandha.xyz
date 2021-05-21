<template>
    <div>
        <div class="grid grid-flow-col grid-cols-3 auto-cols-max md:auto-cols-min">
            <kinesis-container :active="true">
                <kinesis-element :strength="0.75" type="scale">
                    <img :src="photolink" class="col-span-1" alt="photo" v-bind:style="{ objectFit: 'cover', width:'300px',height:'400px' }"/>
                </kinesis-element>
            </kinesis-container>
            <div class="col-span-2" style="margin-top: 10%;margin-bottom: 10%">
                <img :src="imgX" v-bind:style="{ width: '50%'}"/>
                <h2 style="text-align: left">{{ word }}</h2>
                <h5 style="text-align: left">" {{ role }} "</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ActivityPhoto",
    props:['photolink','word','role'],
    data: () => {
        return {
            imgX: require('../../../../img/ARSANANDHA-AE-LOGO-02.png').default
        }
    }
}
</script>

<style lang="sass" scoped>
body
    font-family: 'Poppins', sans-serif

h1, h2, h3, h4, h5, p
    font-family: 'Poppins', sans-serif

.center
    text-align: center
</style>

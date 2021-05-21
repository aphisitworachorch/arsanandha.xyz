<template>
    <div>
        <div>
            <kinesis-container :active="true">
                <kinesis-element :strength="0.75" type="scale">
                    <img :src="photolink" class="col-span-1" alt="photo" v-bind:style="{ objectFit: 'cover'}"/>
                </kinesis-element>
            </kinesis-container>
        </div>
        <div>
            <div style="margin-top: 10%;margin-bottom: 10%">
                <img :src="imgX" v-bind:style="{ width: '50%'}"/>
                <h3 style="text-align: left">{{ word }}</h3>
                <h5 style="text-align: left">" {{ role }} "</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ActivityPhotoMobile",
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

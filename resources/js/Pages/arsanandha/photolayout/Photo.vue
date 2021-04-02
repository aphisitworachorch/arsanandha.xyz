<template>
    <div>
        <div class="grid grid-flow-col grid-cols-3 auto-cols-max md:auto-cols-min">
            <img :src="photolink" class="col-span-1" alt="photo" v-bind:style="{ objectFit: 'cover', width:'300px',height:'400px' }"/>
            <div class="col-span-2" style="margin-top: 10%;margin-bottom: 10%">
                <img :src="imgX" v-bind:style="{ width: '50%'}"/>
                <h3 style="text-align: left">" {{ verse }} "</h3>
                <p style="text-align: left">{{ references }}</p>
                <img :src="unsplash" v-bind:style="{ width: '20%'}"/>
                <p style="text-align: left">Photo by : (C) {{ infoUnsplash }} / UNSPLASH : {{ infoUnsplashUsername }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Photo",
    props:['photolink','verse','references','infoUnsplash','infoUnsplashUsername'],
    data: () => {
        return {
            imgX: require('../../../../img/ARSANANDHA-AE-LOGO-02.png'),
            unsplash: require('../../../../img/Unsplash_Logo_Full-02.png')
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

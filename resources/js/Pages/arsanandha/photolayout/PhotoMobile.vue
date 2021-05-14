<template>
    <div>
        <div>
            <img :src="photolink" class="col-span-1" alt="photo" v-bind:style="{ objectFit: 'cover'}"/>
        </div>
        <div>
            <div style="margin-top: 10%;margin-bottom: 10%">
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
    name: "PhotoMobile",
    props:['photolink','verse','references','infoUnsplash','infoUnsplashUsername'],
    data: () => {
        return {
            imgX: require('../../../../img/ARSANANDHA-AE-LOGO-02.png').default,
            unsplash: require('../../../../img/Unsplash_Logo_Full-02.png').default
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

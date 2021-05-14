<template>
    <div>
        <div style="text-align: center">
            <iframe :src="imgX"/>
            <div style="text-align: center">
                <h2>Welcome to 24Batch Page</h2>
                <iframe :src="bigLogo"/>
                <div>
                    <h3>Status : {{ stat }}</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IndexTwentyFour",
        metaInfo:{
            title:"24Batch"
        },
        data: () => {
            return{
                imgX: require('../../../../img/weblogo-02.svg').default,
                bigLogo: require('../../../../img/SetupLogo-01.svg').default,
                stat: "In Development Stage"
            }
        }
    }
</script>

<style scoped>
    iframe {
        height: 50%
    }
</style>

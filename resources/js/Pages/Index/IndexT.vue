<template>
    <app-layout>
        <div>
            <div class="uk-container uk-padding-large uk-text-center">
                <kinesis-container :active="true">
                    <kinesis-element :strength="5" type="depth">
                        <img :src="myself" class="uk-align-center">
                    </kinesis-element>
                    <div>
                        {{ verse }} <br/> {{ ref }}
                    </div>
                </kinesis-container>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/Main";
    export default {
        name: "IndexT",
        metaInfo:{
            title:"ARSANANDHA"
        },
        props:['verse','ref'],
        data: () => {
            return{
                myself: "https://avatars.githubusercontent.com/aphisitworachorch"
            }
        },
        components:{
            AppLayout
        }
    }
</script>

<style lang="sass" scoped>
    @import url('https://fonts.googleapis.com/css?family=K2D&display=swap&subset=thai')

    body
        font-family: 'K2D', sans-serif

    h1, h2, h3, h4, h5, p
        font-family: 'K2D', sans-serif

    .center
        text-align: center
</style>

<template>
    <div>
        <transition appear enter-active-class="animate__animated animate__fadeInDown" leave-active-class="animate__animated animate__fadeOutUp" mode="in-out">
            <fixed-header @change="updateFixedStatus" :threshold="propsData.threshold" :headerClass="propsData.headerClass" :fixedClass="propsData.fixedClass" :hideScrollUp="propsData.hideScrollUp">
                <!-- v-bind:style="{ backgroundColor: getColor() }"  !-->
                <vk-navbar v-bind:style="{ background: convertHex(getColor()) }" class="nav glass" >
                    <vk-navbar-logo slot="center">
<!--                            <div>-->
<!--                                <img v-if="show" :src="imgX" alt="ARSANANDHA" style="min-width:350px;!important;height:60px;!important;"/>-->
<!--                            </div>-->
                            <div>
                                <img v-if="show" :src="myself" alt="ARSANANDHA" style="height:60px;!important;border-radius:100%;" class="circular"/>
                            </div>
                    </vk-navbar-logo>
                </vk-navbar>
            </fixed-header>
        </transition>
        <div class="uk-container" v-bind:class="{ headerIsFixed: fixedStatus.headerIsFixed }">
            <slot></slot>
        </div>
        <br/>
    </div>
</template>

<script>
import FixedHeader from 'vue-fixed-header'

const createData = () => ({
        threshold: 0,
        headerClass: "vue-fixed-header",
        fixedClass: "vue-fixed-header--isFixed",
        hideScrollUp: false
    });
    export default {
        name: "Main",
        data: () => {
            return {
                imgX: require('../../img/ATTTT-01.png').default,
                colorOfDay : [
                    "#c9242b",
                    "#dba73b",
                    "#f27091",
                    "#278766",
                    "#f25821",
                    "#5aaebd",
                    "#695095"],
                fixedStatus: {
                    headerIsFixed: false
                },
                propsData: { ...createData() },
                formData: { ...createData() },
                show: true,
                variableshow: false,
                opacity: 65,
                myself: "https://avatars.githubusercontent.com/aphisitworachorch"
            }
        },
        components:{
            FixedHeader
        },
        methods:{
            updateFixedStatus(next) {
                this.fixedStatus.headerIsFixed = next;
            },
            getColor(){
                return this.colorOfDay[((new Date()).getDay())];
            },
            convertHex: function (color) {
                color = color.replace('#', '')
                let r = parseInt(color.substring(0, 2), 16)
                let g = parseInt(color.substring(2, 4), 16)
                let b = parseInt(color.substring(4, 6), 16)
                return 'rgba(' + r + ',' + g + ',' + b + ',' + this.opacity / 100 + ')'
            }
        }
    }
</script>

<style lang="sass" scoped>
    @import url('https://fonts.googleapis.com/css?family=K2D&display=swap&subset=thai')
    @import "~animate.css/animate.css"

    .uk-navbar
        display: flex
        width: 100vw
        margin: 0
        padding: 0

    .uk-navbar.vue-fixed-header--isFixed
        position: fixed
        left: 0
        top: 0
        z-index: 1000

    .uk-container.headerIsFixed
        transform: translateY(56px) !important

    .glass
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 )
        backdrop-filter: blur( 10px )
        -webkit-backdrop-filter: blur( 10px )
        border: 1px solid rgba( 255, 255, 255, 0.18 )

    @keyframes squareToCircle
        from
            border-radius : 0
            -webkit-filter: grayscale(100%)
            filter: grayscale(100%)
        to
            border-radius : 100%
            -webkit-filter: grayscale(0%)
            filter: grayscale(0%)

    .circular
        -webkit-animation: ease-out squareToCircle 1.75s both
        -moz-animation: ease-out squareToCircle 1.75s both
        animation: ease-out squareToCircle 1.75s both
</style>

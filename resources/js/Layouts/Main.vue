<template>
    <div>
        <fixed-header @change="updateFixedStatus" :threshold="propsData.threshold" :headerClass="propsData.headerClass" :fixedClass="propsData.fixedClass" :hideScrollUp="propsData.hideScrollUp">
            <vk-navbar v-bind:style="{ backgroundColor: colorOfDay }" class="nav" >
                <vk-navbar-logo slot="center">
                    <transition appear enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeIn" mode="in-out">
                        <div @click="variableshow = !variableshow">
                            <img v-if="show" :src="imgX" alt="ARSANANDHA" v-bind:style="{ height: '80px'}"/>
                        </div>
                    </transition>
                </vk-navbar-logo>
                <vk-navbar-item>
                    <vk-offcanvas-content>
                        <vk-offcanvas  overlay mode="reveal" :show.sync="variableshow">
                            <vk-offcanvas-close @click="variableshow = false" v-bind:style="{ color: colorOfDay }" ></vk-offcanvas-close>
                            <p v-bind:style="{ color: colorOfDay }" >
                                Hi ! I'm ARSANANDHA+
                            </p>
                        </vk-offcanvas>
                    </vk-offcanvas-content>
                </vk-navbar-item>
            </vk-navbar>
        </fixed-header>
        <div class="uk-container" v-bind:class="{ headerIsFixed: fixedStatus.headerIsFixed }">
            <slot></slot>
        </div>
        <br/>
        <footer style="text-align: center;">(C) Asanan Aphisitworachorch</footer>
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
                imgX: require('../../img/ATTTT-01.png'),
                colorOfDay : "#004580",
                fixedStatus: {
                    headerIsFixed: false
                },
                propsData: { ...createData() },
                formData: { ...createData() },
                show: true,
                variableshow: false
            }
        },
        components:{
            FixedHeader
        },
        methods:{
            updateFixedStatus(next) {
                this.fixedStatus.headerIsFixed = next;
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

</style>

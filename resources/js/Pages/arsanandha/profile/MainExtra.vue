<template>
    <app-layout>
        <div class="uk-container uk-align-center">
            <kinesis-container :active="true">
                <vk-grid>
                    <kinesis-element :strength="5" type="depth">
                        <div>
                            <img :src="headImage.ktk" style="height:130px;object-fit: cover"/>
                        </div>
                        <vk-card>
                            <vk-card-title>
                                Katakorn SUT
                            </vk-card-title>
                            <p v-if="details.katakorn" class="animate__fadeInUp">Katakorn of <br/>Suranaree University
                                <br/>of Technology</p>
                        </vk-card>
                    </kinesis-element>
                    <kinesis-element :strength="5" type="depth">
                        <div>
                            <img :src="headImage.s7" style="height:130px;object-fit: cover"/>
                        </div>
                        <vk-card>
                            <vk-card-title>
                                Suranivet 7
                            </vk-card-title>
                            <p v-if="details.sura7">Suranivet 7</p>
                        </vk-card>
                    </kinesis-element>
                    <kinesis-element :strength="5" type="depth">
                        <div>
                            <img :src="headImage.sutsc" style="height:130px;object-fit: cover"/>
                        </div>
                        <vk-card>
                            <vk-card-title>
                                SUTSC
                            </vk-card-title>
                            <p v-if="details.scsut">Student Council of <br/>Suranaree University <br/>of Technology</p>
                        </vk-card>
                    </kinesis-element>
                </vk-grid>
            </kinesis-container>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/Main";

export default {
    name: "MainExtra",
    metaInfo: {
        title: "About"
    },
    components: {AppLayout},
    data: () => {
        return {
            headImage: {
                ktk: require('../../../../img/headline/sutkatakorn.png'),
                s7: require('../../../../img/headline/S7.png'),
                sutsc: require('../../../../img/headline/SCSUT.png'),
            },
            details: {
                scsut: "",
                sura7: "",
                katakorn: ""
            }
        }
    }
}
</script>

<style lang="sass" scoped>
@import "resources/sass/app"
@import "~animate-sass/animate"
</style>

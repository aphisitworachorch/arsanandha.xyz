<template>
    <app-layout>
        <div>
            <div v-if="message" v-for="messages in message" class="uk-container uk-padding-small">
                <fieldset class="uk-fieldset">
                    <vk-card v-bind:style="{ backgroundColor:getColor(messages.have_faculty.department_id),color:'white' }">
                        <vk-card-title>
                            <div class="uk-margin">
                                <h2 style="color:white">🌟 Thank You Card</h2>
                            </div>
                        </vk-card-title>
                        <div class="uk-margin">
                            <img :src="card" height="100px">
                        </div>
                        <div class="uk-container">
                            <div class="uk-margin">
                                <h2 style="color:white;">ถึง {{ messages.name_surname }}</h2>
                            </div>
                            <br/>
                            <div class="uk-margin">
                                <h3 style="color:white;text-align: justify;">" {{ messages.in_mind }} "</h3>
                            </div>
                            <br/>
                            <div class="uk-margin">
                                <h4 style="color:white;">ขอบคุณที่เข้ามาอ่านนะ {{ messages.name_surname }}</h4>
                            </div>
                        </div>
                    </vk-card>
                </fieldset>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../../Layouts/Main";

export default {
    name: "ThanksCard",
    components: {AppLayout},
    props: ['message'],
    metaInfo: {
        title: "ความในใจผู้ได้รับจดหมายฉบับนี้"
    },
    data: () => {
        return {
            card: require('../../../../../img/card/card.png'),
            depColor:{
                "SOCDEP":'#034EA2',
                "ENGDEP":'#A03522',
                "AGRIDEP":'#00676E',
                "DENTDEP":'#712D7D',
                "MEDDEP":'#D8852A',
                "NURDEP":'#D8852A',
                "PUBDEP":'#DB4140',
                "SCIDEP":'#A03522'
            }
        }
    },
    methods:{
        getColor(color){
            return this.depColor[color];
        }
    }
}
</script>

<style lang="sass" scoped>
</style>

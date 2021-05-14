<template>
    <app-layout>
        <div>
            <div v-if="options" class="uk-container uk-padding-small">
                <fieldset class="uk-fieldset">
                    <vk-card style="background-color:#00676E;color:white">
                        <vk-card-title>
                            <div class="uk-margin">
                                <h2 style="color:white">🌟 Thank You Card</h2>
                            </div>
                        </vk-card-title>
                        <div class="uk-margin">
                            <img :src="card" height="100px">
                        </div>
                        <form>
                            <div class="uk-margin">
                                <label for="name_surname">ชื่อจริง (ภาษาอังกฤษ)</label>
                                <input type="text" v-model="form.name_surname" class="uk-input"
                                       @input="form.name_surname = $event.target.value.toUpperCase()"/>
                            </div>
                            <div class="uk-margin">
                                <label for="faculty_id">สาขาวิชา / ภาคส่วน</label>
                                <select class="uk-select" v-model="form.faculty_id">
                                    <option v-for="option in options" v-bind:value="option.value">
                                        {{ option.text }}
                                    </option>
                                    <option value="other">อื่นๆ</option>
                                </select>
                            </div>
                            <br/>
                            <div class="uk-container">
                                <label>มีอะไรจะฝากบอกไหม (ถ้าไม่มีเว้นแล้วข้ามได้เลย) (ใส่ Contacts
                                    ไว้ด้านหลังนะครับ)</label>
                                <textarea class="uk-textarea" v-model="form.message_to"></textarea>
                            </div>
                            <br/>
                            <div class="uk-container">
                                <div class="uk-button uk-button-primary" @click="sendMessage(form)">
                                    ส่งข้อความ
                                </div>
                            </div>
                        </form>
                    </vk-card>
                </fieldset>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../Layouts/Main";

export default {
    name: "ThanksCard",
    components: {AppLayout},
    props: ['options'],
    data: () => {
        return {
            form: {
                name_surname: "",
                faculty_id: "",
                message_to: ""
            },
            card: require('../../../../img/card/card.png').default
        }
    },
    methods: {
        sendMessage(data) {
            if(data.name_surname.length < 1){
                this.$swal({
                    title: "แจ้งเตือน",
                    html: "ไม่ได้กรอกชื่อ",
                    icon: "error"
                })
            }
            if(data.faculty_id.length < 1){
                this.$swal({
                    title: "แจ้งเตือน",
                    html: "ไม่ได้เลือกสาขาวิชา",
                    icon: "error"
                })
            }
            this.$inertia.post('/thankful', data);
        }
    }
}
</script>

<style lang="sass" scoped>
</style>

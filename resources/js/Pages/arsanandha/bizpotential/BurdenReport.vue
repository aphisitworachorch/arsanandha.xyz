<template>
    <app-layout>
        <div>
            <div class="uk-container">
                <fieldset class="uk-fieldset">
                    <div class="uk-margin">
                        <h2>กรอกภาระงานประจำวันที่ {{ today }}</h2>
                    </div>
                    <form>
                        <div class="uk-margin">
                            <label for="bizpotential_id">ชื่อย่อ สองหลัก</label>
                            <input type="text" :maxlength="2" class="uk-input"
                                   v-model="bizpotential_id"
                                   @input="bizpotential_id = $event.target.value.toUpperCase()"/>
                        </div>
                        <div class="uk-margin">
                            <label for="bizpotential_project">โปรเจกต์ที่รับผิดชอบ (ภาษาอังกฤษใน BSF.xyz)
                                เท่านั้น</label>
                            <input type="text" class="uk-input"
                                   v-model="bizpotential_project"
                                   @input="bizpotential_project = $event.target.value.toUpperCase().split(' ').join('_')"/>
                        </div>
                        <div class="uk-container">
                            <div v-for="burden in burdens">
                                <vk-grid>
                                    <div>
                                        <label>ประเภทงาน</label>
                                        <select class="uk-select" v-model="burden.burdenType" type="text">
                                            <option value="เพิ่ม">เพิ่ม ➕</option>
                                            <option value="ลด">ลด ➖</option>
                                            <option value="แก้ไข">แก้ไข ✍</option>
                                            <option value="ตรวจสอบ">ตรวจสอบ 🏁</option>
                                            <option value="เข้าประชุม">เข้าประชุม 🤝</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label>ภาระงาน</label>
                                        <input class="uk-input uk-form-controls-text" v-model="burden.nameBurden"
                                               type="text"/>
                                    </div>
                                    <div>
                                        <label>สถานะ</label>
                                        <select class="uk-select" v-model="burden.burdenStatus" type="text">
                                            <option value="สำเร็จ">สำเร็จ ✅</option>
                                            <option value="อยู่ระหว่างการดำเนินการ">อยู่ระหว่างการดำเนินการ ⌚</option>
                                        </select>
                                    </div>

                                </vk-grid>
                            </div>
                            <br/>
                            <div class="uk-button uk-button-danger" @click="addBurden">เพิ่มภาระ</div>
                        </div>
                        <br/>
                        <div class="uk-container">
                            <div class="uk-button uk-button-primary" @click="makeBurdenText"
                                 v-clipboard:copy="textBurden">
                                สร้าง Text ส่งในไลน์
                            </div>
                        </div>
                        <br/>
                        <div class="uk-container">
                            <label>ตัวอย่าง Text ส่งในไลน์</label>
                            <textarea class="uk-textarea" v-model="textBurden"></textarea>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </app-layout>
</template>

<script>
import moment from "moment";
import AppLayout from "../../../Layouts/Main";

moment.locale('th');
let todayData = moment(new Date());
export default {
    name: "BurdenReport",
    metaInfo: {
        title: "Burden Report"
    },
    components: {
        AppLayout
    },
    data: () => {
        return {
            today: todayData.format('LLLL'),
            burdens: [{}],
            textBurden: '',
            bizpotential_id: '',
            bizpotential_project: '',
            burdenCompleteText: '',
        }
    },
    methods: {
        addBurden: function () {
            this.burdens.push({
                nameBurden: '',
                burdenStatus: '',
                burdenType: ''
            });
        },
        makeBurdenText: function () {
            this.burdenCompleteText = this.burdens.map(body => '(' + body.burdenType + ')' + " ▶ " + body.nameBurden + " [" + body.burdenStatus + "] \n").join('');
            this.textBurden = this.bizpotential_id + "\n" + "[ โครงการ " + this.bizpotential_project + " ]" + "\n" + this.burdenCompleteText;
            this.$swal({
                title: "แจ้งเตือน",
                html: "สร้างข้อความสำเร็จ <br/>สามารถคัดลอกสำเนานี้ไปยังแอปพลิเคชั่น LINE <br/>เพื่อรายงานต่อทีมได้",
                icon: "success"
            })
        }
    }
}
</script>

<style lang="sass" scoped>
@import url('https://fonts.googleapis.com/css?family=K2D&display=swap&subset=thai')

body
    font-family: 'K2D', sans-serif

h1, h2, h3, h4, h5, p
    font-family: 'K2D', sans-serif
</style>

<template>
    <div class="uk-container">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <h2>ส่งให้โต้ซ่อมคอม 💻📀</h2>
            </div>
            <form>
                <div class="uk-margin">
                    <label for="from">จาก</label>
                    <input type="text" id="from" class="uk-input" v-model="sending_by"/>
                </div>
                <div class="uk-margin">
                    <label for="messageTo">ส่งข้อความถึงโต้ ผู้จะทำการ</label>
                    <input type="text" id="messageTo" class="uk-input" v-model="message_by"/>
                </div>
                <div class="uk-margin">
                    <label for="tel">เบอร์โทรที่ติดต่อได้</label>
                    <input type="text" id="tel" class="uk-input" v-model="telephone_send"/>
                </div>
                <div class="uk-margin">
                    <label for="sy">บอกอาการของคอมพิวเตอร์ที่เป็น / ปัญหาที่เจอ / โปรแกรมที่อยากได้</label>
                    <input type="text" id="sy" class="uk-input" v-model="describe_sy"/>
                </div>
                <div class="uk-margin">
                    <vk-button @click="formSubmit" type="primary">ส่งไปหาโต้</vk-button>
                </div>
            </form>
        </fieldset>
    </div>

</template>

<script>
    export default {
        name: "ComputerQueue",
        metaInfo: {
            title:"Computer Queue"
        },
        methods: {
            async formSubmit(e) {
                const dataV = {
                    msg: this.message_by,
                    sendby: this.sending_by,
                    telephone: this.telephone_send,
                    sy: {
                        describe: this.describe_sy
                    }
                };
                e.preventDefault();
                await this.$http.post('https://us-central1-arsanandha-comqueue.cloudfunctions.net/fs/enqueue', JSON.parse(JSON.stringify(dataV)), {
                    headers: {
                        "Content-Type": "application/json",
                        'Access-Control-Allow-Origin': '*',
                    }
                })
                    .then((response) => {
                        if (response.data.status == "OK") {
                            this.$swal({
                                title: "แจ้งเตือน",
                                text: "ทำรายการสำเร็จ",
                                icon: "success"
                            })
                        } else {
                            this.$swal({
                                title: "แจ้งเตือน",
                                text: "ทำรายการไม่สำเร็จ",
                                icon: "error"
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
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

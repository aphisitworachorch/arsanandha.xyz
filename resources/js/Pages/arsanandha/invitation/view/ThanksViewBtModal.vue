<template>
    <vk-button size="small" type="primary" :class="classes" @click="openModal(data)" title="Update">
        Update Data
    </vk-button>
</template>

<script>
export default {
    name: "ThanksViewBtModal",
    props: {
        data: {},
        name: {},
        click: {
            type: Function,
            default: () => {
            }
        },
        classes: {
            type: Object,
            default: () => ({
                'btn': true,
                'btn-primary': true,
                'btn-sm': true,
            }),
        },
    },
    methods: {
        openModal(body) {
            this.$swal.mixin({
                input: 'textarea',
                confirmButtonText: 'ขั้นตอนถัดไป',
                showCancelButton: true,
                progressSteps: ['1']
            }).queue([
                {
                    title: 'กรอกข้อมูลความในใจ',
                    text: 'สามารถกรอกได้ทุกอย่างเลย'
                }
            ]).then((result) => {
                if (result.value) {
                    const answers = {
                        "id":body.id,
                        "in_mind":result.value[0],
                        "received":"n"
                    }
                    axios.post('/thankful/view/insert', JSON.parse(JSON.stringify(answers)), {
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                        .then((response) => {
                            if (response.data.status == "OK") {
                                this.$swal({
                                    title: "แจ้งเตือน",
                                    text: "ทำรายการสำเร็จ",
                                    icon: "success",
                                    position: 'top-end',
                                    toast: true
                                }).then((result)=>{
                                    if(result){
                                        this.$copyText(window.location.hostname+"/thankful/card/"+response.data.url_id);
                                        window.location.reload();
                                    }
                                });
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
            })
        }
    }
}
</script>

<style scoped>

</style>

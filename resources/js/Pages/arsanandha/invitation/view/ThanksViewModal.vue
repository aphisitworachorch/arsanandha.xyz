<template>
    <vk-button size="small" type="primary" :class="classes" @click="viewData(data)" title="Update">
        View Data
    </vk-button>
</template>

<script>
export default {
    name: "ThanksViewModal",
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
        viewData(data){
            this.$copyText(window.location.hostname+"/thankful/card/"+data.url_id);
            this.$swal.fire({
                icon: 'info',
                title: 'ข้อความ',
                text: data.in_mind,
                footer: `<a href=${"card/"+data.url_id} target="_blank">${"thankful/card/"+data.url_id}</a>`
            })
        }
    }
}
</script>

<style scoped>

</style>

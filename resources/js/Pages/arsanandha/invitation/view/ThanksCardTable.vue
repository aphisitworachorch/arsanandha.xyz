<template>
    <app-layout>
        <div class="uk-container">
            <vk-button @click="generateAllID()" v-bind:style="{ margin: '5px' }">Generate All ID</vk-button>
            <data-table
                :url="url"
                :classes="classes"
                :columns="columns"
                :per-page="perPage">
                <div slot="pagination" slot-scope="{ links = {}, meta = {} }">
                    <nav class="row">
                        <div class="col-md-6 text-left">
                        <span>
                            Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} Entries
                        </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <button
                                :disabled="!links.prev"
                                class="btn btn-primary"
                                @click="url = links.prev">
                                Prev
                            </button>
                            <button
                                :disabled="!links.next"
                                class="btn btn-primary ml-2"
                                @click="url = links.next">
                                Next
                            </button>
                        </div>
                    </nav>
                </div>
            </data-table>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../../../Layouts/Main";
import Btn from "./ThanksViewBtModal";
import ViewBtn from "./ThanksViewModal";
export default {
    name: "ThanksCardTable",
    components: {AppLayout, Btn, ViewBtn},
    data() {
        return {
            url: "/thankful/view/ajax",
            perPage: ['10', '25', '50'],
            columns: [
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Name',
                    name: 'name_surname',
                    orderable: true,
                },
                {
                    label: 'Faculty',
                    name: 'faculty_id',
                    orderable: true,
                },
                {
                    label: 'Message',
                    name: 'message_to',
                    orderable: true,
                },
                {
                    label: 'Received',
                    name: 'received',
                    orderable: true,
                },
                {
                    label: '',
                    name: 'id',
                    orderable: false,
                    classes: {
                        'btn': true,
                        'btn-primary': true,
                        'btn-sm': true,
                    },
                    event: "click",
                    component: ViewBtn,
                },
                {
                    label: '',
                    name: 'id',
                    orderable: false,
                    classes: {
                        'btn': true,
                        'btn-primary': true,
                        'btn-sm': true,
                    },
                    event: "click",
                    component: Btn,
                }
            ],
            classes: {
                'table-container': {
                    'justify-center': true,
                    'w-full': true,
                    'flex': true,
                    'rounded': true,
                    'mb-6': true,
                },
                table: {
                    'text-left': true,
                    'w-full': true,
                    'border-collapse': true,
                    'uk-table': true
                },
                input: {
                    'uk-input': true
                }
            }
        };
    },
    methods: {
        generateAllID() {
            axios.post('/updateURL', {
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then((response) => {
                if (response.data.status === "OK") {
                    this.$swal({
                        title: "แจ้งเตือน",
                        text: "ทำรายการสำเร็จ \n"+response.data.message,
                        icon: "success",
                        position: "top-end",
                        toast: true
                    })
                } else {
                    this.$swal({
                        title: "แจ้งเตือน",
                        text: "ทำรายการไม่สำเร็จ",
                        icon: "error",
                        position: "top-end",
                        toast: true
                    })
                }
            }).catch(function (error) {
                if(error){
                    this.$swal({
                        title: "แจ้งเตือน",
                        text: "ทำรายการไม่สำเร็จ",
                        icon: "error",
                        position: "top-end",
                        toast: true
                    })
                }
            });
        }
    }
}
</script>

<style scoped>
</style>

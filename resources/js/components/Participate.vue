<template>
    <div class="col-lg-12">
        <div class="row">
            <form @submit.prevent="formValidateBeforeSubmit" class="participate-form">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-no-pad">
                        <picture-input
                            ref="pictureInput"
                            @change="onChanged"
                            @remove="onRemoved"
                            @error="error"
                            :crop="true"
                            :removable="true"
                            removeButtonClass="ui red button"
                            accept="image/jpg, image/jpeg, image/png"
                            buttonClass="ui button primary"
                            :zIndex=9800
                            :size=10
                            :alertOnError="false"
                        >
                        </picture-input>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-no-pad">
                        <br>
                        <div class="input-wrapper">
                            <input class="form-input firstName" name="name" type="text" placeholder="Ime" value="milos">
                        </div>
                        <br>
                        <div class="input-wrapper">
                            <input class="form-input lastName" name="lastname" type="text"
                                   placeholder="Prezime" value="medic">
                        </div>
                        <br>
                        <div class="input-wrapper">
                            <input class="form-input email" name="email" type="text" placeholder="Email"
                                   value="milos@test.com">
                        </div>
                        <br>
                        <div class="input-wrapper">
                            <input class="form-input address" name="livingPlace" type="text"
                                   placeholder="Mesto stanovanja" value="agsdyugasdasd">
                        </div>
                        <br>
                        <div class="button-row">
                            <button class="scroll-top-button" id="show-modal">submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <modal v-if="this.modalOpen" @close="showModal">
            <div slot="header">
                <button class="modal-default-button" @click="showModal">X</button>
                <div>{{modalData.type}}</div>
            </div>
            <div slot='body'>
                <span v-html="modalData.msg"></span>
            </div>
            <div slot="footer">
            </div>
        </modal>
    </div>
</template>
<script>
    import PictureInput from 'vue-picture-input'
    import axios from 'axios';

    export default {
        name: 'app',
        components: {
            PictureInput,
            axios
        },
        props: ['firstname', 'lastname', 'email', 'livingplace'],
        data() {
            return {
                modalData: 0,
                modalOpen: false,
                url: '',
                image: '',
                button: 'Upload',
                disable: '',
                baseUrl: baseUrl,
            }
        },
        methods: {
            showModal(msg) {
                this.modalData = msg;
                this.modalOpen = !this.modalOpen;
            },
            onChanged() {
                console.log("New picture loaded");
                if (this.$refs.pictureInput.file) {
                    this.image = this.$refs.pictureInput.file;
                    $(".image-check").removeClass("image-check-show");
                } else {
                    console.log("Old browser. No support for Filereader API");
                }
            },
            onRemoved() {
                this.image = '';
            },
            submitForm() {
                let firstName = $(".firstName").val();
                let lastName = $(".lastName").val();
                let email = $(".email").val();
                let address = $(".address").val();
                let canvas1 = $(".picture-preview");

                this.$parent.$emit('loadImageToCanvas', canvas1[0].toDataURL("image/png"), firstName, lastName, email, address);

                $(".participate-display").hide();
            },
            error: function (e) {
                let array = {
                    'type': '',
                    'msg': e.message
                };
                this.showModal(array);
            },
            formValidateBeforeSubmit: function formValidateBeforeSubmit() {

                this.submitForm();
                return;


            }
        }
    }
</script>

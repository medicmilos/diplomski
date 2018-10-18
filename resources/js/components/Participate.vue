<template>
    <div class="col-lg-12 row participate">
        <div class="col-lg-6 col-center">
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
                :customStrings="{
                            'upload' : '',
                            'drag' : 'Prevucite sliku ili kliknite ovde da biste je izabrali',
                            'change' : 'Izmeni sliku',
                            'remove' : 'Izbriši sliku',
                            'select' : '',
                            'fileSize' : '',
                            'fileType' : '',
                            'aspect' : ''
                        }"
            >
            </picture-input>
            <button class="button-submit" @click="submitForm()">Pošalji</button>
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
                let canvas1 = $(".picture-preview");

                this.$parent.$emit('loadImageToCanvas', canvas1[0].toDataURL("image/png"));

                $(".participate-display").hide();
            },
            error: function (e) {
                let array = {
                    'type': '',
                    'msg': "Došlo je do greške. Pokušajte kasnije."
                };
                this.showModal(array);
            }
        }
    }
</script>
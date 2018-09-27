<template>
    <div class="col-lg-12 show-item-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-sm-2 col-xs-2 show-on-mob">
                        &nbsp;
                    </div>
                    <div class="col-sm-10 col-xs-10">
                        <a v-bind:href="$parent.baseUrl+'/Gallery/gallery/landing'">

                            <div class="logo-wrapper">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-wrapper col-lg-12 new-form-page" >
                <div class="row">
                    <!--v-on:submit.prevent="formValidateBeforeSubmit"-->
                    <form id="userForm" v-on:submit.prevent="formValidateBeforeSubmit" method="POST" class="participate-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-center">
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input firstName" name="firstName" type="text" data-vv-as="ime"
                                           v-validate="{required: true, regex: /^[\w\sčćđžšČĆŠĐŽ]{2,32}$/}"
                                           placeholder="Ime">
                                </div>
                                <span class="validation-text"
                                      v-show="errors.has('firstName')">{{errors.first('firstName')}}</span>
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input lastName" name="lastName" type="text" data-vv-as="prezime"
                                           v-validate="{required: true, regex: /^[\w\sčćđžšČĆŠĐŽ]{2,32}$/}"
                                           placeholder="Prezime">
                                </div>
                                <span class="validation-text" v-show="errors.has('lastName')">{{errors.first('lastName')}}</span>
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input address" name="livingPlace" type="text"
                                           data-vv-as="mesto stanovanja"
                                           v-validate="{required: true, regex: /^[\w\sčćđžšČĆŠĐŽ]{2,50}$/}"
                                           placeholder="Mesto stanovanja">
                                </div>
                                <span class="validation-text" v-show="errors.has('livingPlace')">{{errors.first('livingPlace')}}</span>
                                <br>
                                <div class="button-row">
                                    <button type="submit" class="save scroll-top-button" id="show-modal"></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';



    export default {
        name: 'app',
        components: {
            axios
        },
        data() {
            return {}
        },
        mounted() {

        },
        methods: {
            formValidateBeforeSubmit: function formValidateBeforeSubmit() {
                console.log(":Asdads");
                let self = this;
                $('.save').css("opacity", "0.5");
                this.$validator.validateAll().then(function (result) {
                    if (result) {
                        $('.save').css("opacity", "1");
                        document.querySelector('#userForm').submit();
                    } else {
                        $('.save').css("opacity", "1");

                    }
                });
            }
        }
    }
</script>

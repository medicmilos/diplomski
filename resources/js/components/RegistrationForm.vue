<template>
    <div class="col-lg-12 show-item-page">
        <div class="container">
            <div class="bottom-wrapper col-lg-12 new-form-page">
                <div class="row">
                    <!--v-on:submit.prevent="formValidateBeforeSubmit"-->
                    <form id="userForm" v-on:submit.prevent="formValidateBeforeSubmit" method="POST"
                          class="participate-form">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-center">
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input firstName" name="firstName" type="text"
                                           placeholder="Ime">
                                </div>
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input lastName" name="lastName" type="text"
                                           placeholder="Prezime">
                                </div>
                                <br>
                                <div class="input-wrapper">
                                    <input class="form-input address" name="livingPlace" type="text"
                                           placeholder="Mesto stanovanja">
                                </div>
                                <br>
                                <div class="button-row">
                                    <button type="submit" class="save scroll-top-button" id="show-modal">Pošalji</button>
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
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),
        mounted() {

        },
        methods: {
            formValidateBeforeSubmit: function formValidateBeforeSubmit() {


                document.querySelector('#userForm').submit();


            }
        }
    }
</script>

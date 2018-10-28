<template>
    <div class="col-lg-12 show-item-page">
        <div class="container login">
            <div class="col-lg-8 col-center">
                <p class="page-title">Podaci o korisniku</p>
                <form id="userForm" v-on:submit.prevent="formValidateBeforeSubmit" method="POST"
                      class="participate-form">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <div class="col-md-8 col-center">
                            <div class="input-wrapper">
                                <input class="form-control form-input firstName" name="firstName" type="text"
                                       :value="nameold"
                                       placeholder="Ime">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-center">
                            <div class="input-wrapper">
                                <input class="form-control form-input lastName" name="lastName" type="text"
                                       :value="lastnameold"
                                       placeholder="Prezime">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-center">
                            <div class="input-wrapper">
                                <input class="form-control form-input address" name="livingPlace" type="text"
                                       :value="placeold"
                                       placeholder="Mesto stanovanja">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-center">
                            <div class="button-row">
                                <button type="submit" class="save scroll-top-button" id="show-modal">Pošalji
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        name: 'app',
        props: ['nameold', 'lastnameold', 'placeold'],
        components: {
            axios
        },
        created() {
            console.log(this.nameold);
        },
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),
        methods:
            {
                formValidateBeforeSubmit: function formValidateBeforeSubmit() {
                    document.querySelector('#userForm').submit();
                }
            }
    }
</script>

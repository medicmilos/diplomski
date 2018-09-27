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
            <div class="bottom-wrapper col-lg-12">
                <div class="item-wrapper show-bottom-wrap col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <div class="rotate-wrapper">
                        <div class="gallery-img-wrapper">
                            <img class="gallery-item-image" v-bind:src="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 sub-description">
                    <p class="thanks-message">Hvala na poslatoj fotografiji, nakon autorizacije će se naći u
                        galeriji</p>
                    <p><a v-bind:href="$parent.baseUrl+'/Gallery/gallery/index'">
                        <img class="img-responsive" style="margin: 0 auto;"
                             v-bind:src="$parent.baseUrl + '/images/btn_galerija.png'"/></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'app',
        data() {
            return {
                image: ""
            }
        },
        mounted() {
            $(".finishmodifyingimage-display").hide();
            /*
            this.$parent.$on('successUpload', (image) => {
                $(".modifyimage-display").hide();
                $(".finishmodifyingimage-display").show();
                this.image = URL.createObjectURL(image);
            });
            */
        }
    }
</script>
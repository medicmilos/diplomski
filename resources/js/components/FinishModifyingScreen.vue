<template>
    <div class="col-lg-12 show-item-page">
        <div class="container">
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
                    <p><a v-bind:href="$parent.baseUrl+'/gallery/index'">link to gallery</a>
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
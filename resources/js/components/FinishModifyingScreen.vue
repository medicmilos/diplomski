<template>
    <div class="col-lg-12 row modify-image-finish">
        <div class="container">
            <div class="bottom-wrapper col-lg-12">
                <div class="col-center col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img class="gallery-item-image" v-bind:src="image">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="thanks-message">Hvala na poslatoj fotografiji, nakon odobrenja administratora, naći će se
                        u <a v-bind:href="$parent.baseUrl+'/gallery/index'">galeriji</a></p>
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

            this.$parent.$on('successUpload', (image) => {
                $(".modifyimage-display").hide();
                $(".finishmodifyingimage-display").show();
                this.image = URL.createObjectURL(image);
            });
        }
    }
</script>
<template>
    <div class="col-lg-12 row modify-image">
        <div class="col-lg-12 col-center">
            <div class="col-lg-8 col-md-8 col-sm-12 col-center modify-wrap">
                <div class="canvas-wrapper aligner">
                    <canvas id="canvasMain"></canvas>
                </div>
            </div>
            <div class="col-lg-4 col-centered col-sm-12 col-md-4 col-xs-12 remove-sticker">
                <button @click="removeSticker" class="delete">Obriši selektovani stiker</button>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 manual-sticker">
                <p>
                    Ukrasite svoju fotografiju sa našim stikerima
                </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 choose-sticker">
                <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/logo.png')"
                     v-bind:src="$parent.baseUrl + '/images/stickers/logo.png'"/>
                <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/love.png')"
                     v-bind:src="$parent.baseUrl + '/images/stickers/love.png'"/>
                <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/lol.png')"
                     v-bind:src="$parent.baseUrl + '/images/stickers/lol.png'"/>
                <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/like.png')"
                     v-bind:src="$parent.baseUrl + '/images/stickers/like.png'"/>
            </div>
            <div class="col-sm-12 modify-buttons-wrapper">
                <button :disabled="isDisabled" class="button-upload save" @click="uploadModitiedImage">
                    Pošalji
                </button>
            </div>
        </div>

        <modal v-if="this.modalOpen" @close="showModal">
            <div class="modal-head" slot="header">
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
        data() {
            return {
                modalData: 0,
                modalOpen: false,
                baseUrl: baseUrl,
                canvas: "",
                firstName: "",
                lastName: "",
                email: "",
                livingPlace: "",
                image: "",
                isDisabled: false
            }
        },
        mounted() {
            $(".modifyimage-display").hide();
            $(".delete").hide();
            const self = this;
            this.$parent.$on('loadImageToCanvas', (image) => {
                $(".modifyimage-display").show();

                let uploadedImage = image;
                const containerWidth = $(".canvas-wrapper").width();
                const containerHeight = $(".canvas-wrapper").height();

                self.canvas = new fabric.Canvas('canvasMain', {
                    preserveObjectStacking: true
                });
                self.canvas.renderAll();

                fabric.Image.fromURL(uploadedImage, function (img) {
                    img.id = "user_image";
                    img.selectable = false;
                    img.globalCompositeOperation = 'destination-over';
                    self.canvas.setHeight(img.height);
                    self.canvas.setWidth(img.width);

                    const scaleW = containerWidth / img.width;
                    const scaleH = containerHeight / img.height;
                    let scale = 0;

                    if (scaleW > scaleH)
                        scale = scaleH;
                    else
                        scale = scaleW;

                    if ($(window).width() > 768) {
                        $(".canvas-container").css("transform", "scale(" + scale * 0.85 + ")");
                        $(".canvas-wrapper").css('width', parseInt(img.width * scale * 0.85) + 'px');
                        $(".canvas-wrapper").css('height', parseInt(img.height * scale * 0.85) + 'px');
                    } else {
                        $(".canvas-container").css("transform", "scale(" + scale + ")");
                        $(".canvas-wrapper").css('width', parseInt(img.width * scale) + 'px');
                        $(".canvas-wrapper").css('height', parseInt(img.height * scale) + 'px');
                    }

                    self.canvas.forEachObject(function (obj) {
                        let setCoords = obj.setCoords.bind(obj);
                        obj.on({
                            moving: setCoords,
                            scaling: setCoords,
                            rotating: setCoords
                        });
                    });
                    self.canvas.add(img);

                    let cornerSize = 15;
                    cornerSize /= scale;

                    fabric.Object.prototype.set({
                        borderColor: '#43740b',
                        cornerColor: '#539a00',
                        cornerSize: cornerSize,
                        rotatingPointOffset: cornerSize * 2,
                        transparentCorners: false
                    });

                    self.canvas.on('selection:created', function () {
                        $(".delete").show();
                    });

                    self.canvas.on('selection:cleared', function () {
                        $(".delete").hide();
                    });
                });
            });
        },
        methods: {
            showModal(msg) {
                this.modalData = msg;
                this.modalOpen = !this.modalOpen;
            },
            selectSticker(myImg) {
                const self = this;

                self.canvas.getObjects().forEach(function (o) {
                    if (o.id === "user_image") {
                        o.selectable = false;
                    }
                });

                fabric.Image.fromURL(myImg, function (oImg) {
                    const l = 20;
                    const t = 20;
                    oImg.scale(self.canvas.getWidth() / oImg.width / 3);
                    oImg.set({'left': l});
                    oImg.set({'top': t});
                    self.canvas.add(oImg);
                    self.canvas.moveTo(oImg, 3);
                    self.canvas.setActiveObject(oImg, 3);
                });
                self.canvas.on("after:render", function () {
                    self.canvas.calcOffset()
                });
            },
            removeSticker() {
                const self = this;
                if (self.canvas.getActiveObject().id !== "user_image") {
                    let activeObject = self.canvas.getActiveObject();
                    self.canvas.remove(activeObject);
                }
            },
            uploadModitiedImage() {
                const self = this;

                this.isDisabled = true;
                $('.save').css("opacity", "0.5");

                function dataURItoBlob(dataURI) {
                    // convert base64/URLEncoded data component to raw binary data held in a string
                    let byteString;
                    if (dataURI.split(',')[0].indexOf('base64') >= 0)
                        byteString = atob(dataURI.split(',')[1]);
                    else
                        byteString = unescape(dataURI.split(',')[1]);

                    // separate out the mime component
                    let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                    // write the bytes of the string to a typed array
                    let ia = new Uint8Array(byteString.length);
                    for (let i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }

                    return new Blob([ia], {type: mimeString});
                }

                let dataURL = self.canvas.toDataURL("image/png");
                let blob = dataURItoBlob(dataURL);

                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Access-Control-Allow-Origin": "*"
                    }
                };

                let formData = new FormData();
                formData.append('photo', blob);

                console.log(blob);
                console.log(formData);

                axios.post(this.$parent.apiUrl + 'gallery/store', formData, config)
                    .then(response => {
                        this.button = 'Upload';
                        this.image = '';
                        this.$parent.$emit('successUpload', blob);
                        this.isDisabled = false;
                        $('.save').css("opacity", "1");
                    })
                    .catch(e => {
                        this.isDisabled = false;
                        $('.save').css("opacity", "1");
                        let array = {
                            'type': 'Greška!',
                            'msg': e.response.data.message
                        };
                        this.showModal(array);
                    })
            }
        }
    }
</script>

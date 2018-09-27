<template>
    <div class="col-lg-12">
        <div class="col-lg-12 col-centered  modify-image-wrapper">
            <div class="col-lg-8 col-centered modify-image">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="canvas-wrapper aligner">
                        <canvas id="canvasMain"></canvas>
                    </div>
                </div>
                <!--<div class="col-lg-12 col-centered col-sm-12 col-md-12 col-xs-12 remove-sticker">-->
                <!--<button @click="removeSticker" class="delete">Obriši selektovani stiker</button>-->
                <!--</div>-->

                <div class="col-lg-2 col-md-2 col-sm-12 choose-sticker">

                    <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/oblak.png')"
                         v-bind:src="$parent.baseUrl + '/images/stickers/oblak.png'"/>
                    <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/brod.png')"
                         v-bind:src="$parent.baseUrl + '/images/stickers/brod.png'"/>
                    <img class="img-responsive" @click="selectSticker($parent.baseUrl + '/images/stickers/sunce.png')"
                         v-bind:src="$parent.baseUrl + '/images/stickers/sunce.png'"/>
                </div>
                <div class="col-sm-12 modify-buttons-wrapper">
                    <button :disabled="isDisabled" class="button-upload" @click="uploadModitiedImage">
                        send
                    </button>
                </div>
            </div>
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
            const self = this;
            this.$parent.$on('loadImageToCanvas', (image, firstName, lastName, email, livingPlace) => {
                $(".modifyimage-display").show();

                let uploadedImage = image;

                this.firstName = firstName;
                this.lastName = lastName;
                this.email = email;
                this.livingPlace = livingPlace;

                const containerWidth = $(".canvas-wrapper").width();
                const containerHeight = $(".canvas-wrapper").height();


                var HideControls = {
                    'tl': true,
                    'tr': true,
                    'bl': true,
                    'br': true,
                    'ml': false,
                    'mt': true,
                    'mr': false,
                    'mb': false,
                    'mtr': true
                };

                let isVML = function () {
                    return typeof G_vmlCanvasManager !== 'undefined';
                };

                fabric.util.object.extend(fabric.Object.prototype, {

                    selectedIconImage: new Image(),
                    selectedIconImage1: new Image(),
                    selectedIconImage2: new Image(),
                    selectedIconImage3: new Image(),
                    //rotateSrc: 'http://cdn.flaticon.com/svg/25/25429.svg',refreshicon.svg
                    rotateSrc: self.$parent.baseUrl + '/images/refreshicon.svg',
                    //deleteSrc: 'http://cdn.flaticon.com/svg/51/51517.svg',
                    deleteSrc: self.$parent.baseUrl + '/images/closedeleteicon.svg',
                    //resizeSrcL: 'http://cdn.flaticon.com/svg/25/25476.svg',
                    resizeSrcL: self.$parent.baseUrl + '/images/arrowsicon.svg',
                    isLoaded: false,
                    isLoaded1: false,
                    isLoaded2: false,
                    isLoaded3: false,

                    _drawControl: function (control, ctx, methodName, left, top) {


                        if (!this.isControlVisible(control)) {
                            return;
                        }
                        var size = this.cornerSize;
                        isVML() || this.transparentCorners || ctx.clearRect(left, top, size, size);

                        if (control !== 'bl' && control !== 'tl' && control !== 'mtr' && control !== 'tr' && control !== 'br' && control !== 'mt')
                            ctx['fillRect'](left, top, size, size);


                        if (control === 'mtr') {

                            if (this.isLoaded2) {
                                ctx.drawImage(this.selectedIconImage2, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded2 = true;
                                this.selectedIconImage2.src = this.rotateSrc;
                            }
                        }


                        if (control === 'bl') {
                            if (this.isLoaded) {
                                ctx.drawImage(this.selectedIconImage, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded = true;
                                this.selectedIconImage.src = this.resizeSrcL;
                            }
                        }

                        if (control === 'tr') {
                            if (this.isLoaded) {
                                ctx.drawImage(this.selectedIconImage, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded = true;
                                this.selectedIconImage.src = this.resizeSrcL;
                            }
                        }

                        if (control === 'mt') {
                            if (this.isLoaded1) {
                                ctx.drawImage(this.selectedIconImage1, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded1 = true;
                                this.selectedIconImage1.src = this.deleteSrc;
                            }
                        }

                        if (control === 'br') {
                            if (this.isLoaded) {
                                ctx.drawImage(this.selectedIconImage, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded = true;
                                this.selectedIconImage.src = this.resizeSrcL;
                            }
                        }

                        if (control === 'tl') {
                            if (this.isLoaded) {
                                ctx.drawImage(this.selectedIconImage, left, top, size, size);
                            } else {
                                var self = this;
                                self.isLoaded = true;
                                this.selectedIconImage.src = this.resizeSrcL;
                            }
                        }

                        this.setControlsVisibility({
                            bl: true,
                            br: true,
                            tl: true,
                            tr: true,
                            mt: true,
                            mb: false,
                            ml: false,
                            mr: false,
                            mtr: true
                        });

                    }

                });

                var cursorOffset = {mt: 0, tr: 1, mr: 2, br: 3, mb: 4, bl: 5, ml: 6, tl: 7};


                //degreesToRadians = fabric.util.degreesToRadians;
                fabric.util.object.extend(fabric.Canvas.prototype, {
                    setCursor: function (value) {
                        this.upperCanvasEl.style.cursor = value;
                    },
                    _getActionFromCorner: function (target, corner) {
                        if (corner && corner === 'mtr') {
                            var action_rotate = (target) ? 'rotate' : 'rotate';
                            return action_rotate;
                        }

                        if (corner && corner === 'tl') {
                            var action_scale = (target) ? 'scale' : 'scale';
                            return action_scale;
                        }
                        if (corner && corner === 'tr') {
                            var action_scale = (target) ? 'scale' : 'scale';
                            return action_scale;
                        }
                        if (corner && corner === 'bl') {
                            var action_scale = (target) ? 'scale' : 'scale';
                            return action_scale;
                        }
                        if (corner && corner === 'br') {
                            var action_scale = (target) ? 'scale' : 'scale';
                            return action_scale;
                        }

                        if (corner === 'mt') {
                            if (this.getActiveObject()) {
                                this.remove(this.getActiveObject());
                            }
                        }


                    },
                });


                self.canvas = new fabric.Canvas('canvasMain', {
                    preserveObjectStacking: true
                });
                self.canvas.renderAll();


                fabric.Image.fromURL(uploadedImage, function (img) {
                    img.id = "user_image";
                    img.selectable = false;
                    img.globalCompositeOperation = 'destination-over';
                    img.hasControls = false;
                    img.setControlsVisibility(HideControls);
                    self.canvas.setHeight(img.height);
                    self.canvas.setWidth(img.width);

                    const scaleW = containerWidth / img.width;
                    const scaleH = containerHeight / img.height;
                    let scale = 0;

                    if (scaleW > scaleH)
                        scale = scaleH;
                    else
                        scale = scaleW;

                    self.canvas.forEachObject(function (obj) {
                        let setCoords = obj.setCoords.bind(obj);
                        obj.on({
                            moving: setCoords,
                            scaling: setCoords,
                            rotating: setCoords
                        });
                    });

                    if ($(window).width() > 768) {
                        $(".canvas-container").css("transform", "scale(" + scale * 1.25 + ")");
                        $(".canvas-wrapper").css('width', parseInt(img.width * scale * 1.25) + 'px');
                        $(".canvas-wrapper").css('height', parseInt(img.height * scale * 1.25) + 'px');
                    } else {
                        $(".canvas-container").css("transform", "scale(" + scale + ")");
                        $(".canvas-wrapper").css('width', parseInt(img.width * scale) + 'px');
                        $(".canvas-wrapper").css('height', parseInt(img.height * scale) + 'px');
                    }


                    self.canvas.add(img);

                    let cornerSize = 15;
                    cornerSize /= scale;

                    fabric.Object.prototype.set({
                        borderColor: '#f9cf0b',
                        cornerColor: 'transparent',
                        cornerSize: cornerSize,
                        rotatingPointOffset: cornerSize * 2,
                        transparentCorners: true
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
                formData.append('firstName', this.firstName);
                formData.append('lastName', this.lastName);
                formData.append('email', this.email);
                formData.append('livingPlace', this.livingPlace);
                formData.append('name', this.firstName + " " + this.lastName);

                axios.post(this.$parent.apiUrl + 'gallery/store', formData, config)
                    .then(response => {
                        this.button = this.$t('gallery.participate.upload_success_btn');
                        this.image = '';
                        this.$parent.$emit('successUpload', blob);
                        this.isDisabled = false;
                        $('.save').css("opacity", "1");
                        window.location.replace(self.$parent.baseUrl + '/gallery/item/hvala?id=' + response.data.item_data["item_id"]);
                    })
                    .catch(err => {
                        this.isDisabled = false;
                        $('.save').css("opacity", "1");
                        let array = {
                            'type': 'error',
                            'msg': err
                        };
                        this.showModal(array);
                    })
            }
        }
    }
</script>




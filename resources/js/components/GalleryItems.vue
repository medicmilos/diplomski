<template>
    <div class="col-lg-12" style="margin-bottom: 5rem;">
        <div class="container" style="margin-bottom: 5rem;">
            <div class="row">
                <div class="col-lg-12">

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
            <div class="row">
                <div class="col-lg-4 col-md-4">
                </div>
                <div class="col-lg-4 col-md-4">
                    <a v-bind:href="$parent.baseUrl+'/Gallery/gallery/index'">
                        <img class="img-responsive show-imgt" style="margin: 0 auto;"
                             v-bind:src="$parent.baseUrl + '/images/btn_galerija.png'"/>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="search-wrapper">
                        <input v-on:keyup="searchFetch()" class="gallery-search" type="search">
                    </div>
                </div>
            </div>
            <div class="component-body col-lg-12">
                <div class="col-lg-12" style="padding:0">
                    <div class="col-lg-12 ">
                        <div class="item-wrapper col-lg-4 col-md-4 col-sm-6 col-xs-12"
                             v-for="item in $parent.appItems">
                            <div class="rotate-wrapper">
                                <a v-bind:href="$parent.baseUrl+'/Gallery/gallery/item/show/'+item.id">
                                    <div class="gallery-img-wrapper">
                                        <img class="gallery-item-image"

                                             :src="$parent.pgItemUrl+item.item_data.photo">
                                    </div>
                                </a>
                            </div>
                            <div class="image-subtext">
                                <span :title="item.item_data.name"
                                      class="item-username">{{item.item_data.name}}</span><br/>
                                <span class="item-like" v-if="item.canLike">
                                     <span :id="item.item_data.item_id">
                                Glasovi: {{item.likeCount}}
                            </span>
                                    <br/>
                            <span class="vote-button" @click="calculateTop" v-on:click="processLike(item.item_data.item_id)"><img
                                    :src="$parent.baseUrl+'/images/btn_glasaj.png'"
                                    alt=""></span>

                        </span>
                                <span class="item-like" v-else>
                                    <span :id="item.item_data.item_id">
                                Glasovi: {{item.likeCount}}
                            </span>
                                    <br/>
                            <span class="vote-button" style="opacity:0.5"><img
                                    :src="$parent.baseUrl+'/images/btn_glasaj.png'"
                                    alt=""></span>

                        </span>
                                <br/>
                                <span class="item-share" v-on:click="fbShare(item.id)"><img
                                        :src="$parent.baseUrl+'/images/btn_share.png'"
                                        alt=""></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <mugen-scroll v-if="$parent.infScroll" :handler="fetchData" :should-handle="!loading">
            <div v-if="this.$parent.moreItems === 1 && this.$parent.appItems.length > 6">
                <img style="max-width: 6.5rem" :src="$parent.baseUrl+'/images/loading.gif'">
            </div>
            <div class="end-of-data" v-else>
                Kraj podataka za prikaz.
            </div>
        </mugen-scroll>
        <modal v-if="this.modalOpen" id="testmodal" @close="showModal">
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
    import MugenScroll from 'vue-mugen-scroll'

    export default {
        name: 'appPagination',
        created() {
        },
        components: {
            MugenScroll
        },
        data() {
            return {
                modalData: 0,
                modalOpen: false,
                loading: false,
                initDataFetch: true,
                pullToRefreshCfg: {
                    errorLabel: this.$t('gallery.mobile.pull_to_refresh.errorLabel'),
                    startLabel: this.$t('gallery.mobile.pull_to_refresh.startLabel'),
                    readyLabel: this.$t('gallery.mobile.pull_to_refresh.readyLabel'),
                    loadingLabel: this.$t('gallery.mobile.pull_to_refresh.loadingLabel')
                },
                likedItemId: 0,
                fromTop: 300
            }
        },
        methods: {
            calculateTop(button){
               this.fromTop = button.pageY;
            },
            showModal(msg) {


                this.modalData = msg;
                this.modalOpen = !this.modalOpen;

                this.$nextTick(() => {
                    $(".modal-wrapper").css("top", this.fromTop + 'px');
                    console.log(this.fromTop);
                });


            },
            processLike(item) {
                this.$parent.likeItem(item, this.likeSuccess, this.likeError);
                this.likedItemId = item;
            },
            likeError: function (e) {
                if (e) {
                    let baseUrl = this.$parent.baseUrl;
                    let array = {
                        'type': '',
                        'msg': "Da biste glasali morate se registrovati i popuniti podatke <a href=" + baseUrl + "/Gallery/gallery/participate>ovde</a>."
                    };
                    this.showModal(array);
                    this.$parent.forbidden = false;
                }
            },
            likeSuccess: function (id) {
                if (typeof id.item_id !== 'undefined') {
                    this.$parent.updateFrontEndLike(this.likedItemId);
                } else {
                    this.$parent.updateFrontEndLike(id);
                    let baseUrl = this.$parent.baseUrl;
                    let array = {
                        'type': '',
                        'msg': "Da biste glasali morate se registrovati i popuniti podatke <a href=" + baseUrl + "/Gallery/gallery/participate>ovde</a>."
                    };
                    this.showModal(array);
                }
            },
            fbShare(id) {
                let url = baseUrl + "/Gallery/gallery/share/" + id;
                let fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
                this.$parent.shareItem(id);
            },
            fetchData() {
                let _this = this;

                //initial data fetch
                if (this.initDataFetch) {
                    _this.loading = true;
                    let searchValue = $(".gallery-search").val();
                    _this.$parent.insertMoreDataToList(searchValue);
                    _this.loading = false;
                    _this.initDataFetch = false;
                }

                //desktop scroll support
                $(window).bind('mousewheel DOMMouseScroll', function (event) {
                    if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                    }
                    else {
                        if (event.clientY + 1300 > $(document).height()) {
                            _this.loading = true;
                            let searchValue = $(".gallery-search").val();
                            _this.$parent.insertMoreDataToList(searchValue);
                            _this.loading = false;
                        }
                    }
                });

                //mobile touch support
                document.addEventListener('touchmove', function (e) {
                    let touch = e.touches[0];
                    if (touch.pageY + 1300 > $(document).height()) {
                        _this.loading = true;
                        let searchValue = $(".gallery-search").val();
                        _this.$parent.insertMoreDataToList(searchValue);
                        _this.loading = false;
                    }
                }, false);
            },
            searchFetch() {

                this.loading = true;
                this.$parent.appItems = [];
                this.$parent.currentOffset = -1;
                this.$parent.startingOffset = -1;

                let searchValue = $(".gallery-search").val();
                //console.log(searchValue);
                this.$parent.insertMoreDataToList(searchValue);
                this.loading = false;
            },
            onRefresh: function () {
                let self = this;
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        self.$parent.loadNewData();
                        resolve();
                    }, 750);
                });
            },
        }
    }
</script>
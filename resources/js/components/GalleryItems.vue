<template>
    <div class="col-lg-12" style="margin-bottom: 5rem;">
        <div class="container" style="margin-bottom: 5rem;">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <a v-bind:href="$parent.baseUrl+'/gallery/participate'">
                        participate
                    </a>
                </div>
            </div>
            <div class="component-body col-lg-12">
                <div class="col-lg-12" style="padding:0">
                    <div class="col-lg-12 ">
                        <div class="item-wrapper col-lg-4 col-md-4 col-sm-6 col-xs-12"
                             v-for="item in $parent.appItems">
                            <div class="">
                                <a v-bind:href="$parent.baseUrl+'/gallery/item/show/'+item.id">
                                    <div class="">
                                        <img class=""

                                             :src="$parent.pgItemUrl+item.item_data.photo">
                                    </div>
                                </a>
                            </div>
                            <div class=" ">
                                <span :title="item.item_data.name"
                                      class="item-username">{{item.item_data.name}}</span><br/>
                                <span class="item-like" v-if="item.canLike">
                                     <span :id="item.item_data.item_id">
                                Glasovi: {{item.likeCount}}
                            </span>
                                    <br/>
                            <span class="vote-button" @click="calculateTop"
                                  v-on:click="processLike(item.item_data.item_id)">vote</span>

                        </span>
                                <span class="item-like" v-else>
                                    <span :id="item.item_data.item_id">
                                Glasovi: {{item.likeCount}}
                            </span>
                                    <br/>
                            <span class="vote-button" style="opacity:0.5">vote</span>

                        </span>
                                <br/>
                                <span class="item-share" v-on:click="fbShare(item.id)">share</span>
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
            <div class="" v-else>
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
                likedItemId: 0,
                fromTop: 300
            }
        },
        methods: {
            calculateTop(button) {
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
                        'msg': "Da biste glasali morate se registrovati i popuniti podatke <a href=" + baseUrl + "/gallery/participate>ovde</a>."
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
                        'msg': "Da biste glasali morate se registrovati i popuniti podatke <a href=" + baseUrl + "/gallery/participate>ovde</a>."
                    };
                    this.showModal(array);
                }
            },
            fbShare(id) {
                let url = baseUrl + "/gallery/share/" + id;
                let fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
                this.$parent.shareItem(id);
            },
            fetchData() {
                this.loading = true;
                this.$parent.insertMoreDataToList();
                this.loading = false;
                this.initDataFetch = false;
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
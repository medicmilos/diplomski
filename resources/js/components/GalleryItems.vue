<template>
    <div class="col-lg-12 gallery row">
        <div class="item-wrapper col-lg-4 col-md-4 col-sm-6 col-xs-12" v-for="item in $parent.appItems">
            <div class="item-inner-wrapper">
                <div class="item-outter-wrapper">
                    <a v-bind:href="$parent.baseUrl+'/gallery/item/show/'+item.id">
                        <img :src="$parent.pgItemUrl+item.item_data.photo">
                    </a>
                </div>
                <div class="">
                    <div class="middle-block">
                        <div class="date">
                            <span class="item-date">{{modifyDateTime(item.created_at)}}</span>
                        </div>
                        <div class="name">
                            <span :title="item.item_data.name" class="item-username">{{item.item_data.name}}</span>
                        </div>
                    </div>
                    <div class="bottom-block">
                        <div class="vote">
                    <span class="item-like" v-if="item.canLike">
                            <span class="vote-button"
                                  v-on:click="processLike(item.item_data.item_id)"><img
                                    :src="$parent.baseUrl+'/images/btn_glasaj.png'"></span>

                        </span>
                            <span class="item-like" v-else>
                            <span class="vote-button" style="opacity:0.5"><img
                                    :src="$parent.baseUrl+'/images/btn_glasaj.png'"></span>

                        </span>
                        </div>
                        <div class="share">


                            <span :id="item.item_data.item_id">
                                Glasovi: {{item.likeCount}}
                            </span>
                            <span class="item-share" v-on:click="fbShare(item.id)"><img
                                    :src="$parent.baseUrl+'/images/btn_share.png'"></span>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <mugen-scroll class="col-lg-12" v-if="$parent.infScroll" :handler="fetchData" :should-handle="!loading">
            <div v-if="this.$parent.moreItems === 1 && this.$parent.appItems.length > 6">
                <img style="max-width: 6.5rem" :src="$parent.baseUrl+'/images/loading.gif'">
            </div>
            <div v-else>
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
            this.$parent.endPoint = 'index';
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
                likedItemId: 0
            }
        },
        methods: {
            showModal(msg) {
                this.modalData = msg;
                this.modalOpen = !this.modalOpen;
            },
            processLike(item) {
                console.log("LIKE - " + item);
                this.$parent.likeItem(item, this.likeSuccess, this.likeError);
                this.likedItemId = item;
            },
            likeError: function (e) {
                if (e) {
                    let array = {
                        'type': 'error',
                        'msg': "forbidden"
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
                    let array = {
                        'type': 'error',
                        'msg': "error general"
                    };
                    this.showModal(array);
                }
            },
            fbShare(id) {//toDo fix mby this?
                let url = baseUrl + "/gallery/share/" + id;
                let fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
                this.$parent.shareItem(id);
            },
            fetchData() {
                this.$parent.insertMoreDataToList();
                this.initDataFetch = false;
            },
            modifyDateTime(dateTime) {
                let dateFormat = require('dateformat');
                let input = new Date(dateTime);
                return dateFormat(input, "dd.mm.yyyy.");
            }
        }
    }
</script>

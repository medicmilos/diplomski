var Vue = require('vue');
window.Vue = Vue;

let axios = require('axios');
let VueAxios = require('vue-axios');

import Vuex from 'vuex';
import galleryItems from './components/GalleryItems.vue';
import participate from './components/Participate.vue';
import modifyimage from './components/ModifyImage.vue';
import registration from './components/RegistrationForm.vue';
import finishmodifyingimage from './components/FinishModifyingScreen.vue';

Vue.use(VueAxios, axios);

const store = new Vuex.Store();

Vue.config.debug = true;


Vue.component('modal',
    require('./components/Modal.vue')
);


new Vue({
    store,
    el: '#app',
    data: {
        appItems: [],
        items: [],
        currentOffset: -1,
        startingOffset: -1,
        limit: 4,
        moreItems: 1,
        newItems: 1,
        loadingData: 0,
        dataReady: false,
        baseUrl: baseUrl,
        apiUrl: baseUrl + '/api/v1/',
        pgItemUrl: baseUrl + "/storage/gallery/preview/",
        resource_url: baseUrl + '/api/v1/gallery/index/paginate',
        infScroll: true,
        pagination: false,
        forbidden: false
    },
    mounted() {
        if ($(window).width() < 768) {
            this.infScroll = true;
            this.pagination = false;
        } else {
            this.infScroll = true;
            this.pagination = false;
        }
    },
    components: {
        galleryItems,
        participate,
        modifyimage,
        finishmodifyingimage,
        registration,
    },
    methods: {
        likeItem: function (id, success, fail) {
            console.log('Gallery - like item ' + id);
            let apiEndpoint = this.apiUrl + 'gallery/like/' + id;
            this.post(apiEndpoint, null, success, fail);
        },
        shareItem: function (id, success, fail) {
            console.log('Gallery - share item ' + id);
            let apiEndpoint = this.apiUrl + 'gallery/share/' + id;
            this.post(apiEndpoint, null, success, fail);
        },
        uploadItem: function (item, success, fail) {
            console.log('Gallery - upload item ' + item);
            let apiEndpoint = this.apiUrl + 'gallery/store/' + item;
            this.post(apiEndpoint, null, success, fail);
        },
        updateResource(data) {
            let self = this;
            this.appItems = data;
            this.$nextTick(function () {
                self.dataReady = true;
            });
            self.dataReady = false;

        },
        insertMoreDataToList: function () {
            console.log('Gallery - insertMoreDataToList');


            let self = this;
            //if (this.moreItems === 1 && this.loadingData === 0) {
            if (this.loadingData === 0) {
                this.loadingData = 1;

                this.loadMoreData(
                    function (errorText) {
                        //console.log(errorText);
                        self.loadingData = 0;
                    });
            }
        },

        loadMoreData: function (success, error) {
            console.log('Gallery - loadMoreData');
            let offset_id = this.currentOffset;
            let limit = this.limit;

            let queryString = "?itemOffsetId=" + offset_id + "&itemLimit=" + limit;


            let self = this;
            this.loadData(queryString, function (json) {
                if (json.length > 0) {
                    self.currentOffset = json[json.length - 1].id; //set last id

                    if (self.startingOffset === -1) {
                        self.startingOffset = json[0].id; //set first id (only first call)
                    }
                    self.items = self.items.concat(json);
                    success(json);
                } else {
                    self.moreItems = 0;
                    setTimeout(function () {
                        self.moreItems = 1;
                    }, 1000 * 10);
                    self.loadingData = 0;
                }
            }, function (json, xhr, status) {
                error(xhr);
            })

        },

        loadData: function (queryString, success, error, refresh) {
            console.log('Gallery - loadData');
            if (queryString === null || queryString === undefined || queryString === '') {
                return false;
            }
            let apiUrl = this.apiUrl + "gallery/index";

            let url = apiUrl + queryString;
            this.get(url, null, success, error, refresh);
        },

        updateFrontEndLike: function (id) {
            for (let i = 0; i < this.appItems.length; i++) {
                if (this.appItems[i].item_data.item_id === id) {
                    this.appItems[i].likeCount += 1;
                    this.appItems[i].canLike = false;
                    break;
                }
            }
        },

        getItemWithId: function (id) {
            for (let i = 0; i < this.appItems.length; i++) {
                if (this.appItems[i].id === id) {
                    return this.appItems[i];
                }
            }


        },

        prepareNewData: function (success, error, refresh) {
            console.log('Gallery - prepareNewData');
            let limit_id = this.startingOffset;
            let queryString = "?itemLimitId=" + limit_id;
            let self = this;
            this.loadData(queryString, function (json) {
                if (json.length > 0) {
                    self.startingOffset = json[0].id; //update startin offset
                    self.items = json.concat(self.items);

                } else {
                    self.newItems = 0;
                    setTimeout(function () {
                        self.newItems = 1;
                    }, 1000 * 10);
                    //Gallery.hidePreloader();
                }
                success(json);

            }, function (json, xhr, status) {
                error(xhr.response);
            }, refresh)
        },
        loadNewData: function () {
            console.log('Gallery - loadNewData');
            let refresh = 1;
            this.prepareNewData(function (errorText) {
                //console.log(errorText);
            }, null, refresh);
        },

        get: function (url, data, success, error, refresh) {
            let self = this;
            axios.get(url)
                .then(response => {
                    // JSON responses are automatically parsed.
                    if (success != null) {
                        let json = response.data;
                        success(json, status);
                    }
                    if (refresh != null) {
                        if (response.data.length !== 0) {
                            self.appItems = response.data.concat(self.appItems);
                        }
                    } else {
                        self.appItems = self.appItems.concat(response.data);
                    }
                    console.log(self.appItems);
                })
                .catch(e => {
                    console.log(e);
                })
        },

        post: function (url, data, success, error) {
            let self = this;
            axios.post(url)
                .then(response => {
                    console.log('response');
                    // JSON responses are automatically parsed.
                    if (success != null) {
                        let json = response.data;
                        success(json, status);
                        //console.log(json);
                    }
                    return response.data;
                })
                .catch(e => {
                    console.log(e);
                    let endStatus = true;
                    error(endStatus, status);
                    self.forbidden = true;
                })
        },
        alert: function (message) {
            alert(message);
        }
    }
});

let Vue = require('vue');
window.Vue = Vue;

let axios = require('axios');
let VueAxios = require('vue-axios');

import Vuex from 'vuex';
import galleryItems from './components/GalleryItems.vue';
import participate from './components/Participate.vue';
import modifyimage from './components/ModifyImage.vue';
import registration from './components/RegistrationForm.vue';
import finishmodifyingimage from './components/FinishModifyingScreen.vue';
import winners from './components/Winners.vue';

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
        loadingData: 0,
        baseUrl: baseUrl,
        endPoint: '',
        apiUrl: baseUrl + '/api/v1/',
        pItemUrl: baseUrl + "/storage/gallery/preview/"
    },
    components: {
        galleryItems,
        participate,
        modifyimage,
        finishmodifyingimage,
        registration,
        winners,
    },
    methods: {
        likeItem: function (id, success, fail) {
            console.log('Gallery - like item ' + id);
            let apiEndpoint = this.apiUrl + 'gallery/like/' + id;
            this.post(apiEndpoint, null, success, fail);
        },
        updateFrontEndLike: function (id) {
            for (let i = 0; i < this.appItems.length; i++) {
                if (this.appItems[i].item_data.item_id === id) {
                    this.appItems[i].likeCount = parseInt(this.appItems[i].likeCount) + +1;
                    this.appItems[i].canLike = false;
                    break;
                }
            }
        },
        shareItem: function (id, success, fail) {
            console.log('Gallery - share item ' + id);
            let apiEndpoint = this.apiUrl + 'gallery/share/' + id;
            this.post(apiEndpoint, null, success, fail);
        },
        insertMoreDataToList: function () {
            console.log('Gallery - insertMoreDataToList');

            let self = this;
            if (this.loadingData === 0) {
                this.loadingData = 1;

                this.loadMoreData(
                    function (errorText) {
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
            let apiUrl = this.apiUrl + "gallery/" + this.endPoint;


            let url = apiUrl + queryString;
            this.get(url, null, success, error, refresh);
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
                })
                .catch(e => {
                    console.log(e);
                })
        },

        post: function (url, data, success, error) {
            axios.post(url)
                .then(response => {
                    // JSON responses are automatically parsed.
                    if (success != null) {
                        let json = response.data;
                        success(json, status);
                    }
                    return response.data;
                })
                .catch(e => {
                    let endStatus = true;
                    error(endStatus, status);
                })
        },
        alert: function (message) {
            alert(message);
        }
    }
});

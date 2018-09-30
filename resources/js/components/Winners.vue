<template>
    <div class="col-lg-12 gallery-component-wrapper">
        <div class="component-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="item-wrapper col-lg-4 col-md-6 col-sm-6 col-xs-12" v-for="item in $parent.appItems">
                <div class="item-inner-wrapper">
                    <div class="item-outter-wrapper">
                        <img :src="$parent.pgItemUrl+item.photo">
                    </div>
                    <div class="middle-block">
                        <div>{{modifyDateTime(item.created_at)}}</div>
                        <div class="itemTitleName" v-html="convertLink(item.username)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        name: 'winners',
        created() {
            this.$parent.endPoint = 'winners';
            this.fetchData();
        },
        components: {},
        data() {
            return {
                loading: false
            }
        },
        methods: {
            fetchData() {
                this.loading = true;
                if (this.$parent.currentOffset !== 1) {
                    this.$parent.insertMoreDataToList();
                }
                this.loading = false;
            },
            modifyDateTime(dateTime) {
                let dateFormat = require('dateformat');
                let output = dateFormat(dateTime.replace(/-/g, "/"), "dd. mm. yyyy.");
                return output;
            },
            convertLink(data) {
                let substring = "http";
                let isLink = data.includes(substring);
                let finalData = "";

                if (isLink)
                    finalData = "<a href='" + data + "' target='_blank'>Link ka radu</a>";
                else
                    finalData = data;

                return finalData;
            }
        }
    }
</script>


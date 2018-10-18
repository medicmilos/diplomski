<template>
    <div class="col-lg-12 gallery row">
        <div class="item-wrapper col-lg-4 col-md-4 col-sm-6 col-xs-12" v-for="item in $parent.appItems">
            <div class="item-inner-wrapper">
                <div class="item-outter-wrapper">
                    <a v-bind:href="$parent.pgItemUrl+item.photo" target="_blank">
                        <img :src="$parent.pgItemUrl+item.photo">
                    </a>
                </div>
                <div class="middle-block">
                    <div>{{modifyDateTime(item.created_at.date)}}</div>
                    <div class="itemTitleName">{{item.name}}</div>
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
        methods: {
            fetchData() {
                this.$parent.insertMoreDataToList();
            },
            modifyDateTime(dateTime) {
                let dateFormat = require('dateformat');
                let input = new Date(dateTime);
                let output = dateFormat(input, "dd.mm.yyyy.");
                return output;
            }
        }
    }
</script>
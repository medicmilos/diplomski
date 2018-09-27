
@include(afw_service_namespace(). '::og')
<script>
    var fbAppId = '<?php echo config('afw.appId'); ?>';
    var baseUrl = '<?php echo url('/'); ?>';
</script>
@include(afw_service_namespace(). '::head_script')
{{--<script type="text/javascript" src="{{ url('js/facebook.js') }}"></script>--}}

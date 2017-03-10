<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery带预览可拖拽文件上传代码</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('imageInput/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('imageInput/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('imageInput/css/ssi-uploader.css') }}"/>

</head>
<body>
<div class="container">
    <div class="container">
        <h3>上传图片</h3>
        <input type="hidden" id="domain" value="{{ QINIU_URL }}">
        <input type="hidden" id="uptoken_url" value="{{url('getQiniuToken')}}">
        <input type="hidden" name="image" >
        <input type="hidden" id="tokens">
        <input type='text' name="imgFiles" id="imgFiles">
        <div class="row">
            <div class="col-md-12">
                <input type="file" multiple id="ssi-upload"/>
                <div>最多只可上传九张图片呦O(∩_∩)O~（单张文件尺寸小于400kb）</div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('imageInput/js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('imageInput/js/ssi-uploader.js') }}"></script>
<script type="text/javascript">
    $(function () {
        getToken();
    });

    var getToken = function () {
        var imgNum = 0;
        $.ajax({
            url:$('#uptoken_url').val(),
            type:'get',
            async:false,
            success:function (data) {
                $('#tokens').val(data.uptoken);
                $('#ssi-upload').ssi_uploader({url:'http://upload.qiniu.com/',data:{'token':$('#tokens').val()},maxFileSize:9,allowed:['jpg','gif','png'],onEachUpload:function (fileInfo,xhr) {
                    if(!xhr.key) {
                        uplodeImg = false;
                    }
                    imgNum++;
                    console.log(imgNum);
                    var jsonData = $('#imgFiles').val();
                    $('#imgFiles').val('');
                    var domian = $('#domain').val();
                    $('#imgFiles').val(jsonData+'"img'+imgNum+'":"'+domian+xhr.key+'",');
                }});
            }
        });
    };


</script>

</body>
</html>
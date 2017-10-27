<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>中小学实验教学质量监测与评估系统</title>
    <script type="text/javascript" src="{{ asset('/js/jquery-1.8.3.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/layer/layer.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $(document).keydown(function(event) {
                if (event.keyCode == 13) {
                    if($('#name').val()!=='' && $('#password')!==''){
                        userlogin();
                    }
                }
            });
        });

        function form_submit()
        {
            var form = document.getElementById('login_form');
            form.submit();
        }
        function userlogin(){
            var username=$("#username").val();
            var password=$("#password").val();
            var verifycode=$("#verifycode").val();
            if(username==''){
                layer.tips('用户名不能为空','#username')
                $("#username").focus();
                return false;
            }else if(password==""){
                layer.tips('请输入密码','#password')
                $("#password").focus();
                return false;
            }else if(verifycode=="") {
                layer.tips('请输入验证码', '#verifycode')
                $("#verifycode").focus();
                return false;
            }else{
                $.ajax({
                    url:"{{ Route('auth.login.login') }}",
                    data:{username:username,password:password,verifycode:verifycode},
                    type:'post',
                    dataType:'json',
                    success: function(result){
                        //console.log(result);
                    },
                    error:function(error)
                    {
                        //console.log(jQuery.parseJSON(error.responseText));
                       // layer.msg(jQuery.parseJSON(error.responseText).username[0]);
                        var jsondata = jQuery.parseJSON(error.responseText);
                        for(var p in jsondata)
                        {
                            console.log(jsondata[p]);
                        }
                    },
                })
            }
        }
    </script>
    <style type="text/css">
        html, body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, button, textarea, p, blockquote, th, td, header, section {
            margin: 0;
            padding: 0;
        }
        body { font:14px Microsoft Yahei,SimSun,Arial; color: #000;}
        :focus { outline: none;}
        input, button, textarea { font: inherit;  vertical-align: middle;}
        ul { list-style: none;}
        :link, :visited, ins { text-decoration: none;}
        h1,h2,h3,h4,h5,h6 { font-size: 100%; font-weight: normal;}

        .header { padding: 10px 50px;}
        .logo { background: url("{{ asset('/images/logo.jpg')}}") no-repeat; padding-left: 80px; height: 70px; line-height: 70px; font-size: 36px; color: #41b351;}
        .body { background-color: #f1f1f1; width: 100%; padding: 30px 0;}
        .login-box { background-color: #fff; width: 360px; margin: 0 auto; position: relative; box-shadow: 0px 0px 5px #999; -webkit-box-shadow: 0px 0px 5px #999; -moz-box-shadow: 0px 0px 5px #999;}
        h1 { font-size: 24px; line-height: 60px; padding: 0 20px; border-bottom: 1px solid #d0d0d0;}
        .login-form { padding: 30px 20px;}
        .login-form ul { border: 1px solid #bebebe; padding: 0 20px;}
        .login-form ul li { height: 25px; padding: 20px 0; border-top: 1px solid #ddd}
        .login-form ul li:first-of-type { border-top: 0;}
        .ui-icon { background-image: url("{{ asset('/images/s-icon.png')}}"); background-repeat: no-repeat; float: left; height: 25px; width: 25px;}
        .ui-icon-psd { background-position: 0 -25px;}
        .ui-icon-vcode { background-position: 0 -50px;}
        .ui-input { width: 240px; height: 25px; border: none; float: left; margin-left: 10px;}
        .ui-form-other {margin-top: 5px; position: relative;}
        .ui-form-other label input { margin-right: 2px;}
        .ui-form-other .textlink { position: absolute; right: 0; top: 0; color: #000;}
        .ui-form-btn a { display: block; width: 100%; height: 40px; line-height: 40px; text-align: center; margin-top: 20px; color: #fff; font-size: 18px;}
        .login-btn { background-color: #41b351;}
        .register-btn { background-color: #aaa;}
        .footer {text-align: center; margin-top: 50px; color: #999}
    </style>
</head>

<body>
<input type="hidden" id="back_url" value="{$back_url}">
<header class="header">
    <div class="logo">实验日常教学管理中心</div>
</header>
<section class="body">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="login-box">
        <h1>用户登录</h1>
        <div class="login-form">
            <form id="login_form" method="post" action="{{ Route('auth.login.login') }}">
                {{ csrf_field() }}
            <ul>
                <li><span class="ui-icon ui-icon-user"></span><input type="text" id="username" class="ui-input" name="username" placeholder="用户名" /></li>
                <li><span class="ui-icon ui-icon-psd"></span><input type="password" id="password" class="ui-input" name="password" placeholder="密码" /></li>
                <li><span class="ui-icon ui-icon-vcode"></span><input type="text" id="verifycode" class="ui-input" name="verifycode" style="width: 130px" placeholder="验证码" /><img id="verify_img" alt="点击刷新" title="点击刷新" src="" width="110" height="100%"></li>
            </ul>
            <div class="ui-form-btn">
                <a href="#" class="login-btn" onClick="form_submit();">登录</a>
            </div>
            </form>
        </div>
    </div>
</section>
<div class="footer">Copyright © 2017 smarcloud. All Rights Reserved</div>
<script>
    $(function(){
        $("#verify_img").click(function () {
            $("#verify_img").attr({
                "src": "{:U('User/Login/createverify',array())}"+'?'+Math.random()
            });
        });
    });
    function   refeshverifycode()
    {
        $("#verify_img").attr({
            "src": "{:U('User/Login/createverify',array())}"+'?'+Math.random()
        });
    }
</script>
</body>
</html>
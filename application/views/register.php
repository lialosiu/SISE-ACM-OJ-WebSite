<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript">
        __base_url__ = '<?php echo base_url()?>';
        function base_url(url) {
            return '<?php echo base_url()?>' + url;
        }
    </script>

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url('public/jQuery/jquery-2.0.3.min.js') ?>"></script>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('public/bootstrap-3.0.0/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
    <script type="text/javascript" src="<?php echo base_url('public/bootstrap-3.0.0/js/bootstrap.js') ?>"></script>

    <title>SISE-ACM-OJ</title>

    <style>
        body {
            font-family: "微软雅黑", "MSYH", "Microsoft Yahei", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
        }

        h1, h2, h3, h4, h5, h6, strong, b {
            font-family: "微软雅黑", "MSYH", "Microsoft Yahei", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            text-shadow: 1px 1px 2px #BBB;
        }

        #login-block {
            width: 500px;
            margin: 30px auto 0;
            padding: 20px 30px;
        }

        #login-block {
            border: 1px solid #e5e5e5;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 10px 0 rgba(200, 200, 200, 0.7);
        }
    </style>
</head>
<body>
<div>
    <div id="login-block">
        <h2 class="text-center">SISE ACM</h2>

        <h1 class="text-center">Online Judge System</h1>

        <h2 class="text-center"><b>用户注册</b></h2>

        <hr>

        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('api/register'); ?>">
            <div class="form-group">
                <label for="inputUsername" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">用户名</label>

                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <input type="text" class="form-control" id="inputUsername" name="Username" placeholder="请输入用户名" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword1" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">密码</label>

                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <input type="password" class="form-control" id="inputPassword1" name="Password1" placeholder="请输入密码" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword2" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">验证</label>

                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <input type="password" class="form-control" id="inputPassword2" name="Password2" placeholder="请再输入一次" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default">注册</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
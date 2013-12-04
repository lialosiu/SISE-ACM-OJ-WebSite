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
    <script type="text/javascript" src="<?php echo base_url('public/bootstrap-3.0.0/js/bootstrap.js') ?>"></script>
    <link href="<?php echo base_url('public/bootstrap-3.0.0/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen"/>

    <!-- TinyMCE -->
    <script type="text/javascript" src="<?php echo base_url('public/tinymce_4.0.11/js/tinymce/tinymce.min.js') ?>"></script>

    <!-- SyntaxHighlighter -->
    <script type="text/javascript" src="<?php echo base_url('public/syntaxhighlighter_3.0.83/scripts/shCore.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/syntaxhighlighter_3.0.83/scripts/shBrushCpp.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/syntaxhighlighter_3.0.83/scripts/shBrushJava.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/syntaxhighlighter_3.0.83/scripts/shBrushPlain.js') ?>"></script>
    <link href="<?php echo base_url('public/syntaxhighlighter_3.0.83/styles/shCore.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('public/syntaxhighlighter_3.0.83/styles/shThemeOJ.css') ?>" rel="stylesheet" type="text/css"/>

    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo base_url('public/DataTables-1.9.4/media/js/jquery.dataTables.min.js') ?>"></script>
    <link href="<?php echo base_url('public/DataTables-1.9.4/media/css/jquery.dataTables.css') ?>" rel="stylesheet" type="text/css"/>

    <!-- CSS -->
    <link href="<?php echo base_url('public/CSS/home.css') ?>" rel="stylesheet" type="text/css"/>

    <title>SISE ACM-ICPC Online Judge</title>

    <script type="text/javascript">
        var LatestNotificationID = -1;
        var Interval_checkNotification;
        $(document).ready(function () {
            SyntaxHighlighter.all();
            $.extend(true, $.fn.dataTable.defaults, {
                "sDom": '<"panel-heading"lf>rt<"panel-footer"ip><"clearfix">',
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条结果",
                    "sZeroRecords": "无数据",
                    "sEmptyTable": "无数据",
                    "sInfo": "_START_ ~ _END_ (共 _TOTAL_ 条) ",
                    "sInfoEmpty": "无数据",
                    "sInfoFiltered": "(从 _MAX_ 条中过滤)",
                    "sSearch": "搜索：",
                    "oPaginate": {
                        "sFirst": "<<",
                        "sPrevious": "<",
                        "sNext": ">",
                        "sLast": ">>"
                    }
                },
                "aaSorting": [
                    [ 0, "desc" ]
                ]
            });
            Interval_checkNotification = setInterval("checkNotification()", 10000);
        });

        function checkNotification() {
            $.ajax({
                url: '<?php echo base_url('api/getNotificationListAsJson')?>',
                type: "post",
                data: {},
                success: function (data) {
                    try {
                        var NotificationList = $.parseJSON(data);
                        if (NotificationList.length === 0) {
                            LatestNotificationID = 0;
                        } else {
                            if (LatestNotificationID === -1)
                                LatestNotificationID = NotificationList[NotificationList.length - 1].ID;
                            else if (LatestNotificationID < NotificationList[NotificationList.length - 1].ID) {
                                $('#NotificationModal').find('.modal-title').html(NotificationList[NotificationList.length - 1].Title);
                                $('#NotificationModal').find('.modal-body').html(NotificationList[NotificationList.length - 1].Content);
                                LatestNotificationID = NotificationList[NotificationList.length - 1].ID;
                                $('#NotificationModal').modal();
                            }
                        }
                    } catch (e) {
                        console.log(e);
                        clearInterval(Interval_checkNotification);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus);
                    clearInterval(Interval_checkNotification);
                }
            });
        }
    </script>

</head>
<body style="background: url(<?php echo base_url('public/images/bg.gif'); ?>) repeat;">
<!-- Modal -->
<div class="modal fade" id="NotificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loading" style="position: fixed;top :0;left: 0;bottom: 0;right: 0; background-color: rgba(0,0,0,0.5); z-index: 99;display: none;">
    <div class="progress progress-striped active" style="position: absolute;top: 48%;left:30px;right:30px;box-shadow: 0 0 10px 1px #000;">
        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
        </div>
    </div>
</div>
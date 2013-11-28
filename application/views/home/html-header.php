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
        $(document).ready(function () {
            SyntaxHighlighter.all();
            $.extend(true, $.fn.dataTable.defaults, {
                "sDom"           : '<"panel-heading"lf>rt<"panel-footer"ip><"clearfix">',
                "sPaginationType": "full_numbers",
                "oLanguage"      : {
                    "sLengthMenu"  : "每页显示 _MENU_ 条结果",
                    "sZeroRecords" : "无数据",
                    "sEmptyTable"  : "无数据",
                    "sInfo"        : "_START_ ~ _END_ (共 _TOTAL_ 条) ",
                    "sInfoEmpty"   : "无数据",
                    "sInfoFiltered": "(从 _MAX_ 条中过滤)",
                    "sSearch"      : "搜索：",
                    "oPaginate"    : {
                        "sFirst"   : "<<",
                        "sPrevious": "<",
                        "sNext"    : ">",
                        "sLast"    : ">>"
                    }
                }
            });
        });
    </script>

</head>
<body style="background: url(<?php echo base_url('public/images/bg.gif'); ?>) repeat;">
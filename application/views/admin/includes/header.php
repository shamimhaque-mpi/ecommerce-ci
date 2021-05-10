<!DOCTYPE html>
<html lang="en" ng-app="MainApp">
<head>
    <?php
        $site_info = read('header');
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="<?php echo isset($meta_keyword) ? $meta_keyword : ''; ?>">
    <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>">

    <title><?php echo ucwords($meta_title); ?></title>
    <!-- favicon -->
    <link rel="icon" href="<?php echo site_url(isset($site_info) ? $site_info[0]->fev_icon : ''); ?>" type="image/x-icon" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('private/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Bootstrap Date Picker -->
    <link href="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">

    <!-- Bootstrap file upload CSS -->
    <link href="<?php echo site_url('private/plugins/bootstrap-fileinput-master/css/fileinput.min.css') ;?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('private/css/simple-sidebar.css'); ?>" rel="stylesheet">

    <!-- Awesome Font CSS -->
    <link href="<?php echo site_url('private/css/font-awesome.min.css'); ?>" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?php echo site_url('private/css/profile.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/form.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/top-nav.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('private/css/style.css'); ?>" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="<?php echo site_url('private/css/responsive.css'); ?>" rel="stylesheet">
    <!-- Freelance iT Lab official CDN -->
    <link href="<?php echo site_url('private/css/fit_official.css'); ?>"  rel="stylesheet">


    <!-- Angular -->
    <script type="text/javaScript" src="<?php echo site_url('private/js/angular.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/js/angular-sanitize.min.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/js/dirPagination.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/js/ng-controller/app.js'); ?>"></script>

    <!-- jQuery -->
    <script type="text/javaScript" src="<?php echo site_url('private/js/jquery.js'); ?>"></script>

    <!-- includ moment for bootstrap calander -->
    <script type="text/javascript" src="<?php echo site_url('private/js/Moment.js'); ?>"></script>
    <script type="text/javaScript" src="<?php echo site_url('private/plugins/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js') ;?>"></script>
    <!-- texteditor Core Javascript -->
    
    <!-- CHART -->
    <script src="<?php echo site_url('private/js/loader.js'); ?>"></script>
    <script src="<?php echo site_url('private/plugins/tinymce/js/tinymce/tinymce.min.js')?>"></script>

    <script type="text/javascript" src="<?php echo site_url('private/js/inwordbn.js'); ?>"></script>

    <script>
            // Texteditor Script
            tinymce.init({
                selector: '#tinyTextarea',
                theme: 'modern',
                plugins: [
                  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                  'save table contextmenu directionality emoticons template paste textcolor'
                ],
                // content_css: 'css/content.css',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | code',
                skin: 'lightgray',
                content_css: "<?php echo site_url('private/css/tinymce.css'); ?>"
            });

    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <script src="<?=site_url('node_modules/axios/dist/axios.js')?>"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

</head>

<body>
    <div id="wrapper">

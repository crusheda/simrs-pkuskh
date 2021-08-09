<head>

    <!-- **** your site other content **** -->

    <!-- 1. Addchat css -->
    <link href="<?php echo asset('assets/addchat/css/addchat.min.css') ?>" rel="stylesheet">

</head>
<body>

    <!-- 2. AddChat widget -->
    <div id="addchat_app" 
        data-baseurl="<?php echo url('') ?>"
        data-csrfname="<?php echo 'X-CSRF-Token' ?>"
        data-csrftoken="<?php echo csrf_token() ?>"
    ></div>

    
    <!-- **** your site other content **** -->


    <!-- 3. AddChat JS -->
    <!-- Modern browsers -->
    <script type="module" src="<?php echo asset('assets/addchat/js/addchat.min.js') ?>"></script>
    <!-- Fallback support for Older browsers -->
    <script nomodule src="<?php echo asset('assets/addchat/js/addchat-legacy.min.js') ?>"></script>

</body>
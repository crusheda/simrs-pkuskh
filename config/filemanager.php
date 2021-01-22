<?php
return [
    'base_route'      => 'admin/filemanager', // admin/filemanager
    'middleware'      => ['web', 'auth'],
    'allow_format'    => 'jpeg,jpg,png,gif,webp,docx,pdf,xls,doc,xlsx',
    'max_size'        => 500,
    'max_image_width' => 1024,
    'image_quality'   => 80,
];
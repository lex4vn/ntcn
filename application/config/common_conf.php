<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

//Config number limit
    $config['admin_num_limit'] = 10;
    $config['admin_limit_20']  = 20;

    $config['page_limit_20'] = 20;
    $config['page_limit_10'] = 10;
    $config['page_limit_5']  = 5;
    $config['page_limit_2']  = 2;

//Config thumb image
    $config['name_dir_upload']      = 'uploads';
    $config['thumb_img_article']    = array('177-118');
    $config['thumb_thietke_img']    = array('250-250', '240-160');
    $config['thumb_product_img']    = array('250-167');
    $config['thumb_category_img']   = array('85-85');
    $config['thumb_categorysp_img'] = array('85-57');
    $config['thumb_img_album']      = array('195-130');

    $config['pages'] = array(
        'all'       => 'Toàn trang',
        'home'      => 'Trang chủ',
        'spnoithat' => 'Nội thất',
        'thietke'   => 'Thiết kế',
    );

    $config['positions'] = array(
        'bntop'   => 'Banner Top',
        'hotline' => 'Hotline',
        'slider'  => 'Slider',
        'sliderr' => 'Slider Right',
        'sliderb' => 'Slider Bottom',
//    'top' => 'Trên đầu',
//    'left' => 'Bên trái',
//    'middle' => 'Ở giữa',
//    'right' => 'Bên phải',
//    'bottom' => 'Phía dưới'
    );

    $config['mail']['protocol']     = 'smtp';
    $config['mail']['smtp_host']    = 'ssl://smtp.googlemail.com';
    $config['mail']['smtp_port']    = '465';
    $config['mail']['smtp_timeout'] = '30';
    $config['mail']['smtp_user']    = '';
    $config['mail']['smtp_pass']    = '';
    $config['mail']['charset']      = 'utf-8';
    $config['mail']['newline']      = "\r\n";
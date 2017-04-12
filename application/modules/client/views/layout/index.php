<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="<?php echo(isset($_meta['description']) ? $_meta['description'] : ''); ?>" />
        <meta name="keywords" content="<?php echo(isset($_meta['keywords']) ? $_meta['keywords'] : ''); ?>" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <link rel="icon" href="<?php echo img_link('favicon.ico'); ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo img_link('favicon.ico'); ?>" type="image/x-icon" />

        <link href="https://plus.google.com/+noithatcnm/posts" rel="publisher" />
        <link rel="author" href="https://plus.google.com/103550164574656666976" />
        <link rel="canonical" href="<?php echo $_SERVER['HTTP_REFERER'] ?>" />
        <meta itemprop="url" content="<?php echo $_SERVER['HTTP_REFERER'] ?>" />
        <meta property="og:url" content="<?php echo $_SERVER['HTTP_REFERER'] ?>" />
        <?php
        echo '<meta itemprop="name" content="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" />';
        echo '<meta itemprop="description" content="' . (isset($_meta['description']) ? $_meta['description'] : '') . '" />';
        echo '<meta property="og:title" content="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" />';
        echo '<meta property="og:description" content="' . (isset($_meta['description']) ? $_meta['description'] : '') . '" />';

        if (isset($row_news)) {
            if ($row_news->image != '') {
                $img = $uri_root . $row_news->image;
                $img = preg_replace('/thumb_\d+-\d+\//', '', $img);
            } else {
                $img = img_link('logo.jpg');
            }
            echo '<meta itemprop="image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<meta property="og:image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<meta id="facebookOgimage" itemprop="og:image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<link rel="image_src" type="image/jpeg" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" href="' . $img . '" />';
            ?>
            <?php
        } else {
            if (isset($category_image))
                $img = $uri_root . $category_image;
            else
                $img = img_link('logo.jpg');
            echo '<meta itemprop="image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<meta property="og:image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<meta id="facebookOgimage" itemprop="og:image" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" content="' . $img . '" />';
            echo '<link rel="image_src" type="image/jpeg" alt="' . (isset($_meta['title']) ? $_meta['title'] : '') . '" href="' . $img . '" />';
        }
        ?>

        <link rel="stylesheet" type="text/css" href="<?php echo css_link('media.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_link('style.css') ?>" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_link('style2.css') ?>" media="print" />
        <script type="text/javascript" src="<?php echo js_link('prototype1.7.js') ?>"></script>

        <script type="text/javascript">
            //<![CDATA[
            var infortisTheme = {};
            infortisTheme.responsive = true;
            infortisTheme.maxBreak = 960;

            //]]>
        </script>
    </head>
    <?php
    $class = 'cms-index-index cms-home';
    if ($c_module == 'html' || isset($row_news))
        $class = 'catalog-category-view cms-page-view';
    elseif ($c_module == 'news' || $c_module == 'spnoithat' || $c_module == 'thietke')
        $class = 'catalog-category-view';
    ?>
    <body class="<?php echo $class ?>">
        <?php if ($c_module == 'home') { ?>
            <h1 style="position: absolute; text-indent: -99999px"><?php echo(isset($_meta['title']) ? $_meta['title'] : ''); ?></h1>
        <?php } ?>
        <div id="root-wrapper">
            <div class="wrapper">
                <div class="page">
                    <div class="header-container" id="top">
                        <div class="bgtop">
                        <div class="header-container2">
                            <div class="header-container3">
                                <div class="header container stretched">
                                    <div class="bg_top_head">
                                        <div class="ensure">
                                            <div class ="col_bg cola"></div>
                                            <div class ="col_bg cole">
                                                <ul class="links">
                                                    <li><a href="<?php echo $uri_root ?>">Sitemap</a></li>
                                                    <li><a href="<?php echo $uri_root ?>lien-he.html">Liên hệ</a></li>
                                                    <li><a href="<?php echo $uri_root ?>tin-tuc.html">Tin tức</a></li>
                                                    <li class="first log-in"><a href="<?php echo $uri_root ?>">Trang chủ</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid-full">
                                        <div class="header-top clearer"></div>
                                        <div class="header-main v-grid-container">
                                            <div class="logo-wrapper v-grid no-gutter grid12-3">
                                                <a href="<?php echo $uri_root ?>" title="Noithatcnm.com" class="logo"><strong>Noithatcnm.com</strong><img src="<?php echo img_link('logo-noithat-cnm.png') ?>" alt="Noithatcnm.com" /></a>
                                            </div>
                                            <div class="middle_head">
                                                <div class="search-wrapper-centered clearer v-grid no-gutter grid12-6  search-wrapper search-wrapper-mobile box_search_newdes">
                                                    <div class="block-header">
                                                        <?php echo isset($block_modules['module_top']) ? $block_modules['module_top'][1] : '' ?>
                                                    </div>
                                                    <form id="search_mini_form" action="<?php echo $uri_root ?>" method="get">
                                                        <div class="form-search">
                                                            <div class="button_search">
                                                                <button type="submit" title="Tìm kiếm" class="button"><span><span>Tìm kiếm</span></span></button>
                                                            </div>
                                                            <div style="float:right">
                                                                <div class="selectParent">
                                                                    <select name="c">
                                                                        <option value="">Chọn danh mục</option>
                                                                        <option value="1">Thiết kế</option>
                                                                        <option value="2"<?php echo (isset($_GET["c"]) && $_GET["c"] == 2 ? ' selected=""' : ""); ?>>Sản phẩm nội thất</option>
                                                                        <option value="3"<?php echo (isset($_GET["c"]) && $_GET["c"] == 3 ? ' selected=""' : ""); ?>>Tin tức</option>
                                                                        <?php
//                                                                        foreach ($thietke_tree as $i => $value) {
//                                                                            if ($value->pid == 0) {
//                                                                                echo '<option value="1:' . $value->id . '">' . $value->name . '</option>';
//                                                                            }
//                                                                        }
//                                                                        foreach ($product_tree as $value) {
//                                                                            if ($value->pid == 0 && $value->tab == 1) {
//                                                                                echo '<option value="2:' . $value->id . '">' . $value->name . '</option>';
//                                                                            }
//                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <input id="search" type="text" name="s" value="<?php echo (isset($_GET["s"]) ? $_GET["s"] : ""); ?>" class="input-text" maxlength="128" />
                                                            </div>
                                                            <script type="text/javascript">
                                                                //<![CDATA[
                                                                var searchForm = new Varien.searchForm('search_mini_form', 'search', 'Nhập từ khóa cần tìm');
                                                                //]]>
                                                            </script>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="nav-container" id="sticky-nav-container">
                                    <div class="nav container clearer stretched show-bg">
                                        <ul id="nav" class="grid-full wide">
                                            <?php
                                            foreach ($thietke_tree as $i => $value) {
                                                if ($value->pid == 0) {
                                                    $thietke_link = thietke_link($value->name_link);
                                                    ?>
                                                    <li class="level0 nav-<?php echo $value->id ?> level-top parent">
                                                        <a class="item1" href="<?php echo $thietke_link ?>">
                                                            <span><?php echo $value->name ?></span><div class="caret">&nbsp;</div>
                                                        </a>
                                                        <?php
                                                        $str = '';
                                                        foreach ($thietke_tree as $i2 => $value2) {
                                                            if ($value->id == $value2->pid) {
                                                                $thietke_link = thietke_link($value2->name_link);
                                                                $view_title = view_title($value2->name);
                                                                if ($value2->image != '')
                                                                    $img = $uri_root . $value2->image;
                                                                else
                                                                    $img = img_link('logo.jpg');
                                                                $str.='<li class="level1 nav-' . $value->id . '-' . $i2 . ' parent item">
                                                                    <div class="nav-block nav-block-level1-top std">
                                                                        <p><a href="' . $thietke_link . '"><img width="85" height="85" style="display: block; margin-left: auto; margin-right: auto;" src="' . $img . '" alt="' . $view_title . '" /></a></p>
                                                                    </div>
                                                                    <a href="' . $thietke_link . '">
                                                                        <span>' . $value2->name . '</span>
                                                                    </a>
                                                                ';

                                                                $str2 = '';
                                                                foreach ($thietke_tree as $i3 => $value3) {
                                                                    if ($value2->id == $value3->pid) {
                                                                        $thietke_link = thietke_link($value3->name_link);
                                                                        $str2.='<li><a href="' . $thietke_link . '" target="_self">' . $value3->name . '</a></li>';
                                                                    }
                                                                }
                                                                if ($str2 != '')
                                                                    $str2 = '<div class="nav-block nav-block-level1-bottom std"><ul>' . $str2 . '</ul></div>';

                                                                $str.=$str2;
                                                                $str.='</li>';
                                                                ?>
                                                                <?php
                                                            }
                                                        }
                                                        if ($str != '')
                                                            $str = '<div class="level0-wrapper dropdown-6col"><div class="nav-block nav-block-center itemgrid itemgrid-4col"><ul class="level0 submenutk-'.$value->id.'">' . $str . '</ul></div></div>';
                                                        echo $str;
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            $count = 0;
                                            foreach ($product_tree as $value) {
                                                if ($value->pid == 0 && $value->tab == 1) {
                                                    $count++;
                                                    $url = product_link($value->name_link);
                                                    $class = '';
                                                    $class_a = 'item1';
                                                    if ($count == 6) {
                                                        $class = 'last';
                                                        $class_a = '';
                                                    }
                                                    ?>
                                                    <li class="level0 nav-<?php echo $value->id ?> level-top <?php echo $class ?> parent">
                                                        <a class="<?php echo $class_a ?>" href="<?php echo $url ?>">
                                                            <span><?php echo $value->name ?></span><div class="caret">&nbsp;</div>
                                                        </a>
                                                        <?php
                                                        $str = '';
                                                        foreach ($product_tree as $i2 => $value2) {
                                                            if ($value->id == $value2->pid) {
                                                                $url = product_link($value2->name_link);
                                                                $view_title = view_title($value2->name);
                                                                if ($value2->image != '')
                                                                    $img = $uri_root . $value2->image;
                                                                else
                                                                    $img = img_link('logo.jpg');
                                                                $str.='<li class="level1 nav-' . $value->id . '-' . $i2 . ' parent item">
                                                                    <div class="nav-block nav-block-level1-top std">
                                                                        <p><a href="' . $url . '"><img width="85" height="57" style="display: block; margin-left: auto; margin-right: auto;" src="' . $img . '" alt="' . $view_title . '" /></a></p>
                                                                    </div>
                                                                    <a href="' . $url . '">
                                                                        <span>' . $value2->name . '</span>
                                                                    </a>
                                                                ';

                                                                $str2 = '';
                                                                foreach ($product_tree as $i3 => $value3) {
                                                                    if ($value2->id == $value3->pid) {
                                                                        $url = product_link($value3->name_link);
                                                                        $str2.='<li><a href="' . $url . '" target="_self">' . $value3->name . '</a></li>';
                                                                    }
                                                                }
                                                                if ($str2 != '')
                                                                    $str2 = '<div class="nav-block nav-block-level1-bottom std"><ul>' . $str2 . '</ul></div>';

                                                                $str.=$str2;
                                                                $str.='</li>';
                                                                ?>
                                                                <?php
                                                            }
                                                        }
                                                        if ($str != '')
                                                            $str = '<div class="level0-wrapper dropdown-6col"><div class="nav-block nav-block-center itemgrid itemgrid-4col"><ul class="level0 submenu-'.$value->id.'">' . $str . '</ul></div></div>';
                                                        echo $str;
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>

                                        <script type="text/javascript">
                                            //<![CDATA[
                                            jQuery(function($) {
                                                $("#nav > li").hover(function() {
                                                    var el = $(this).find(".level0-wrapper");
                                                    el.hide();
                                                    el.css("left", "0");
                                                    el.stop(true, true).delay(150).fadeIn(300, "easeOutCubic");
                                                }, function() {
                                                    $(this).find(".level0-wrapper").stop(true, true).delay(300).fadeOut(300, "easeInCubic");
                                                });
                                            });
                                            //]]>
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <?php $this->load->view($tmpl) ?>

                    <div class="footer-container">
                        <div class="footer-container2">
                            <div class="footer-primary-container section-container">
                                <div class="footer-primary footer container">
                                    <div class="grid-full no-gutter">
                                        <div class="footer-wrapper">
                                            <div class="section clearer">
                                                <?php echo isset($block_modules['module_footer']) ? $block_modules['module_footer'][1] : '' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="#top" id="scroll-to-top">To top</a>
                        </div>
                    </div>
                    <script type="text/javascript">
                        //<![CDATA[
                        jQuery.fn.cdvnPopup.defaults.threshold = 960;
                        jQuery(function($) {
                            $(".main").addClass("show-bg");
                            var windowScroll_t;
                            $(window).scroll(function(){
                                clearTimeout(windowScroll_t);
                                windowScroll_t = setTimeout(function() {
                                    if ($(this).scrollTop() > 100){
                                        $('#scroll-to-top').fadeIn();
                                    }
                                    else{
                                        $('#scroll-to-top').fadeOut();
                                    }

                                }, 500);

                            });

                            $('#scroll-to-top').click(function(){
                                $("html, body").animate({scrollTop: 0}, 600, "easeOutCubic");
                                return false;
                            });

                            //Window size variables
                            var winWidth = $(window).width();
                            var winHeight = $(window).height();
                            var windowResize_t;
                            $(window).resize(function() {

                                var winNewWidth = $(window).width();
                                var winNewHeight = $(window).height();
                                if (winWidth != winNewWidth || winHeight != winNewHeight){
                                    clearTimeout(windowResize_t);
                                    windowResize_t = setTimeout(function() {
                                        $(document).trigger("themeResize");
                                        $('.itemslider').each(function(index) {
                                            var flex = $(this).data('flexslider');
                                            if (flex != null){
                                                flex.flexAnimate(0);
                                                flex.resize();
                                            }
                                        });

                                        var slideshow = $('.the-slideshow').data('flexslider');
                                        if (slideshow != null){
                                            slideshow.resize();
                                        }
                                    }, 100); //TODO: choose default value
                                } //end: if
                                //Update window size variables
                                winWidth = winNewWidth;
                                winHeight = winNewHeight;
                            }); //end: on resize
                        }); /* end: jQuery(){...} */

                        jQuery(window).load(function(){
                            //Stickyjs : keep menu on top during scroll, on desktop only
                            var mobileTreshold = 960;
                            if (jQuery(window).width() >= mobileTreshold) {
                                jQuery("#sticky-nav-container").sticky({ topSpacing: 0, className:"sticky" });
                            }

                            jQuery('.products-grid > .item').hover(function() {
                                jQuery(this).addClass('hover-style');
                            }, function() {
                                jQuery(this).removeClass('hover-style');
                            });
                        }); /* end: jQuery(window).load(){...} */
                        //]]>
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
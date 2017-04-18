<?php
$slider = '';
//$slider_title = '';
$bntop = '';
//$count_slider = 0;
//$sliderr = '';
//$sliderb = '';
//$sliderb_count = 1;
foreach ($banner as $v) {
    if ($v->position == 'slider' && ($v->page == 'all' || $v->page == $c_module)) {
        $slider .='<div><img u="image" src2="' . site_url($v->image) . '" /></div>';
        
//        $slider .='<li class="slide"><p><a title="' . view_title($v->name) . '" href="' . $v->url . '" target="_self"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></p></li>';
//        $class = '';
//        if ($count_slider == 0)
//            $class = ' active';
//        $slider_title .='<div style="width: 25%" class="slide-control' . $class . '" id="slide-control-' . $count_slider . '">
//                                <div class="cursor"></div>
//                                <div class="link">
//                                    <a class="title">' . $v->name . '</a>
//                                </div>
//                            </div>';
//        $count_slider++;
    } elseif ($v->position == 'bntop' && ($v->page == 'all' || $v->page == $c_module)) {
        $bntop .='<p><a title="' . view_title($v->name) . '" href="' . $v->url . '" target="_self"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></p>';
//    } elseif ($v->position == 'sliderr' && ($v->page == 'all' || $v->page == $c_module)) {
//        $sliderr .='<div><a title="' . view_title($v->name) . '" href="' . $v->url . '" target="_blank"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></div>';
//    } elseif ($v->position == 'sliderb' && ($v->page == 'all' || $v->page == $c_module)) {
//        $sliderb .='<div class="col-' . $sliderb_count . '"><a href="' . $v->url . '"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></div>';
//        $sliderb_count++;
    }
}
?>

<div class="main-container col1-layout">
    <div class="main container">
        <div id="banner_for_header"><?php echo $bntop ?></div>
        <div class="preface grid-full in-col1 no-gutter">    
            <div class="slideshow-container hide-below-768">
                
                <div id="slider1_container" style="display: none; position: relative; margin: 0 auto; width: 1117px;height: 200px; overflow: hidden;">
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;background-color: #000; top: 0px; left: 0px;width: 100%; height:100%;"></div>
                        <div style="position: absolute; display: block; background: url(<?php echo img_link('ajax-loader-big.gif')?>) no-repeat center center;top: 0px; left: 0px;width: 100%;height:100%;"></div>
                    </div>
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1117px; height: 200px;overflow: hidden;">
                        <?php echo $slider?>
                    </div>
                    <style type="text/css">
                        /* jssor slider bullet navigator skin 05 css */
                        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                            background: url(<?php echo img_link('b05.png')?>) no-repeat;
                            overflow: hidden;
                            cursor: pointer;
                        }

                        .jssorb05 div {
                            background-position: -7px -7px;
                        }

                        .jssorb05 div:hover, .jssorb05 .av:hover {
                            background-position: -37px -7px;
                        }

                        .jssorb05 .av {
                            background-position: -67px -7px;
                        }

                        .jssorb05 .dn, .jssorb05 .dn:hover {
                            background-position: -97px -7px;
                        }
                    </style>
                    <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
                        <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
                    </div>
                    <style type="text/css">
                        .jssora11l, .jssora11r, .jssora11ldn, .jssora11rdn {
                            position: absolute;
                            cursor: pointer;
                            display: block;
                            background: url(<?php echo img_link('a11.png')?>) no-repeat;
                            overflow: hidden;
                        }

                        .jssora11l {
                            background-position: -11px -41px;
                        }

                        .jssora11r {
                            background-position: -71px -41px;
                        }

                        .jssora11l:hover {
                            background-position: -131px -41px;
                        }

                        .jssora11r:hover {
                            background-position: -191px -41px;
                        }

                        .jssora11ldn {
                            background-position: -251px -41px;
                        }

                        .jssora11rdn {
                            background-position: -311px -41px;
                        }
                    </style>
                    <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;"></span>
                    <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px"></span>
                </div>
                <script src="<?php echo js_link('ie10-viewport-bug-workaround.js') ?>"></script>
                <script type="text/javascript" src="<?php echo js_link('jssor.slider.mini.js') ?>"></script>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        var options = {
                            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                            $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                            $AutoPlayInterval: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                            $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                            $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                            $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                            $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                            $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                            //$SlideWidth: 1087,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                            //$SlideHeight: 200,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                            $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                            $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                            $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                            $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                            $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                            $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                            $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                                $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                                $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                                $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                                $Scale: false,                                  //Scales bullets navigator or not while slider scale
                            },

                            $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                                $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                                $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                                $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                                $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                                $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                                $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                                $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                                $Scale: false                                  //Scales bullets navigator or not while slider scale
                            }
                        };

                        $("#slider1_container").css("display", "block");
                        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                    });
                </script>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-main grid-full in-col1 no-gutter">
            <div class="std">  
                <?php
                $background = array();
                $background[] = '#E74C3C';
                $background[] = '#E67E22';
                $background[] = '#2980B9';
                $background[] = '#27AE60';
                $background[] = '#4CBFB0';
                $background[] = '#D44467';
                $background[] = '#7A3463';
                $background[] = '#633979';

                $background[] = '#E74C3C';
                $background[] = '#E67E22';
                $background[] = '#2980B9';
                $background[] = '#27AE60';
                $background[] = '#4CBFB0';
                $background[] = '#D44467';
                $background[] = '#7A3463';
                $background[] = '#633979';
                $count = 0;

                foreach ($thietke as $key => $item) {
                    if (count($item) < 4)
                        continue;
                    $count++;
                    $url = '';
                    $name = '';
                    foreach ($thietke_tree as $value) {
                        if ($value->id == $key) {
                            $url = thietke_link($value->name_link);
                            $name = $value->name;
                            break;
                        }
                    }
                    ?>
                    <p></p>
                    <div class="product-slider-container" id="product-slider-<?php echo $key ?>" style="background-color:<?php echo $background[$count - 1] ?>">
                        <div class="slide-title">
                            <div class="controls">
                                <div class="nav-wrapper gen-slider-arrows1"></div>
                                <a class="title" href="<?php echo $url ?>"><?php echo $name ?></a>
                            </div>
                        </div>
                        <div class="content">
                            <div class="itemslider-wrapper">
                                <div class="itemslider itemslider-horizontal itemslider-responsive">
                                    <ul class="slides products-grid centered equal-height size-s">
                                        <?php
                                        foreach ($item as $i => $value) {
                                            $view_title = view_title($value->title);
                                            $url = thietke_link($value->title_link);

                                            if ($value->image != '') {
                                                $img = $uri_root . $value->image;
                                            } else {
                                                $img = img_link('logo.jpg');
                                            }
                                            ?>
                                            <li class="item">
                                                <div class="item-wrapper">
                                                    <div class="product-image-wrapper imgnoresize" style="width:250px;">
                                                        <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="product-image">
                                                            <?php if ($count > 2) { ?>
                                                                <img width="250" src="<?php echo $img ?>" data-src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                            <?php } else { ?>
                                                                <img width="250" src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                            <?php } ?>
                                                        </a>
                                                    </div> 
                                                    <h3 class="product-name"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo $value->title ?></a></h3>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>     
                    <script type="text/javascript">
                        //<![CDATA[
                        jQuery(function($) {
                            $('#product-slider-<?php echo $key ?> .itemslider').flexslider({
                                namespace: "",
                                animation: "slide",
                                easing: "easeInQuart",

                                slideshow: false,
                                animationLoop: false,
                                                                                
                                initDelay: 1000,
                                                                                
                                                                                
                                pauseOnHover: true,
                                controlNav: false,
                                controlsContainer: "#product-slider-<?php echo $key ?> .nav-wrapper",

                                itemWidth: 300,
                                minItems: 4,
                                maxItems: 8,
                                                                                
                                move: 0            })
                            .data("showItems", 8 )
                            ; //IMPORTANT: don't remove semicolon!

                        });
                        //]]>
                    </script>
                    <?php
                }

                foreach ($product as $key => $item) {
                    if (count($item) < 4)
                        continue;
                    $count++;
                    $url = '';
                    $name = '';
                    foreach ($product_tree as $value) {
                        if ($value->id == $key) {
                            $url = product_link($value->name_link);
                            $name = $value->name;
                            break;
                        }
                    }
                    ?>
                    <p></p>
                    <div class="product-slider-container" id="product-slider2-<?php echo $key ?>" style="background-color:<?php echo $background[$count - 1] ?>">
                        <div class="slide-title">
                        <div class="controls">
                            <div class="nav-wrapper gen-slider-arrows1"></div>
                            <a class="title" href="<?php echo $url ?>"><?php echo $name ?></a>
                        </div>
                        </div>
                        <div class="content">
                            <div class="itemslider-wrapper">
                                <div class="itemslider itemslider-horizontal itemslider-responsive">
                                    <ul class="slides products-grid centered equal-height size-s">
                                        <?php
                                        foreach ($item as $i => $value) {
                                            $view_title = view_title($value->title);
                                            $url = product_link($value->title_link);

                                            if ($value->image != '') {
                                                $img = $uri_root . $value->image;
                                            } else {
                                                $img = img_link('logo.jpg');
                                            }
                                            ?>
                                            <li class="item">
                                                <div class="item-wrapper">
                                                    <h3 class="product-code"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo ($value->catid == 19 || $value->catid == 93 || $value->catid == 98 || $value->catid == 101)? '':'Mã SP: '; ?>
                                                            <?php echo $value->code == ''? '&nbsp;':$value->code ?></a></h3>
                                                    <div class="product-image-wrapper" style="width:250px;">
                                                        <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="product-image">
                                                            <img style="width: 24%;height: auto" src="<?php echo $img ?>" data-src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                        </a>
                                                    </div> 
                                                    <div class="product-name"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo $value->title ?></a></div>
                                                    <div class="purchase">
                                                        <div class="price-box">
                                                            <span id="product-price-<?php echo $value->id ?>-new" class="regular-price">
                                                                                                                            <span class="price">
                                                                <?php if(empty($v->source) || $v->source == 0){ ?>
                                                                    &nbsp;
                                                                <?php }else{ ?>
                                                                    <?php echo number_format($v->source, 0, ',', '.') ?> ₫
                                                                <?php } ?>
                                                            </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>     
                    <script type="text/javascript">
                        //<![CDATA[
                        jQuery(function($) {
                            $('#product-slider2-<?php echo $key ?> .itemslider').flexslider({
                                namespace: "",
                                animation: "slide",
                                easing: "easeInQuart",

                                slideshow: false,
                                animationLoop: false,
                                                                                
                                initDelay: 1000,
                                                                                
                                                                                
                                pauseOnHover: true,
                                controlNav: false,
                                controlsContainer: "#product-slider2-<?php echo $key ?> .nav-wrapper",

                                itemWidth: 188,
                                minItems: 4,
                                maxItems: 8,
                                                                                
                                move: 0            })
                            .data("showItems", 16 )
                            ; //IMPORTANT: don't remove semicolon!
                        });
                        //]]>
                                                                        
                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="postscript grid-full in-col1 no-gutter"></div>
    </div>
</div>
<script type="text/javascript">
    /*Prepare lazy load for slide*/
    jQuery.noConflict();

    jQuery(document).ready(function($) {      
        jQuery('a.next').each(function(){                
            var content = jQuery(this).closest('.controls').next();        
            var _5_first_items = jQuery('li.item:lt(5)',content);
            
            _5_first_items.each(function(){
                jQuery('img.lazy:not(.lazy_loaded)',jQuery(this)).addClass('init_lazy');                       
            }); 
            
        });  
        
        jQuery('img.init_lazy').jail({
            event: 'load+scroll',
            //            speed : 10,
            effect: 'fadeIn',
            callbackAfterEachImage : function(_this) {
                jQuery(_this).closest('.item').addClass('lazy_loaded');
                jQuery(_this).addClass('lazy_loaded');
                jQuery(_this).unbind( "scroll");            
            }
        });
        
    });    
    
    /*Lazy load next item in slide when click next */    
    jQuery(document).ready(function($) {

        jQuery('a.next').each(function(){
            jQuery(this).on('click',function(){                                        
                var content = jQuery(this).closest('.controls').next();        
                var _5_next_items = jQuery('li.item:not(.lazy_loaded):lt(5)',content);

                _5_next_items.each(function(){
                    jQuery('img.lazy:not(.lazy_loaded)',jQuery(this)).addClass('next_lazy');
                });

                jQuery('img.next_lazy:not(.lazy_loaded)').jail({
                    event: 'scroll',
                    //                    speed : 10,
                    effect: 'fadeIn',
                    callbackAfterEachImage : function(_this) {
                        jQuery(_this).closest('.item').addClass('lazy_loaded');
                        jQuery(_this).addClass('lazy_loaded');
                    }
                });
                
                //delay 1 second for slide moving
                setTimeout(function(){
                    jQuery('img.next_lazy:not(.lazy_loaded)').trigger('scroll');
                },1000); 

                return false;
            });

        });  
    });
</script>
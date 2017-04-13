<?php
$bntop = '';
foreach ($banner as $v) {
    if ($v->position == 'bntop' && ($v->page == 'all' || $v->page == $c_module)) {
        $bntop .='<p><a title="' . view_title($v->name) . '" href="' . $v->url . '" target="_self"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></p>';
    }
}
?>
<div class="main-container col2-left-layout">
    <div class="main container">
        <div id="banner_for_header"><?php echo $bntop ?></div>
        <div class="breadcrumbs">
            <?php if (isset($pathway)) { ?>
                <ul>
                    <li class="home">
                        <a href="<?php echo $uri_root ?>" title="Trang chủ">
                            <span>Trang chủ</span>
                        </a>
                        <span>/ </span>
                    </li>
                    <?php echo $pathway ?>
                </ul>
            <?php } ?>
        </div>
        <div class="preface grid-full in-col1 no-gutter"></div>
        <div class="col-main grid12-9 grid-col2-main in-col2 no-right-gutter">
            <?php
            if (isset($category_alias) && $category_alias != '')
                echo '<h1 class="product-title">' . $category_name . '</h1>';
            else
                echo '<h1 class="product-title">Sản phẩm nội thất</h1>';
            ?>
            <div class="category-products">
                <div class="slider-category">  
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
                                        
                    $background[] = '#E74C3C';
                    $background[] = '#E67E22';
                    $background[] = '#2980B9';
                    $background[] = '#27AE60';
                    $background[] = '#4CBFB0';
                    $background[] = '#D44467';
                    $background[] = '#7A3463';
                    $background[] = '#633979';
                    
                    $count = 0;

                    foreach ($product as $key => $item) {
                        if (count($item->data) < 4)
                            continue;
                        $count++;
                        $key = $item->cate->id;
                        $url = product_link($item->cate->name_link);
                        $name = $item->cate->name;
                        ?>
                        <p>&nbsp;</p>
                        <div class="product-slider-container" id="product-slider-<?php echo $key ?>" style="background-color:<?php echo $background[$count - 1] ?>">
                            <div class="slide-title"><a class="title" href="<?php echo $url ?>"><?php echo $name ?></a>
                                <div class="controls">
                                    <div class="nav-wrapper gen-slider-arrows1"></div>
                                </div>
                            </div>


                            <div class="content">
                                <div class="itemslider-wrapper">
                                    <div class="itemslider itemslider-horizontal itemslider-responsive">
                                        <ul class="slides products-grid category-products-grid centered equal-height size-s">
                                            <?php
                                            foreach ($item->data as $i => $value) {
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
                                                        <h3 class="product-code"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo ($category->id == 19 || $category->pid == 19)? '':'Mã SP: '; ?><?php echo $value->code ?></a></h3>
                                                        <div class="product-image-wrapper" style="width:198px;">
                                                            <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="product-image">
                                                                <?php if ($count > 4) { ?>
                                                                    <img width="25%" class="lazy" src="<?php echo img_link('loader.gif') ?>" data-src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                                <?php } else { ?>
                                                                    <img width="25%" src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                                <?php } ?>
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

                                    itemWidth: 188,
                                    minItems: 4,
                                    maxItems: 4,
                                                                                            
                                    move: 0            })
                                .data("showItems", 4 )
                                ; //IMPORTANT: don't remove semicolon!
                            });
                            //]]>
                                                                                    
                        </script>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <script type="text/javascript">
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
        </div>

        <?php $this->load->view('layout/left') ?>

        <div class="postscript grid-full in-col1 no-gutter"></div>
    </div>
</div>
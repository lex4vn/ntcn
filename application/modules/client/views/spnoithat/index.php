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
                <ul class="products-grid category-products-grid itemgrid itemgrid-adaptive itemgrid-4col centered hover-effect equal-height size-s">
                    <?php
                    foreach ($news as $i => $value) {
                        $view_title = view_title($value->title);
                        // if (isset($category_alias) && $category_alias != '')
                        //  $url = product_link($category_alias . '/' . $value->title_link);
                        //else
                        $url = product_link($value->title_link);
                        if ($value->image != '')
                            $img = $uri_root . $value->image;
                        else
                            $img = img_link('logo.jpg');
                        $class = '';
                        if (($i + 1) % 4 == 0)
                            $class = ' last';
                        ?>
                        <li class="item<?php echo $class ?>">
                            <div class="item-wrapper">
                                <h3 class="product-code"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo ($value->catid == 19 || $value->catid == 93 || $value->catid == 98 || $value->catid == 101)? '':'Mã SP: '; ?>
                                        <?php echo $value->code == ''? '&nbsp;':$value->code ?></a></h3>
                                <div class="product-image-wrapper" style="width:198px;">
                                    <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="product-image">
                                        <?php if ($i > 11) { ?>
                                            <img width="190" height="127" class="lazy" src="<?php echo img_link('loader.gif') ?>" data-src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                        <?php } else { ?>
                                            <img width="190" height="127" src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
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

                <?php if (isset($pagnav) && trim($pagnav) != '') { ?>
                    <div class="toolbar-bottom">
                        <div class="toolbar">
                            <div class="sorter">
                                <div class="pager f-right">
                                    <div class="pages gen-direction-arrows1">
                                        <?php echo $pagnav ?>
                                    </div>        
                                </div>
                                <p class="view-mode"></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


            <script type="text/javascript">
                jQuery.noConflict();

                jQuery(document).ready(function($) {
                    jQuery('img.lazy').jail({
                        event: 'load+scroll',
                        //                speed : 10,
                        effect: 'fadeIn',
                        callbackAfterEachImage : function(_this) {
                            jQuery(_this).addClass('lazy_loaded');            
                        }
                    });

                });
            </script>
        </div>

        <?php $this->load->view('layout/left') ?>

        <div class="postscript grid-full in-col1 no-gutter"></div>
    </div>
</div>
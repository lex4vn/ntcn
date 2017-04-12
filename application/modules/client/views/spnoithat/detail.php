<?php
$bntop = '';
foreach ($banner as $v) {
    if ($v->position == 'bntop' && ($v->page == 'all' || $v->page == $c_module)) {
        $bntop .='<p><a title="' . view_title($v->name) . '" href="' . $v->url . '" target="_self"><img src="' . site_url($v->image) . '" alt="' . view_title($v->name) . '" /></a></p>';
    }
}

$view_title = view_title($row_news->title);
$created_date = strtotime($row_news->created_date);
//if ($category_alias != '')
//    $url = product_link($category->name_link . '/' . $row_news->title_link);
//else
$url = product_link($row_news->title_link);
if ($row_news->image != '')
    $img = $uri_root . $row_news->image;
else
    $img = img_link('logo.jpg');

$sizes = config_item('thumb_product_img');
if (isset($sizes[0]))
    $img_view = str_replace('/thumb_' . $sizes[0], '', $img);
else
    $img_view = $img;
$img = $img_view;
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
            <div class="category-products">
                <div class="page-title">
                    <h1><?php echo ($category->id == 19 || $category->pid == 19)? 'CĐT: ':'Mã SP: '; ?><?php echo $row_news->code ?></h1>
                </div>
                <div class="content-inner">
                    <table width="100%">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td valign="top">
                                            <h2 class="product-name"><?php echo $row_news->title ?></h2>
                                            <div class="product-image-main product-image zoom-inside">
                                                <a id="zoom1" class="cloud-zoom" href="<?php echo $img_view ?>" rel="position:'inside',showTitle:false,lensOpacity:0.5,smoothMove:3,zoomWidth:640,zoomHeight:427,adjustX:0,adjustY:0"><img style="max-width:640px;max-height:427px" src="<?php echo $img_view ?>" alt="<?php echo $view_title ?>" border="0" /></a>
                                                <a id="zoom-btn" class="lightbox-group zoom-btn-small" href="<?php echo $img_view ?>" title="<?php echo $view_title ?>"><img src="<?php echo img_link('zoom-img.png') ?>" alt="Phóng to" style="margin-top: 5px;"/></a>
                                            </div>
                                        </td>
                                        <td valign="top">
                                            <table class="product-image-view">
                                                <tr>
                                                    <td><div>MẪU SƠN ĐẸP</div></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-01.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-01.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-02.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-02.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-03.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-03.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-04.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-04.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-05.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-05.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-06.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-06.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-07.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-07.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-08.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-08.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-09.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-09.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-10.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-10.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-11.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-11.jpg'); ?>" />
                                                        </a>
                                                        <a class="lightbox-group-2" href="<?php echo img_link('mau-son/mau-son-inhome-12.jpg'); ?>">
                                                            <img width="68" height="68" alt="<?php echo $view_title ?>" src="<?php echo img_link('mau-son/mau-son-inhome-12.jpg'); ?>" />
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php if (count($product_img)) { ?>
                                    <div class="slides_container">
                                        <?php
                                        $sizes = config_item('thumb_img_album');
                                        foreach ($product_img as $i => $value) {
                                            if (($i + 1) % 4 == 1)
                                                echo '<div>';

                                            if ($value->desc != '')
                                                $view_title = view_title($value->desc);

                                            $img = $uri_root . $value->image;
                                            if (isset($sizes[0]))
                                                $img_view = str_replace('/thumb_' . $sizes[0], '', $img);
                                            else
                                                $img_view = $img;
                                            echo '<a class="cloud-zoom-gallery lightbox-group" href="' . $img_view . '" rel="useZoom:\'zoom1\', smallImage:\'' . $img_view . '\'"><img src="' . $img . '" alt="' . $view_title . '" width="195" height="130" /></a>';
                                            if (($i + 1) % 4 == 0)
                                                echo '</div>';
                                        }
                                        if ((count($product_img)) % 4 != 0)
                                            echo '</div>';
                                        ?>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <div class="share">
                        <div class="sharelink">
                            <div class="addthis_toolbox addthis_default_style ">
                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                <a class="addthis_button_tweet"></a>
                                <a class="addthis_button_pinterest_pinit"></a>
                                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                                <a class="addthis_counter addthis_pill_style"></a>
                            </div>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5103400c0edfaf6c"></script>
                        </div>
                    </div>
                    <div class="detail"><?php echo $row_news->content ?></div>

                    <?php if (count($related_news)) { ?>
                        <div class="related-items" style="border-top:1px solid #E0E0E0">
                            <h5>Các sản phẩm <?php echo isset($category->name) ? $category->name . ' ' : '' ?>khác</h5>
                            <div class="related-items-inner">
                                <ul class="products-grid category-products-grid itemgrid itemgrid-adaptive itemgrid-4col centered hover-effect equal-height size-s">
                                    <?php
                                    foreach ($related_news as $i => $v) {
                                        $view_title = view_title($v->title);

                                        // if ($category_alias != '')
                                        //  $url = product_link($category->name_link . '/' . $v->title_link);
                                        //else
                                        $url = product_link($v->title_link);
                                        if ($v->image != '')
                                            $img = $uri_root . $v->image;
                                        else
                                            $img = img_link('logo.jpg');
                                        $class = '';
                                        if (($i + 1) % 4 == 0)
                                            $class = ' last';
                                        ?>
                                        <li class="item<?php echo $class ?>">
                                            <div class="item-wrapper">
                                                <h3 class="product-code"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo ($category->id == 19 || $category->pid == 19)? 'CĐT: ':'Mã SP: '; ?><?php echo $v->code ?></a></h3>
                                                <div class="product-image-wrapper" style="width:190px;">
                                                    <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="product-image">
                                                        <img width="190" height="127" class="lazy" src="<?php echo img_link('loader.gif') ?>" data-src="<?php echo $img ?>" alt="<?php echo $view_title ?>" />
                                                    </a>
                                                </div> 
                                                <div class="product-name"><a href="<?php echo $url ?>" title="<?php echo $view_title ?>"><?php echo $v->title ?></a></div>
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
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php $this->load->view('layout/left') ?>
        <div class="postscript grid-full in-col1 no-gutter"></div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function($) {
        $(".lightbox-group").colorbox({
            rel:'lightbox-group',
            opacity:0.5,
            speed:300,
            current:'image {current} of {total}',
            maxWidth:'95%',
            maxHeight:'95%'
        });
        $(".cloud-zoom-gallery").first().removeClass("cboxElement");
        $(".cloud-zoom-gallery").click(function() {
            $(".cloud-zoom-gallery").each(function() {
                $(this).addClass("cboxElement");
            });
            $(this).removeClass("cboxElement");
        });
        $(".lightbox-group-2").colorbox({
            rel:'lightbox-group-2',
            opacity:0.5,
            speed:300,
            current:'image {current} of {total}',
            maxWidth:'95%',
            maxHeight:'95%'
        });
    });
</script>
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
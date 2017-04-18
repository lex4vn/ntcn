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
//   $url = thietke_link($category->name_link . '/' . $row_news->title_link);
//else
$url = thietke_link($row_news->title_link);

$sizes = config_item('thumb_thietke_img');
if (isset($sizes[0]) && $row_news->image != '')
    $img_view = $uri_root . str_replace('/thumb_' . $sizes[0], '', $row_news->image);
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
        <div class="clear"></div>
        <div class="left">
            <ul class="news">
                <li class="news">
                    <div class="Recipepod">
                        <div>
                            <h1>
                                <span style="padding-right:93px"><?php echo $row_news->title ?></span>
                                <span class="time">
                                    <span class="month">tháng <span><?php echo date('m', $created_date); ?></span></span><span class="year">năm <span><?php echo date('Y', $created_date); ?></span></span><span class="day"><?php echo date('d', $created_date); ?></span>
                                </span>
                            </h1>
                            <?php if ($row_news->image != '') { ?>
                                <a class="lightbox-group" href="<?php echo $img_view ?>"><img src="<?php echo $img_view ?>" alt="<?php echo $view_title ?>" border="0" /></a>
                            <?php }if ($row_news->chudautu != '') { ?>
                                <br/>
                                <div class="desc desc_inhome bold"><a title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $row_news->title ?></a>: <?php echo $row_news->short_desc ?></div>
                                <ul class="info-tk">
                                    <li><a href="javascript:;" class="fr" rel="tooltip" title="<?php echo $row_news->chudautu_content ?>"><?php echo $row_news->chudautu ?></a><a href="javascript:;">Chủ đầu tư<span>:&nbsp;&nbsp;</span></a></li>
                                </ul>
                            <?php } else { ?>
                                <br/>
                                <div class="desc desc_inhome2 bold"><a title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $row_news->title ?></a>: <?php echo $row_news->short_desc ?></div>
                            <?php } ?>
                            <div class="clear"></div>
                            <div class="detail content-inner"><?php echo $row_news->content ?></div>
                        </div>
                    </div>

                    <?php
                    if ($row_news->tags != '') {
                        $arr_tags = explode(',', $row_news->tags);
                        echo '<div class="tag"><span style="color: #7F7F7F;float:left">Tags:&nbsp;</span>';
                        foreach ($arr_tags as $i => $value) {
                            $url_value = urlencode(trim($value));
                            if ($i == 0)
                                echo '<h3><span class="atag">' . trim($value) . '</span></h3>';
                            else
                                echo '<h3><span class="atag">, ' . trim($value) . '</span></h3>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <div class="clear"></div>
                    <br/>
                    <div class="share">
                        <div class="sharelink-thiet-ke">
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
                </li>
            </ul>
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
                });
            </script>

            <?php if (count($related_news)) { ?>
                <div class="other50">
                    <h5 style="color: #000; font-size: 11px; height: 17px; font-weight: normal; float:left; margin:0; width:100%; font-weight:bold">Những <?php echo isset($category->name) ? $category->name . ' ' : '' ?>khác</h5>
                    <div class="cnt">
                        <?php
                        foreach ($related_news as $v) {
                            $view_title = view_title($v->title);

                            // if ($category_alias != '')
                            //  $url = thietke_link($category->name_link . '/' . $v->title_link);
                            //else
                            $url = thietke_link($v->title_link);
                            if ($v->image != '')
                                $img = $uri_root . $v->image;
                            else
                                $img = img_link('logo.jpg');
                            ?>
                            <div class="item">
                                <a href="<?php echo $url ?>" title="<?php echo $view_title ?>" class="thumb">
                                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" width="178" height="119" src="<?php echo $img ?>" /></a>
                                <h4><a title="<?php echo $view_title ?>" href="<?php echo $url ?>" class="title"><?php echo $v->title; ?></a></h4>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php $this->load->view('layout/right') ?>
    </div>
</div>


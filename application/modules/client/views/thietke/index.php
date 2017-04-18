<?php
if (!isset($home_page)) {
    if (isset($category_alias) && $category_alias != '')
        echo '<h1 style="position: absolute; text-indent: -99999px">' . $category_name . '</h1>';
    else
        echo '<h1 style="position: absolute; text-indent: -99999px">Thiết kế</h1>';
}
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
        <div class="clear"></div>
        <div class="left">
            <ul class="news">
                <?php
                $sizes = config_item('thumb_thietke_img');
                foreach ($news as $k => $v) {
                    $view_title = view_title($v->title);
                    $created_date = strtotime($v->created_date);

                    //if (isset($category_alias) && $category_alias != '')
                    //     $url = thietke_link($category_alias . '/' . $v->title_link);
                    // else
                    $url = thietke_link($v->title_link);
                    if (isset($sizes[1]) && $v->image != '')
//            $img = $uri_root . str_replace('/thumb_' . $sizes[0], '/thumb_' . $sizes[1], $v->image);
                        $img = $uri_root . str_replace('/thumb_' . $sizes[0], '', $v->image);
                    ?>
                    <li class="news">
                        <h2>
                            <a rel="canonical" title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $v->title; ?></a>
                            <span class="time">
                                <span class="month">tháng <span><?php echo date('m', $created_date); ?></span></span><span class="year">năm <span><?php echo date('Y', $created_date); ?></span></span><span class="day"><?php echo date('d', $created_date); ?></span>
                            </span>
                        </h2>
                        <?php if ($v->image != '') { ?>
                            <a title="<?php echo $view_title ?>" href="<?php echo $url ?>" class="thumb">
                                <img title="<?php echo $view_title ?>" alt="<?php echo $view_title ?>" src="<?php echo $img ?>" />
                            </a>
                        <?php }
                        if ($v->chudautu != '') { ?>
                            <div class="desc desc_inhome">
                                <b><a rel="canonical" title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $v->title; ?></a>:</b> <?php echo $v->short_desc ?>
                            </div>
                            <ul class="info-tk">
                                <li><a href="javascript:;" class="fr" rel="tooltip" title="<?php echo $v->chudautu_content ?>"><?php echo $v->chudautu ?></a><a href="javascript:;">Chủ đầu tư<span>:&nbsp;&nbsp;</span></a></li>
                                <!--li><a href="javascript:;">Phí thiết kế<span>:</span></a><a href="javascript:;" class="fr" rel="tooltip" title="<?php echo $v->phitk_content ?>"><?php echo $v->phitk ?></a></li-->
                            </ul>
                        <?php } else { ?>
                            <div class="desc desc_inhome2">
                                <b><a rel="canonical" title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $v->title; ?></a>:</b> <?php echo $v->short_desc ?>
                            </div>
                        <?php } ?>
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
        <?php $this->load->view('layout/right') ?>
    </div>
</div>
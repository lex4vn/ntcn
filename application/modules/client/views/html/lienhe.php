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
        <div class="clear"></div>
        <div class="left">
            <div class="box-contact">
                <div class="box-contactin">
                        <h1><?php echo isset($block_modules['module_lienhe']) ? $block_modules['module_lienhe'][0] : '' ?></h1>
                        <div><?php echo isset($block_modules['module_lienhe']) ? $block_modules['module_lienhe'][1] : '' ?></div>
                </div>
            </div>
        </div>
        <?php $this->load->view('layout/right') ?>
    </div>
</div>
<div class="home-top clearfix">
    <div class="adv-home right">
        <?php foreach ($banner as $v) { ?>
            <div class="adver">
                <a target="_blank" href="<?php echo $v->url; ?>" title="<?php echo view_title($v->name); ?>"><img onerror="this.src='<?php echo img_link('imgs-content/banner-xs.gif'); ?>'" src="<?php echo site_url($v->image); ?>" width="300" alt="<?php echo view_title($v->name); ?>" /></a>
            </div>        
        <?php } ?>
    </div>
</div>
<?php
echo '<h1 style="position: absolute; text-indent: -99999px;z-index:-1">Tìm kiếm</h1>';
?>
<form method="get" action="<?php echo $uri_root ?>tim-kiem.html">
    <div class="frm-contact">
        <?php if (isset($message)) { ?>
            <div style="color:red;padding-bottom:10px"><?php echo $message; ?></div>
        <?php } ?>
        <div class="rows clearfix">
            <label>Từ khoá:<em>*</em></label>
            <div class="input-box"><input type="text" name="s" value="<?php echo (isset($_GET["s"]) ? $_GET["s"] : ""); ?>" /></div>
        </div>
        <div class="rows clearfix">
            <label>Danh mục:</label>
            <div class="input-box">
                <select name="c">
                    <option value="">Thiết kế</option>
                    <option value="1"<?php echo (isset($_GET["c"]) && $_GET["c"] == 1 ? ' selected=""' : ""); ?>>Thi công</option>
                    <option value="2"<?php echo (isset($_GET["c"]) && $_GET["c"] == 2 ? ' selected=""' : ""); ?>>Sản phẩm</option>
                    <option value="3"<?php echo (isset($_GET["c"]) && $_GET["c"] == 3 ? ' selected=""' : ""); ?>>Tin tức</option>
                </select>
            </div>
        </div>
        <div class="rows clearfix">
            <label>&nbsp;</label>
            <div class="input-box">
                <button type="submit" class="button"><span><span>Tìm kiếm</span></span></button>
            </div>
        </div>
    </div>
</form>
<p>&nbsp;</p>

<?php if (isset($news) && count($news) > 0) { ?>
    <ul class="news">
        <?php
        $sizes = config_item('thumb_img_article');
        foreach ($news as $k => $v) {
            $view_title = view_title($v->title);
            $created_date = strtotime($v->created_date);

            $url = news_link($v->title_link);
            if (isset($sizes[1]) && $v->image != '')
                $img = $uri_root . str_replace('/thumb_' . $sizes[0], '/thumb_' . $sizes[1], $v->image);
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
                        <img title="<?php echo $view_title ?>" alt="<?php echo $view_title ?>" src="<?php echo $img ?>" width="600" height="400" />
                    </a>
                <?php } ?>
                <div class="desc desc_inhome">
                    <?php echo $v->short_desc ?>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } elseif (!isset($message)) { ?>
    <h2>Không tìm thấy dữ liệu</h2>
<?php } ?>
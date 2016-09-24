<?php
$hotline = '';
foreach ($banner as $v) {
    if ($v->position == 'hotline' && ($v->page == 'all' || $v->page == $c_module)) {
        $hotline = ' style="background:url(' . site_url($v->image) . ') no-repeat scroll 241px 53px transparent"';
    }
}
?>
<div class="right"<?php echo $hotline ?>>
    <div class="pic">
        <h3 class="title">Nhiều lượt xem nhất</h3>
        <div class="cnt">
            <?php
            $thietke_link = thietke_link($mostviews[0]->title_link);
            $view_title = view_title($mostviews[0]->title);
            if ($mostviews[0]->image != '')
                $img = $uri_root . $mostviews[0]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb1">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="240" height="160" />
                    <span class="tt"><?php echo $mostviews[0]->title ?></span>
                </a>
            </h4>
            <div class="br"></div>
            <?php
            $thietke_link = thietke_link($mostviews[1]->title_link);
            $view_title = view_title($mostviews[1]->title);
            if ($mostviews[1]->image != '')
                $img = $uri_root . $mostviews[1]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb2">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                    <span class="tt"><?php echo $mostviews[1]->title ?></span>
                </a>
            </h4>
            <?php
            $thietke_link = thietke_link($mostviews[2]->title_link);
            $view_title = view_title($mostviews[2]->title);
            if ($mostviews[2]->image != '')
                $img = $uri_root . $mostviews[2]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb2 thumblast">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                    <span class="tt"><?php echo $mostviews[2]->title ?></span>
                </a>
            </h4>
            <div class="br"></div>
            <?php
            $thietke_link = thietke_link($mostviews[3]->title_link);
            $view_title = view_title($mostviews[3]->title);
            if ($mostviews[3]->image != '')
                $img = $uri_root . $mostviews[3]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb3">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="117" height="117" />
                    <span class="tt"><?php echo $mostviews[3]->title ?></span>
                </a>
            </h4>
            <?php
            $thietke_link = thietke_link($mostviews[4]->title_link);
            $view_title = view_title($mostviews[4]->title);
            if ($mostviews[4]->image != '')
                $img = $uri_root . $mostviews[4]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb3">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="117" height="117" />
                    <span class="tt"><?php echo $mostviews[4]->title ?></span>
                </a>
            </h4>
            <?php
            $thietke_link = thietke_link($mostviews[5]->title_link);
            $view_title = view_title($mostviews[5]->title);
            if ($mostviews[5]->image != '')
                $img = $uri_root . $mostviews[5]->image;
            else
                $img = img_link('logo.jpg');
            ?>
            <h4 class="thumb3 thumblast">
                <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                    <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="117" height="117" />
                    <span class="tt"><?php echo $mostviews[5]->title ?></span>
                </a>
            </h4>
        </div>
    </div>

    <div class="pn">
        <div class="tkinhome_kvnhaban block_menu_right">
            <?php
            foreach ($thietke_tree as $i => $value) {
                if ($value->pid == 0) {
                    if ($i > 0)
                        echo '<br/>';
                    echo '<h3><a href="' . $uri_root . 'thiet-ke/' . $value->name_link . '.html">' . $value->name . '</a></h3>';

                    foreach ($thietke_tree as $i2 => $value2) {
                        if ($value->id == $value2->pid) {
                            echo '<h3 class="sub_menu"><a href="' . $uri_root . 'thiet-ke/' . $value2->name_link . '.html">' . $value2->name . '</a></h3>';
                        }
                    }
                }
            }
            ?>
        </div>
        <div class="product-categories">
            <?php echo isset($block_modules['module_r_menu']) ? $block_modules['module_r_menu'][1] : '' ?>
        </div>
    </div>

    <div class="pn">
        <div class="pk_pcthietkent">
            <h3 class="title">Công trình tiêu biểu</h3>
            <ul class="pkpctkk_kieu">
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[0]->title_link);
                    $view_title = view_title($tieubieu[0]->title);
                    if ($tieubieu[0]->image != '')
                        $img = $uri_root . $tieubieu[0]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[0]->title ?></span>
                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[1]->title_link);
                    $view_title = view_title($tieubieu[1]->title);
                    if ($tieubieu[1]->image != '')
                        $img = $uri_root . $tieubieu[1]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[1]->title ?></span>
                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[2]->title_link);
                    $view_title = view_title($tieubieu[2]->title);
                    if ($tieubieu[2]->image != '')
                        $img = $uri_root . $tieubieu[2]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[2]->title ?></span>

                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[3]->title_link);
                    $view_title = view_title($tieubieu[3]->title);
                    if ($tieubieu[3]->image != '')
                        $img = $uri_root . $tieubieu[3]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[3]->title ?></span>
                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[4]->title_link);
                    $view_title = view_title($tieubieu[4]->title);
                    if ($tieubieu[4]->image != '')
                        $img = $uri_root . $tieubieu[4]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[4]->title ?></span>
                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[5]->title_link);
                    $view_title = view_title($tieubieu[5]->title);
                    if ($tieubieu[5]->image != '')
                        $img = $uri_root . $tieubieu[5]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[5]->title ?></span>
                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[6]->title_link);
                    $view_title = view_title($tieubieu[6]->title);
                    if ($tieubieu[6]->image != '')
                        $img = $uri_root . $tieubieu[6]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[6]->title ?></span>

                        </a>
                    </h4>
                </li>
                <li class="pkpctkk_kieu">
                    <?php
                    $thietke_link = thietke_link($tieubieu[7]->title_link);
                    $view_title = view_title($tieubieu[7]->title);
                    if ($tieubieu[7]->image != '')
                        $img = $uri_root . $tieubieu[7]->image;
                    else
                        $img = img_link('logo.jpg');
                    ?>
                    <h4 class="thumb2">
                        <a href="<?php echo $thietke_link ?>" title="<?php echo $view_title ?>">
                            <img alt="<?php echo $view_title ?>" title="<?php echo $view_title ?>" src="<?php echo $img ?>" width="178" height="178" />
                            <span class="tt"><?php echo $tieubieu[7]->title ?></span>
                        </a>
                    </h4>
                </li>

            </ul>
        </div>    
        <div class="pk_tintuchd">
            <a href="<?php echo $uri_root ?>tin-tuc.html" class="title">Tin tức mới</a>
            <div class="pk_gioithieutt">
                <?php
                $news_link = news_link($lastnews[0]->title_link);
                $view_title = view_title($lastnews[0]->title);
                if ($lastnews[0]->image != '')
                    $img = $uri_root . $lastnews[0]->image;
                else
                    $img = img_link('logo.jpg');
                ?>
                <div class="fleft">
                    <a href="<?php echo $news_link ?>">
                        <img alt="<?php echo $view_title ?>" src="<?php echo $img ?>" width="177" height="118" />
                    </a>
                    <p><a href="<?php echo $news_link ?>"><?php echo $lastnews[0]->title ?></a></p>
                </div>
                <?php
                $news_link = news_link($lastnews[1]->title_link);
                $view_title = view_title($lastnews[1]->title);
                if ($lastnews[1]->image != '')
                    $img = $uri_root . $lastnews[1]->image;
                else
                    $img = img_link('logo.jpg');
                ?>
                <div class="fright">
                    <a href="<?php echo $news_link ?>">
                        <img alt="<?php echo $view_title ?>" src="<?php echo $img ?>" width="177" height="118" />
                    </a>
                    <p><a href="<?php echo $news_link ?>"><?php echo $lastnews[1]->title ?></a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="tin_tuc_hd">
        <h3 class="title"><?php echo isset($block_modules['module_hotro']) ? $block_modules['module_hotro'][0] : '' ?></h3>
        <div class="center">
            <?php echo isset($block_modules['module_hotro']) ? $block_modules['module_hotro'][1] : '' ?>
        </div>
    </div>
    <div class="share">
        <div class="sharelink">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <!--a class="addthis_button_tweet"></a-->
                <a class="addthis_button_pinterest_pinit"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5103400c0edfaf6c"></script>
            <!-- AddThis Button END -->
        </div>
    </div>
    <?php if (isset($block_modules['module_r_else'])) { ?>
        <div class="tin_tuc_hd">
            <h3 class="title"><?php echo $block_modules['module_r_else'][0] ?></h3>
            <div><?php echo $block_modules['module_r_else'][1] ?></div>
        </div>
    <?php } ?>
    <div class="fb">
        <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FNoithatcnm.com&amp;width=361&amp;height=292&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=true&amp;appId=2305272732" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 361px; height: 292px;" allowtransparency="true"></iframe>
    </div>
    <br/>
    <div class="tin_tuc_hd">
        <h3 class="title"><div><?php echo isset($block_modules['module_doitac']) ? $block_modules['module_doitac'][0] : '' ?></div></h3>
        <div><?php echo isset($block_modules['module_doitac']) ? $block_modules['module_doitac'][1] : '' ?></div>
    </div>

    <div class="tin_tuc_hd" align="center">
        <h3 class="title">Thống kê truy cập</h3>
<!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="website hit counter" ><script  type="text/javascript" >
try {Histats.start(1,2741725,4,4006,112,61,"00011111");
Histats.track_hits();} catch(err){};
</script></a>
<!-- Histats.com  END  -->        <br>
        <a href="http://inhome.vn/bodem.html" target="_blank" rel="nofollow">Google Analytics</a>
    </div>
</div>
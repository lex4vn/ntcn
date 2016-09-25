<div class="col-left sidebar grid12-3 grid-col2-sidebar in-sidebar no-gutter">
    <div class="sidebar-inner">
        <div class="block block-vertnav hide-below-768">
            <div class="block-title">
                <strong><span>Danh mục sản phẩm</span></strong>
            </div>
            <div class="block-content">
                <ul class="accordion accordion-style1 vertnav vertnav-side clearer">
                    <?php
                    $thietke_tree_ = array();
                    foreach ($thietke_tree_ as $i => $value) {
                        if ($value->pid == 0) {
                            $url1 = thietke_link($value->name_link);
                            $class1 = '';
                            if ($c_module == 'thietke' && $category_alias == $value->name_link)
                                $class1 = ' active';
                            $str = '';
                            foreach ($thietke_tree as $i2 => $value2) {
                                if ($value->id == $value2->pid) {
                                    $url2 = thietke_link($value2->name_link);
                                    $class = '';
                                    if ($c_module == 'thietke' && $category_alias == $value2->name_link) {
                                        $class = 'active ';
                                        $class1 = ' active';
                                    }

                                    $str2 = '';
                                    foreach ($thietke_tree as $i3 => $value3) {
                                        if ($value2->id == $value3->pid) {
                                            $url = thietke_link($value3->name_link);
                                            $class3 = '';
                                            if ($c_module == 'thietke' && $category_alias == $value3->name_link) {
                                                $class = 'active ';
                                                $class3 = 'active ';
                                                $class1 = ' active';
                                            }
                                            $str2.='<li class="' . $class3 . 'level2 nav-' . $value->id . '-' . $i2 . '-' . $i3 . '"><a href="' . $url . '"><span>' . $value3->name . '</span></a></li>';
                                        }
                                    }
                                    if ($str2 != '')
                                        $str2 = '<ul class="level1">' . $str2 . '</ul>';

                                    $str .= '<li class="' . $class . 'level1 nav-' . $value->id . '-' . $i2 . ' parent"><a href="' . $url2 . '"><span>' . $value2->name . '</span></a>' . $str2 . '</li>';
                                    ?>
                                    <?php
                                }
                            }
                            if ($str != '')
                                $str = '<ul class="level0">' . $str . '</ul>';
                            ?>
                            <li class="level0<?php echo $class1 ?> nav-<?php echo $value->id ?> parent">
                                <a href="<?php echo $url1 ?>">
                                    <span><?php echo $value->name ?></span><span class="opener">&nbsp;</span>
                                </a>
                                <?php echo $str ?>
                            </li>
                            <?php
                        }
                    }
                    foreach ($product_tree as $i => $value) {
                        if ($value->pid == 0 && $value->tab == 1) {
                            $url1 = product_link($value->name_link);
                            $class1 = '';
                            if ($c_module == 'spnoithat' && $category_alias == $value->name_link)
                                $class1 = ' active';
                            $str = '';
                            foreach ($product_tree as $i2 => $value2) {
                                if ($value->id == $value2->pid) {
                                    $url2 = product_link($value2->name_link);
                                    $class = '';
                                    if ($c_module == 'spnoithat' && $category_alias == $value2->name_link) {
                                        $class = 'active ';
                                        $class1 = ' active';
                                    }

                                    $str2 = '';
                                    foreach ($product_tree as $i3 => $value3) {
                                        if ($value2->id == $value3->pid) {
                                            $url = product_link($value3->name_link);
                                            $class3 = '';
                                            if ($c_module == 'spnoithat' && $category_alias == $value3->name_link) {
                                                $class = 'active ';
                                                $class3 = 'active ';
                                                $class1 = ' active';
                                            }
                                            $str2.='<li class="' . $class3 . 'level2 nav-' . $value->id . '-' . $i2 . '-' . $i3 . '"><a href="' . $url . '"><span>' . $value3->name . '</span></a></li>';
                                        }
                                    }
                                    if ($str2 != '')
                                        $str2 = '<ul class="level1">' . $str2 . '</ul>';

                                    $str .= '<li class="' . $class . 'level1 nav-' . $value->id . '-' . $i2 . ' parent"><a href="' . $url2 . '"><span>' . $value2->name . '</span></a>' . $str2 . '</li>';
                                    ?>
                                    <?php
                                }
                            }
                            if ($str != '')
                                $str = '<ul class="level0">' . $str . '</ul>';
                            ?>
                            <li class="level0<?php echo $class1 ?> nav-<?php echo $value->id ?> parent">
                                <a href="<?php echo $url1 ?>">
                                    <span><?php echo $value->name ?></span><span class="opener">&nbsp;</span>
                                </a>
                                <?php echo $str ?>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
    foreach ($thietke_tree as $value0) {
        if ($value0->pid == 0) {
            $url0 = thietke_link($value0->name_link);
            ?>
            <div class="block-thiet-ke">
                <div class="sidebar-inner">
                    <div class="block block-vertnav hide-below-768">
                        <div class="block-title">
                            <strong><a href="<?php echo $url0 ?>"><span><?php echo $value0->name ?></span></a></strong>
                        </div>
                        <div class="block-content">
                            <ul class="accordion accordion-style1 vertnav vertnav-side clearer">
                                <?php
                                foreach ($thietke_tree as $i => $value) {
                                    if ($value0->id == $value->pid) {
                                        $url1 = thietke_link($value->name_link);
                                        $class1 = '';
                                        if ($c_module == 'thietke' && $category_alias == $value->name_link)
                                            $class1 = ' active';
                                        $str = '';
                                        foreach ($thietke_tree as $i2 => $value2) {
                                            if ($value->id == $value2->pid) {
                                                $url2 = thietke_link($value2->name_link);
                                                $class = '';
                                                if ($c_module == 'thietke' && $category_alias == $value2->name_link) {
                                                    $class = 'active ';
                                                    $class1 = ' active';
                                                }

                                                $str2 = '';
                                                foreach ($thietke_tree as $i3 => $value3) {
                                                    if ($value2->id == $value3->pid) {
                                                        $url = thietke_link($value3->name_link);
                                                        $class3 = '';
                                                        if ($c_module == 'thietke' && $category_alias == $value3->name_link) {
                                                            $class = 'active ';
                                                            $class3 = 'active ';
                                                            $class1 = ' active';
                                                        }
                                                        $str2.='<li class="' . $class3 . 'level2 nav-' . $value->id . '-' . $i2 . '-' . $i3 . '"><a href="' . $url . '"><span>' . $value3->name . '</span></a></li>';
                                                    }
                                                }
                                                if ($str2 != '')
                                                    $str2 = '<ul class="level1">' . $str2 . '</ul>';

                                                $str .= '<li class="' . $class . 'level1 nav-' . $value->id . '-' . $i2 . ' parent"><a href="' . $url2 . '"><span>' . $value2->name . '</span></a>' . $str2 . '</li>';
                                                ?>
                                                <?php
                                            }
                                        }
                                        if ($str != '')
                                            $str = '<ul class="level0">' . $str . '</ul>';
                                        ?>
                                        <li class="level0<?php echo $class1 ?> nav-<?php echo $value->id ?> parent">
                                            <a href="<?php echo $url1 ?>">
                                                <span><?php echo $value->name ?></span><!--<span class="opener">&nbsp;</span>-->
                                            </a>
                                            <?php echo $str ?>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="custom-module-right httt">
        <div class="block block-vertnav hide-below-768">
            <div class="block-title">
                <strong><span><?php echo isset($block_modules['module_hotront']) ? $block_modules['module_hotront'][0] : '' ?></span></strong>
            </div>
            <div class="block-content center">
                <?php echo isset($block_modules['module_hotront']) ? $block_modules['module_hotront'][1] : '' ?>
            </div>
        </div>
    </div>
    <?php if (isset($block_modules['module_r_noithat'])) { ?>
        <div class="custom-module-right">
            <div class="block block-vertnav hide-below-768">
                <div class="block-title">
                    <strong><span><?php echo $block_modules['module_r_noithat'][0] ?></span></strong>
                </div>
                <div class="block-content">
                    <?php echo $block_modules['module_r_noithat'][1] ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="custom-module-right">
        <div class="block block-vertnav hide-below-768">
            <div class="block-title">
                <strong><span>Thống kê truy cập</span></strong>
            </div>
            <div class="block-content center">
                <!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
                <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
                <!-- Histats.com  START  (aync)-->
                <script type="text/javascript">var _Hasync= _Hasync|| [];
                    _Hasync.push(['Histats.start', '1,3596019,4,1041,200,30,00011111']);
                    _Hasync.push(['Histats.fasi', '1']);
                    _Hasync.push(['Histats.track_hits', '']);
                    (function() {
                        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                        hs.src = ('//s10.histats.com/js15_as.js');
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                    })();</script>
                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3596019&101" alt="" border="0"></a></noscript>
                <!-- Histats.com  END  -->
<!-- Histats.com  END  -->
                <br/>
                <a href="http://inhome.vn/bodem.html" target="_blank" rel="nofollow">Google Analytics</a>
            </div>
            <div class="block-content center">
                <div class="share">
                    <div class="sharelink">
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style ">
                            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                            <a class="addthis_counter addthis_pill_style"></a>
                        </div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5103400c0edfaf6c"></script>
                        <!-- AddThis Button END -->
                    </div>
                </div>
                <div class="fb">
                    <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FNoithatcnm.com&amp;width=288&amp;height=440&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=true&amp;appId=2305272732" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 288px; height: 440px;" allowtransparency="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
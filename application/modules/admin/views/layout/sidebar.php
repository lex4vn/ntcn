<div class="sidebar">
    <?php
    $CI = & get_instance();
    $CI->load->model('module_model');
    $modules = $CI->module_model->get_module_by_user();
    ?>
    <ul class="menuleft">
        <?php if ($_admin == 1): ?>            
            <li class="title"><a class="title">Hệ thống</a></li>
<!--            <li<?php echo ($act == 'module') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('module') ?>">Module</a></li>-->
            <li<?php echo ($act == 'meta') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('meta') ?>">Meta</a></li>
            <li<?php echo ($act == 'email_template') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('email_template') ?>">Block, Module</a></li>
            <li<?php echo ($act == 'banner') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('banner') ?>">Quản lý banner</a></li>
            <li class="title"><a class="title">Thành viên</a></li>
            <li<?php echo ($act == 'user') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('user') ?>">Thành viên quản trị</a></li>
            <li<?php echo ($act == 'group') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('group') ?>">Nhóm</a></li>
            <li class="title"><a class="title">Tin tức - sự kiện</a></li>
            <li<?php echo ($act == 'news' && $func == 'category_index') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('news/category_index') ?>">Danh mục</a></li>
            <li<?php echo ($func == 'news') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('news/news') ?>">Tin tức - sự kiện</a></li>
            <li class="title"><a class="title">Thiết kế</a></li>
            <li<?php echo ($act == 'thietke' && $func == 'category_index') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('thietke/category_index') ?>">Danh mục</a></li>
            <li<?php echo ($func == 'thietke') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('thietke/thietke') ?>">Thiết kế</a></li>
            <li class="title"><a class="title">Sản phẩm nội thất</a></li>
            <li<?php echo ($act == 'product' && $func == 'category_index') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('product/category_index') ?>">Danh mục</a></li>
            <li<?php echo ($func == 'product') ? ' class="current" ' : ''; ?>><a class="png cate" href="<?php echo admin_url('product/product') ?>">Sản phẩm nội thất</a></li>
        <?php else: ?>
            <?php foreach ($modules as $k => $v): ?>
                <li class="<?php echo ($act == $v->name_alias) ? 'current' : ''; ?>"><a href="<?php echo admin_url($v->name_alias); ?>" class="cate png"><?php echo $v->name; ?></a></li>
                <?php
                $subs = $CI->module_model->get_many_by(array('pid' => $v->id, 'name <>' => ''));
                ?>
                <?php foreach ($subs as $v_sub): ?>
                    <?php if ($CI->module_model->check_per_func($v->name_alias, $v_sub->name_alias)): ?>
                        <li class="sub">&raquo;&nbsp;&nbsp;<a href="<?php echo admin_url($v->name_alias . '/' . $v_sub->name_alias); ?>" <?php echo ($act == $v->name_alias && ($func == $v_sub->name_alias)) ? 'class="current"' : ''; ?>><?php echo $v_sub->name; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
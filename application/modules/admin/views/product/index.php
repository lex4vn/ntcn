<h1>Danh sách sản phẩm nội thất</h1>
<form action="" method="get" name="filter_form">
    <div class="toppage">
        <span class="left">
            <ul>
                <li class="left">
                    <input id="txt-title" placeholder="Nhập tên sản phẩm" name="title" value="<?php echo (isset($_GET['title']) ? $_GET['title'] : '');?>"/>
                    <select name="catid" style="width: 200px;">
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach ($cats_tree as $k => $v): ?>                            
                            <option <?php echo(isset($_GET['catid']) && $_GET['catid'] == $v->id ? 'selected="selected"' : ''); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input id="btn-apply" type="submit" value="Apply" class="btn" />
                </li>
            </ul>
        </span>
        <?php if ($ADD_ACTION == TRUE): ?>
            <span class="btnadd"><a href="<?php echo admin_url($module . '/update/0/' . $redirect); ?>"><?php echo lang('ADD'); ?></a></span>
        <?php endif; ?>
    </div>

    <div class="toppage">
        <div class="left">Tổng số: <strong><font style="color:red"><?php echo number_format($total_rows, 0, ',', '.') ?></font></strong></div>
        <div class="pagination">
            <?php echo (isset($pagnav) ? $pagnav : ''); ?>
        </div>
        <div style="float:right">
            <select name="limit" onchange="document.filter_form.submit();">
                <option value="">--- Hiển thị ---</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 10 ? 'selected="selected"' : ''); ?> value="10">10</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 20 ? 'selected="selected"' : ''); ?> value="20">20</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 30 ? 'selected="selected"' : ''); ?> value="30">30</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 50 ? 'selected="selected"' : ''); ?> value="50">50</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 100 ? 'selected="selected"' : ''); ?> value="100">100</option>
                <option <?php echo(isset($_GET["limit"]) && $_GET["limit"] == 500 ? 'selected="selected"' : ''); ?> value="500">500</option>
            </select>
        </div>
    </div>
</form>

<div class="tableout">
    <div class="title1">
        <div class="column ta-center" style="width:4%;"><?php echo lang('STT') ?></div>
        <div class="column ta-center" style="width:23%;">Tên sản phẩm</div>
        <div class="column ta-center" style="width:15%;">Tên chuyên mục</div>
        <div class="column ta-center" style="width:23%;">Mã sản phẩm</div>
        <div class="column ta-center" style="width:7%;"><?php echo lang('ORDER'); ?></div>
        <div class="column ta-center" style="width:7%;"><?php echo lang('CREATED_DATE'); ?></div>
        <div class="column ta-center" style="width:6%;"><?php echo lang('ACTIVE'); ?></div>
        <div class="column ta-center" style="width:10%;"><?php echo lang('ACTIONS'); ?></div>
    </div>
    <form action="" method="post">
        <?php foreach ($rows as $k => $row): ?>
            <div class="linecate">
                <div class="column ta-center" style="width:4%;"><?php echo ($offset + $k + 1); ?></div>
                <div class="column" style="width:23%;" onmouseover="Hovercat('<?php echo $row->id; ?>')" onmouseout="Outcat('<?php echo $row->id; ?>')">
                    <a class="menu3000" target="_blank" href="<?php echo product_link($row->title_link); ?>"><?php echo $row->title ?></a><br />
                    <div class="action" id="neocat-<?php echo $row->id; ?>">
                    </div>
                </div>

                <div class="column ta-left" style="width: 15%;"><?php echo $row->cat_name ?></div>
                <div class="column ta-left" style="width: 23%;"><?php echo $row->code ?></div>
                <div class="column ta-center" style="width: 7%;">
                    <input name="ids[]" value="<?php echo $row->id; ?>" type="hidden"/>
                    <input style="width: 60px;" name="orders[]" value="<?php echo $row->order; ?>"/>
                </div>
                <div class="column ta-center" style="width: 7%;">
                    <?php echo date('d/m/Y', strtotime($row->created_date)); ?>
                </div>

                <div class="column ta-center" style="width: 6%;">
                    <?php if ($row->active == 'no'): ?>
                        <a href="<?php echo admin_url($module . '/active/' . $row->id . '/yes' . '/' . $redirect) ?>"><img src="<?php echo img_link('pending.png', 'admin'); ?>" class="icon png" title="Kích hoạt" alt="Kích hoạt"></a>
                    <?php else: ?>
                        <a href="<?php echo admin_url($module . '/active/' . $row->id . '/no' . '/' . $redirect) ?>"><img src="<?php echo img_link('active.png', 'admin'); ?>" class="icon png" title="Hủy kích hoạt" alt="Hủy kích hoạt"></a>
                    <?php endif; ?>
                </div>
                <div class="column ta-center" style="width:10%;">
                    <?php if ($EDIT_ACTION == TRUE): ?>
                        <img src="<?php echo img_link('edit.gif', 'admin'); ?>" /><a href="<?php echo admin_url($module . '/update/' . $row->id . '/' . $redirect); ?>" onclick =""><?php echo lang('EDIT'); ?></a>
                    <?php endif; ?>
                    <?php if ($EDIT_ACTION == TRUE): ?>
                        |&nbsp;<img src="<?php echo img_link('delete.gif', 'admin'); ?>" /><a onclick="return confirm('Bạn chắc chắn muốn xóa?');" href="<?php echo admin_url($module . '/delete/' . $row->id . '/' . $redirect) ?>"><font color="#be0000"><?php echo lang('DELETE'); ?></font></a>
                    <?php endif; ?>
                </div>

            </div>



        <?php endforeach; ?>

        <div class="bottom1">
            <div class="column" style="width: 4%;">&nbsp;</div>
            <div class="column" style="width: 7%;">
                <input class="btn" type="submit" value="Cập nhật"/>
                <input type="hidden" name="redirect" value="<?php echo $redirect ?>" />
            </div>
            <div class="pagination">
                <?php echo (isset($pagnav) ? $pagnav : ''); ?>
            </div>
        </div>
    </form>  
</div>
<script>
    $("#txt-title").keyup(function(event){
        if(event.keyCode == 13){
            $("#btn-apply").click();
        }
    });
</script>
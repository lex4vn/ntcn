<h1>Block - Module</h1>
<div class="toppage">
    <span class="left">
    </span>
    <?php if ($ADD_ACTION == TRUE): ?>
        <span class="btnadd"><a href="<?php echo admin_url($module . '/update'); ?>"><?php echo lang('ADD'); ?></a></span>
    <?php endif; ?>
</div>

<div class="tableout">
    <div class="title1">
        <div class="column" style="width:4%;">ID</div>
        <div class="column" style="width:50%;"><?php echo lang($MODULE . '_TITLE'); ?></div>
        <div class="column" style="width:25%;"><?php echo lang($MODULE . '_NAME'); ?></div>        
        <div class="column ta-center" style="width:8%;"><?php echo lang('CREATED_DATE'); ?></div>
        <div class="column ta-center" style="width:10%;"><?php echo lang('ACTIONS'); ?></div>
    </div>
    <?php foreach ($rows as $k => $row): ?>
        <div class="linecate">
            <div class="column" style="width:4%;"><?php echo $row->id ?></div>
            <div class="column" style="width:50%;">
                <a href="javascript:;" class="menu3000"><?php echo $row->title; ?></a><br />
            </div>

            <div class="column ta-left" style="width:25%;">
                <?php echo $row->name; ?>
            </div>

            <div class="column ta-center" style="width: 8%;">
                <?php echo date('d/m/Y', $row->time); ?>
            </div>
            <div class="column ta-center" style="width:10%;">
                <?php if ($EDIT_ACTION == TRUE): ?>
                    <img src="<?php echo img_link('edit.gif', 'admin'); ?>" /><a href="<?php echo admin_url($module . '/update/' . $row->id); ?>" onclick =""><?php echo lang('EDIT'); ?></a>
                <?php endif; ?>
                <?php if ($EDIT_ACTION == TRUE): ?>
                    |&nbsp;<img src="<?php echo img_link('delete.gif', 'admin'); ?>" /><a onclick="return confirm('Bạn chắc chắn muốn xóa?');" href="<?php echo admin_url($module . '/delete/' . $row->id) ?>"><font color="#be0000"><?php echo lang('DELETE'); ?></font></a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="bottom1"></div>
</div>
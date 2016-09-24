
<h1><?php echo lang('EDIT'); ?></h1>

<?php if ($this->message->has('error')): ?>
    <?php echo $this->message->display(); ?>
<?php endif; ?>
<?php //print_r($row);?>
<div class="tableout">
    <div class="title1">
        <div class="column" style="width:100%;"><?php echo lang('EDIT'); ?></div>
    </div>
    <form enctype="multipart/form-data" method="post" action="">
        <div style="width:100%; float:left;">
            <ul class="lineadd2">
                <li>
                    <span class="left">Chuyên mục</span>
                    <span class="right">
                        <select name="pid">
                            <option value="0">----ROOT----</option>
                            <?php foreach ($cats_tree as $k => $v): ?>
                                <option <?php echo($row->pid == $v->id ? 'selected="selected"' : ''); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </span>
                </li>
                <li>
                    <span class="left">Tên chuyên mục</span>
                    <span class="right"><input type="text" name="name" value="<?php echo $row->name; ?>" style="width:40%;" /></span>
                </li>
                <li>
                    <span class="left"><b>Ảnh</b></span>
                    <span class="right">                	                	
                        <input type="file" name="image" value="" />
                        <?php if (isset($row->image)): ?>
                            <br /><br />
                            <img src="<?php echo base_url() . $row->image ?>" style="max-width:200px;max-height:200px" />
                        <?php endif; ?>              	
                    </span>
                </li>
                <li>
                    <span class="left"><b>Meta Keywords</b></span>
                    <span class="right"><input type="text" name="meta_keywords" value="<?php echo $row->meta_keywords ?>" style="width:60%; margin:0;" /></span>
                </li>
                <li>
                    <span class="left"><b>Meta Description</b></span>
                    <span class="right"><input type="text" name="meta_description" value="<?php echo $row->meta_description ?>" style="width:60%; margin:0;" /></span>
                </li>
                <li>
                    <span class="left"><?php echo lang('ORDER'); ?></span>
                    <span class="right"><input type="text" name="order" value="<?php echo $row->order; ?>" style="width:10%;" /></span>
                </li>
                <li>
                    <span class="left"><?php echo lang('ACTIVE'); ?></span>
                    <span class="right"><input <?php echo ($row->active == 'yes' ? 'checked="checked"' : ''); ?> type="checkbox" name="active" value="yes" /></span>
                </li>
            </ul>


        </div>

        <div class="bottomadd">	
            <input type="submit" onclick="" name="" value="<?php echo lang('EDIT'); ?>" class="btnsave" />
        </div>
    </form>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>

<div class="tableout">
    <div class="title1">
        <div class="column" style="width:100%;"><?php echo lang($row ? 'EDIT' : 'ADD'); ?></div>
    </div>
    <form enctype="multipart/form-data" method="post" action="" id="articles_form">
        <div class="editcate_ct">
            <div class="btarticle">
                <input type="button" value="<?php echo lang('BACK'); ?>" class="btn" onclick="window.location.href = '<?php echo $url_back ?>';" />
                <input type="submit" value="<?php echo lang($row ? 'EDIT' : 'ADD'); ?>" class="btn" />        
            </div>
            <div class="boxadd">
                <ul class="lineadd2"> 
                    <?php if ($this->message->has('error')): ?>
                        <li>
                            <span class="left">&nbsp;</span>
                            <span class="right">
                                <?php echo $this->message->display(); ?>
                            </span>
                        </li>
                    <?php endif; ?>
                    <li>
                        <span class="left"><b>Chuyên mục<font color="red">(*)</font></b></span>
                        <span class="right">
                            <select name="catid" style="width: 200px;">
                                <?php foreach ($cats_tree as $k => $v): ?>
                                    <option <?php echo(isset($submitted['catid']) && $submitted['catid'] == $v->id ? 'selected="selected"' : ''); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </span>
                    </li>    	   	
                    <li>
                        <span class="left"><b>Tên sản phẩm<font color="red">(*)</font></b></span>
                        <span class="right"><input type="text" name="title" value="<?php echo(isset($submitted['title']) ? htmlspecialchars($submitted['title'], ENT_QUOTES, 'UTF-8') : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Mã sản phẩm</b></span>
                        <span class="right"><input type="text" name="code" value="<?php echo(isset($submitted['code']) ? htmlspecialchars($submitted['code'], ENT_QUOTES, 'UTF-8') : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Giá</b></span>
                        <span class="right"><input type="text" name="source" value="<?php echo(isset($submitted['source']) ? $submitted['source'] : ''); ?>" style="width:20%; margin:0;" /></span>
                    </li> 
                    <li>
                        <span class="left"><b><?php echo lang('IMAGE'); ?></b></span>
                        <span class="right">                	                	
                            <input type="file" name="image" value="" />
                            <?php if (isset($submitted['image'])): ?>
                                <br /><br />
                                <img src="<?php echo base_url() . $submitted['image']; ?>" style="max-width:200px;max-height:200px" />
                            <?php endif; ?>              	
                        </span>
                    </li>
                    <li>
                        <span class="left"><b>Album ảnh</b></span>
                        <span class="right">
                            <table class="block_links" id="block_links">
                                <tr>
                                    <th>Mô tả</th>
                                    <th width="1%" nowrap>Ảnh</th>
                                    <th width="1%" nowrap>Số thứ tự</th>
                                    <th width="1%" nowrap><?php echo lang('ACTIVE'); ?></th>
                                </tr>
                                <?php
                                if (isset($submitted['tv_links'])) {
                                    foreach ($submitted['tv_links'] as $key => $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="text" class="link" name="link[<?php echo $key ?>]" value="<?php echo $value->desc ?>" />
                                                <input type="hidden" name="link_id[<?php echo $key ?>]" value="<?php echo $value->id ?>" />
                                            </td>
                                            <td>
                                                <input type="file" name="link_img[<?php echo $key ?>]" value="<?php echo $value->image ?>" />
                                                <?php if (isset($value->image) && $value->image != ''): ?>
                                                    <br />
                                                    <a target="_blank" href="<?php echo base_url() . '' . $value->image ?>"><img style="max-height:100px;max-width:100px" src="<?php echo base_url() . '' . $value->image ?>"/></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <input type="text" name="link_no[<?php echo $key ?>]" value="<?php echo $value->order ?>" size="3" />
                                            </td>
                                            <td>
                                                <input type="checkbox" name="link_status[<?php echo $key ?>]" value="1" <?php if ($value->status == 1) echo 'checked=""' ?> />
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" class="link" name="link[0]" value="" />
                                        </td>
                                        <td>
                                            <input type="file" name="link_img[0]" value="" />
                                        </td>
                                        <td>
                                            <input type="text" name="link_no[0]" value="" size="3" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="link_status[0]" value="1" />
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <input type="hidden" value="<?php if (isset($submitted['tv_links'])) echo count($submitted['tv_links']) - 1;else echo 0; ?>" name="total_link" id="total_link" />
                            <span class="btarticle"><input style="float:left" type="button" value="Thêm Link" class="btn" onclick="addLink();" /></span>
                        </span>
                    </li>
<!--                    <li>
                        <span class="left"><b>Mô tả ngắn</b></span>
                        <span class="right">
                            <textarea id="txt_desc" name="short_desc" style="width:60%; height:150px;"><?php echo(isset($submitted['short_desc']) ? $submitted['short_desc'] : ''); ?></textarea>
                        </span>            	
                    </li> -->
                    <li>
                        <span class="left"><b>Mô tả</b><font color="red">(*)</font></span>
                        <span class="right"><textarea id="content" name="content"><?php echo(isset($submitted['content']) ? $submitted['content'] : ''); ?></textarea></span>
                        <script type="text/javascript">
                            $(function() {	
                                if(CKEDITOR.instances['contents']) {						
                                    CKEDITOR.remove(CKEDITOR.instances['content']);
                                }
                                CKEDITOR.config.width = "99%";
                                CKEDITOR.config.border = "none";
                                CKEDITOR.config.height = 400;
                                CKEDITOR.replace('content',{
                                    toolbar :
                                        [['Source','Maximize','-','Format','Font','FontSize'],"/",
                                        ['PasteText','PasteFromWord'],
                                        ['TextColor','BGColor','-','Bold','Italic','Underline'],
                                        ['NumberedList','BulletedList'],'/',
                                        ['Outdent','Indent','Blockquote'],
                                        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                        ['Image','Table','-', 'Link', 'Unlink' ]]
                                });
                            })
                        </script>                
                    </li>
                    <li>
                        <span class="left"><b>Tags</b></span>
                        <span class="right"><input type="text" name="tags" value="<?php echo(isset($submitted['tags']) ? $submitted['tags'] : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Meta Keywords</b></span>
                        <span class="right"><input type="text" name="meta_keywords" value="<?php echo(isset($submitted['meta_keywords']) ? $submitted['meta_keywords'] : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Meta Description</b></span>
                        <span class="right"><input type="text" name="meta_description" value="<?php echo(isset($submitted['meta_description']) ? $submitted['meta_description'] : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b><?php echo lang('ACTIVE'); ?>:</b></span>
                        <span class="right">
                            <input name="active" <?php echo (isset($submitted['active']) && $submitted['active'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" type="checkbox"/> 
                        </span>
                    </li>

                </ul>
            </div>
            <div class="btarticle">
                <input type="button" value="<?php echo lang('BACK'); ?>" class="btn" onclick="window.location.href = '<?php echo $url_back ?>';" />
                <input type="submit" value="<?php echo lang($row ? 'EDIT' : 'ADD'); ?>" class="btn" />

            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function addLink(){
        var total_link = parseInt($("#total_link").val()) + 1;   
        $('#block_links tr:last').after('<tr>'
            +'<td>'
            +'<input type="text" class="link" name="link['+total_link+']" value="" />'
            +'</td>'
            +'<td>'
            +'<input type="file" name="link_img['+total_link+']" value="" />'
            +'</td>'
            +'<td>'
            +'<input type="text" name="link_no['+total_link+']" value="" size="3" />'
            +'</td>'
            +'<td>'
            +'<input type="checkbox" name="link_status['+total_link+']" value="1" />'
            +'</td>'
            +'</tr>');
        $("#total_link").val(total_link);
    }
</script>
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
                        <span class="left"><b>Chuyên mục<font color="red">(*)</font> :</b></span>
                        <span class="right">
                            <select name="catid" style="width: 200px;">
                                <?php foreach ($cats_tree as $k => $v): ?>
                                    <option <?php echo(isset($submitted['catid']) && $submitted['catid'] == $v->id ? 'selected="selected"' : ''); ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </span>
                    </li>    	   	
                    <li>
                        <span class="left"><b>Tiêu đề<font color="red">(*)</font> :</b></span>
                        <span class="right"><input type="text" name="title" value="<?php echo(isset($submitted['title']) ? htmlspecialchars($submitted['title'], ENT_QUOTES, 'UTF-8') : ''); ?>" style="width:60%; margin:0;" /></span>
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
                        <span class="left"><b>Mô tả ngắn</b></span>
                        <span class="right">
                            <textarea id="txt_desc" name="short_desc" style="width:60%; height:150px;"><?php echo(isset($submitted['short_desc']) ? $submitted['short_desc'] : ''); ?></textarea>
                        </span>            	
                    </li> 
                    <li>
                        <span class="left"><b>Nội dung</b><font color="red">(*)</font></span>
                        <span class="right"><textarea id="content" name="content"  style="width:60%; height:200px; border: none;"><?php echo(isset($submitted['content']) ? $submitted['content'] : ''); ?></textarea></span>
                        <script type="text/javascript">
                            $(function() {	
                                if(CKEDITOR.instances['contents']) {						
                                    CKEDITOR.remove(CKEDITOR.instances['content']);
                                }
                                CKEDITOR.config.width = "75%";
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
                        <span class="left"><b>Chủ đầu tư</b></span>
                        <span class="right"><input type="text" name="chudautu" value="<?php echo(isset($submitted['chudautu']) ? $submitted['chudautu'] : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Chi tiết chủ đầu tư</b></span>
                        <span class="right">
                            <textarea id="txt_desc" name="chudautu_content" style="width:60%; height:150px;"><?php echo(isset($submitted['chudautu_content']) ? $submitted['chudautu_content'] : ''); ?></textarea>
                        </span>            	
                    </li> 
                    <li>
                        <span class="left"><b>Phí thiết kế</b></span>
                        <span class="right"><input type="text" name="phitk" value="<?php echo(isset($submitted['phitk']) ? $submitted['phitk'] : ''); ?>" style="width:60%; margin:0;" /></span>
                    </li>
                    <li>
                        <span class="left"><b>Chi tiết phí thiết kế</b></span>
                        <span class="right">
                            <textarea id="txt_desc" name="phitk_content" style="width:60%; height:150px;"><?php echo(isset($submitted['phitk_content']) ? $submitted['phitk_content'] : ''); ?></textarea>
                        </span>            	
                    </li> 
                    <li>
                        <span class="left"><b>Nguồn</b></span>
                        <span class="right"><input type="text" name="source" value="<?php echo(isset($submitted['source']) ? $submitted['source'] : ''); ?>" style="width:60%; margin:0;" /></span>
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
                        <span class="left"><b>Công trình tiêu biểu</b></span>
                        <span class="right">
                            <input name="tieubieu" <?php echo (isset($submitted['tieubieu']) && $submitted['tieubieu'] == 1 ? 'checked="checked"' : ''); ?> value="1" type="checkbox"/> 
                        </span>
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

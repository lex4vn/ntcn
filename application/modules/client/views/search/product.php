<?php
echo '<h1 style="position: absolute; text-indent: -99999px;z-index:-1">Tìm kiếm</h1>';
?>
<link href="<?php echo css_link('jquery.qtip.min.css') ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo js_link('jquery.qtip.min.js') ?>"></script>
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
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <?php
        $sizes = config_item('thumb_product_img');
        foreach ($news as $i => $value) {
            if ($i % 3 == 0)
                echo '<tr>';
            $view_title = view_title($value->title);
            // if (isset($category_alias) && $category_alias != '')
            //  $url = product_link($category_alias . '/' . $value->title_link);
            //else
            $url = product_link($value->title_link);
            if ($value->image != '')
                $img = $uri_root . $value->image;
            else
                $img = img_link('logo.jpg');
            if (isset($sizes[1]))
                $img_view = str_replace('/thumb_' . $sizes[0], '/thumb_' . $sizes[1], $img);
            else
                $img_view = $img;
            ?>
            <td align="center">  
                <table width="155" border="0" cellspacing="3" cellpadding="3" align="center">
                    <tr>
                        <td colspan="2" height="35">
                            <a href="<?php echo $url ?>" class="product-name"><?php echo ($category->id == 19 || $category->pid == 19)? '':'Mã SP: '; ?><?php echo $value->code ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <a href="<?php echo $url ?>"> 
                                <img src="<?php echo $img ?>"  width="156" height="104" border="0" title="<?php echo $view_title ?>" alt="<?php echo $view_title ?>"  class="img_preview" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left" height="25">Giá: 
                            <span class="productPrice"><?php echo number_format($value->source, 0, ',', '.') ?> đ</span>
                            <a class="product-name-s" title="<?php echo $view_title ?>" href="<?php echo $url ?>"><?php echo $value->title ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td width="100"  class="details"> <a href="<?php echo $url ?>" class="details">Chi tiết</a>
                        </td>
                        <td width="100"  class="big-img">
                            <a class="hasTip" href="javascript:;">Ảnh lớn</a>
                            <div class="tooltiptext">
                                <img src="<?php echo $img_view ?>"  border="0" alt="<?php echo $view_title ?>" />
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
            <?php
            if ($i % 3 == 2)
                echo '</tr>';
        }
        if (count($item) % 3 != 0)
            echo '</tr>';
        ?>
    </table>
    <script type="text/javascript">
        $(document).ready(function(){
            $('a.hasTip').each(function() {
                $(this).qtip({
                    position: {
                        at: 'top center',
                        my: 'bottom center'
                    },
                    content: {
                        text: $(this).next('.tooltiptext')
                    }
                });
            });
        });
    </script>
<?php } elseif (!isset($message)) { ?>
    <h2>Không tìm thấy dữ liệu</h2>
<?php } ?>
<div id="d_list">
    <div class="editcate_top">
    <h2>Lịch sử mua App của tài khoản: <?php echo $user->email;?></h2>
    <a href="javascript:void(0)" onclick ="$('#light_adct').hide();$('#fade_adct').hide()"><img src="<?php echo img_link('close.png', 'admin'); ?>" class="png" /></a>
</div>

<div id="div_message"></div>
<div style="float: left; padding: 5px;">
	<p>Số dư tài khoản: <?php echo show_money($user->main_balances);?></p>
	<p>Tổng số BHXu đã giao dịch: <?php echo show_money($sum);?></p>
</div>

<div class="tableout">
		<div class="title1">
        	<div class="column ta-center" style="width:4%;"><?php echo lang('STT');?></div>
        	
            <div class="column ta-center" style="width:20%;">Ngày mua</div>
            <div class="column ta-center" style="width:25%;">Tên App</div>
            <div class="column ta-center" style="width:15%;">Giá</div>
            <div class="column ta-center" style="width:15%;">Hình thức thanh toán</div>
        </div>
        <?php foreach($rows as $k => $row):?>
        <div class="linecate">
        	<div class="column" style="width:4%;"><?php echo ($k+1);?></div>
        	
            <div class="column ta-center" style="width:20%;" onmouseover="Hovercat('<?php echo $row->id;?>')" onmouseout="Outcat('<?php echo $row->id;?>')">
            	<a><?php echo $row->stt;?></a><a target="_blank" href="<?php echo $row->url;?>" class="menu3000"><?php echo date("d/m/Y", strtotime($row->date_buy));?></a><br />
                <div class="action" id="neocat-<?php echo $row->id;?>">
                    
                </div>
            </div>
            
            <div class="column ta-left" style="width:25%;">
            	<?php echo $row->app_name;?>
            </div>
            <div class="column ta-center" style="width:15%;">
            	<?php echo show_money($row->price);?>
            </div>
            <div class="column ta-center" style="width:15%;">
            	<?php echo $row->pm_name;?>
            </div>
           
        </div>
        <?php endforeach;?>
        
        <div class="bottom1">
        	<div class="column" style="width: 2%;">&nbsp;</div>
            <div class="column" style="width: 50%;">
            </div>
            <span class="right1">
                <div class="pagination">
                    <ul>
                    <?php echo (isset($pagnav) ? $pagnav : ''); ?>
                    </ul>
                </div>
            </span>
        </div>
               
        </div>
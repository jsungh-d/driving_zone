<div id="search_goods_select" style="">
	<?php 
		foreach($goods_lists as $row) {
	?>
	<label style="width: 32%;">
	<input class="goods_search" type="checkbox" name="goods_search" value="<?=$row['GOODS_IDX'] ?>"><span><?=$row['GOODS_NAME'] ?></span>
	</label>
	<?php
		}
	?>
</div>


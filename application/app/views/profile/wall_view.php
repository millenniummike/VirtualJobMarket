<h1>Wall</h2>
<div>
<?php

foreach($wall as $item) {
    ?>
<div><?php echo $item->updated_at;?> <?php echo urldecode($item->post);?></div>     
<?php } ?>
</div>

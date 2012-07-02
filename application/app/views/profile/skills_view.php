<h1>Skills</h1>
<div id="skills">
    <div style="width:400px;float:left;"><b>Skill Name</b></div><div style="width:40px;float:left;"><b>Rating</b></div>
    <div style="clear:both;"/>
<?php

foreach($skills as $item) {
    ?>
<div style="width:400px;float:left;"><?php echo $item->name;?></div><div style="width:40px;float:left;"><?php echo $item->rating;?></div>
<div style="clear:both;"/>
<?php } ?>
</div>

</div>





<h1>Skills</h1>
<a id="add_skill" href="javascript: return null;">+Add Skill</a>

<div id="skills">
<?php

$skillcounter=0;
foreach($skills as $item) {
    ?>
<div id="skill<?php echo $skillcounter;?>">
Skill <input type="text" name="skillname[]" value="<?php echo $item->name;?>"/>
Rating<select name="skillrating[]"><option value="">Select Proficiency</option>
    <option <?php if ($item->rating=='1') {echo "selected";}?> value="1">1</option>
    <option <?php if ($item->rating=='2') {echo "selected";}?> value="2">2</option>
    <option <?php if ($item->rating=='3') {echo "selected";}?> value="3">3</option>
    <option <?php if ($item->rating=='4') {echo "selected";}?> value="4">4</option>
    <option <?php if ($item->rating=='5') {echo "selected";}?> value="5">5</option>
    <option <?php if ($item->rating=='6') {echo "selected";}?> value="6">6</option>
    <option <?php if ($item->rating=='7') {echo "selected";}?> value="7">7</option>
    <option <?php if ($item->rating=='8') {echo "selected";}?> value="8">8</option>
    <option <?php if ($item->rating=='9') {echo "selected";}?> value="9">9</option>
    <option <?php if ($item->rating=='10') {echo "selected";}?> value="10">10</option></select>
<a id="delete_skill<?php echo $skillcounter;?>" onclick="javascript:this.parentNode.parentNode.removeChild( this.parentNode ); return false;" href="javascript: return null;">-Delete Skill</a></div>
<?php 
$skillcounter++;
} ?>
</div>


<script type="text/javascript">
var count = <?php echo $skillcounter?>;
$(function(){
	$('#add_skill').click(function(){
		count += 1;
                $('#skills').append('<div id="skill'+count+'">Skill <input type="text" name="skillname[]"/> Rating<select name="skillrating[]"><option value="">Select Proficiency</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select><a id="delete_skill"'+count+' href="javascript: return null;" onclick="javascript:this.parentNode.parentNode.removeChild( this.parentNode ); return false;">-Delete Skill</a></div>');
 });
 
 	$('#delete_skill').click(function(){
                $('#skills').remove;
 });
 
});
</script> 



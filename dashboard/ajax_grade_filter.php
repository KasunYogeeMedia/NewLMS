<?php
require_once 'conn.php';
?>
<select name="grade" id="" required class="form-control">
<?php
$grade=mysqli_query($conn,"SELECT * FROM lmssubject WHERE class_id='$_GET[level_id]' ORDER BY name");
if(!mysqli_num_rows($grade)>0){
echo "<option hidden='lms'>Grade Not Found</option>";
}
while($grade_resalt=mysqli_fetch_array($grade)){
?>
<option value="<?php echo $grade_resalt['sid']; ?>"><?php echo $grade_resalt['name']; ?></option>
<?php
}
?>
</select>
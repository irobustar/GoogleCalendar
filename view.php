<?php

?>
<html>
<link rel="stylesheet" type="text/css" href="Libdate/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>


<body>

<!--<iframe src="https://calendar.google.com/calendar/embed?src=jben8e79n6as9dn2e2od8eksgs%40group.calendar.google.com&ctz=Asia/Bangkok" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>-->

  
<iframe src="https://calendar.google.com/calendar/embed?src=6tjmqelo32n6tjbcuqid596qcg%40group.calendar.google.com&ctz=Asia/Bangkok" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>








<?php date_default_timezone_set("Asia/Bangkok"); //TestAddEvent   testdate ?>
<form  method="post" action="TestAddEvent.php">
<table width="800" border="0">
  <tr>
    <td width="150" >หัวข้อ</td>
    <td width="640" ><input type="text" id="titlex" name="titlex" style="width:250px;" /></td>
  </tr>
  <tr>
    <td>รายละเอีนด</td>
    <td><textarea id="detail" name="detail"  cols="90" rows="7" ></textarea></td>
  </tr>
  <tr>
  
   <tr>
    <td>วันที่เริ่มต้น</td>
    <td><input type="text" class="some_class" name="startdatex"   /></td>
  </tr>
  <tr>
    <td>วันที่สิ้นสุด</td>
    <td><input type="text" class="some_class" name="enddatex"    /></td>
  </tr>
  <tr>
  
  
    <td></td>
    <td><input type="submit" value=" ส่งค่า "/></td>
  </tr>
</table>
</form>
</body>
<script src="libdate/jquery.js"></script>
<script src="libdate/build/jquery.datetimepicker.full.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$('.some_class').datetimepicker();


</script>




</html>

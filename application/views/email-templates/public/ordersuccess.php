<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Global Products Shopping</title>
</head>
<body bgcolor="#FFFFFF" style="width:600px; margin:0px auto; padding:15px; border:2px solid #ccc;">
<table width="100%">
<tr>
<td></td>
<td class="container" bgcolor="#FFFFFF">
<div class="content">
<table>
<tr><td align="center" bgcolor="#efefef"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/frontend/images/GPS_logo.gif') ?>" /></a></td></tr>
<tr>
<td>
<h3 style="font-size:24px;">Hi, <?php echo $fullname ?></h3>
<p style="font-size:18px;">Thanks for your order. </p>
<p style="font-size:18px;">Your order details are given below: </p>
<?php echo $table ?>
 
</td>
</tr>
</table>
</div> 
</td>
<td></td>
</tr>
</table> 
</body>
</html>
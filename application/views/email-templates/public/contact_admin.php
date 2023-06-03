<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Global Products Shopping</title>
<style>

</style>
</head>
<body bgcolor="#FFFFFF" style="width:600px; margin:0px auto; padding:15px; border:2px solid #ccc;">
<table width="100%">
<tr>
<td></td>
<td class="container" bgcolor="#FFFFFF">
<div class="content">
<table>
<tr><td align="center" bgcolor="#efefef"><a href="<?php echo base_url()?>"><img src="<?php echo base_url('assets/frontend/images/GPS_logo.gif') ?>" /></a></td></tr>
<tr>
<td>
<h3 style="font-size:24px;">Hi, Admin</h3>
<p style="font-size:18px;">You got an enquiry form details are given below:-</p>
 <table class="social" width="100%">
 	<tr>
    	<td width="100px">Name:</td>
        <td><?php echo $name ?></td>
    </tr>
 	<tr>
    	<td>Email:</td>
        <td><?php echo $email ?></td>
    </tr>
 	<tr>
    	<td>Phone:</td>
        <td><?php echo $phone ?></td>
    </tr>
 	<tr>
    	<td>Message:</td>
        <td><?php echo $message ?></td>
    </tr>
 	<tr>
    	<td colspan="2" height="50px"></td>
    </tr>
 	<tr>
    	<td colspan="2" bgcolor="#efefef" style="padding:20px; font-size:18px;">Regards,<br />Globalproductsshopping Team</td>
    </tr>
 </table>
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
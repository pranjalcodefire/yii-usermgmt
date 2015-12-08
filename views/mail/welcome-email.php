<?php
use yii\helpers\Html;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rupaiya Xchange</title>
</head>
<body paddingwidth="0" paddingheight="0" style="background-color:#f5f5f5; margin:0px; padding:0px; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">  
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#f5f5f5; margin:0px; padding:0px;">
  <tr>
    <td style=" text-align:center;" align="center">    
<table width="600px" cellspacing="0" cellpadding="4" style="margin:10px auto; background-color:#fff; border: 1px solid #e1e1e1; color: #34495C;font-size: 16px; line-height: 20px; font-family:calibri, Arial, Helvetica, sans-serif; border-radius:4px; overflow:hidden;">
  <tr>
    <td style="text-align:center; padding-top:20px; padding-bottom:20px; border-bottom:2px solid #4caf50;"><img src="http://labs.codefiretechnologies.com/rupaiya-xchange-emailer/img/logo.jpg" width="168" height="70" style="cursor:pointer;" /></td>
  </tr>
  <tr>
    <td style="text-align:left; padding:10px 35px;">
        <p>Hello <?= Html::encode($details->username) ?>,</p>
		<p>You have been registered successfully on <strong><?php echo SITE_NAME; ?></strong>.</p>
        <p>
            <?php $verifyEmailLink = Yii::$app->urlManager->createAbsoluteUrl(['/usermgmt/user/verify-email', 'id'=>$details->id, 'token' => $details->auth_key]); ?>
            Follow the link below to verify your email: <br/>
            <?= Html::a(Html::encode($verifyEmailLink), $verifyEmailLink) ?>
        </p>
        <p style="font-weight:bold;">
            Regards,</br>
            Team &#8377;x
       </p>
     </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#34495C" style="text-align:center; color:#fff; padding:12px 0px">
    <table border="0" cellspacing="0" cellpadding="4" style="margin:0 auto; text-align:center; width:auto; cursor:pointer;">
      <tr>
        <td align="center"><a href="#" style="color:#fff; text-decoration:none;">Home |</a></td>
        <td align="center"><a href="#" style="color:#fff; text-decoration:none;">About Us |</a></td>
        <td align="center"><a href="#" style="color:#fff; text-decoration:none;">Entrepreneurs |</a></td>
        <td align="center"><a href="#" style="color:#fff; text-decoration:none;">Associations |</a></td>
        <td align="center"><a href="#" style="color:#fff; text-decoration:none;">Contact</a></td>        
      </tr>
    </table>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
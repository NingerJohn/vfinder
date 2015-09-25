<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
</head>
  <body>
    <div class="container" style="width: 600px;height: 100%;margin: 5px;font-family: Arial, &quot;MS Trebuchet&quot;, sans-serif">
      <div class="header" style="width: 100%">
        <h1 style="text-align: left;color: #00afd8">您好<?php //echo $companyName; ?>：</h1>
        </div>
        <div class="content">
          <p style="margin-left: 15px">您于在VFinder网站上面申请密码重置操作，如果非本人操作，请立即删除此邮件</p>
          <p style="margin-left: 15px">请点击<a href="<?php echo $link ?>" >此处</a> 来重置您的密码</p>
          <div class="from">
            <p class="bold" style="margin-left: 15px;font-weight: bold;font-size: 12px">Regards,</p>
            <p style="margin-left: 15px;font-weight: bold;font-size: 12px">Ninger</p>
            <p style="margin-left: 15px;font-weight: bold;font-size: 12px"><?php echo date('Y-m-d'); ?></p>
          </div>
        </div> 
    </div>
</body>
</html>
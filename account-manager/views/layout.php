<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset = "UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>
    <?php if (isset($title)): ?>
    <?php echo $this->escape($title) . ' - ';?>
    <?php endif;?>Account Manager
    </title>
    <link rel="stylesheet" type="text/css" href="/web/css/style.css" media = "screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
</head>
<body>
    <div id="header">
        <h1><a href="<?php echo $base_url; ?>/account">Account Manager</a></h1>
    </div>
    <div id="main">
        <?php echo $_content; ?>
    </div>
</body>
</html>

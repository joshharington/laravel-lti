<html>
<head></head>
<!-- <body onload="document.ltiLaunchForm.submit();"> -->
<body>
<form id="ltiLaunchForm" name="ltiLaunchForm" method="POST" action="<?php printf($launch_url); ?>">
    <?php foreach ($launch_data as $k => $v ) { ?>
    <input type="hidden" name="<?php echo $k ?>" value="<?php echo $v ?>">
    <?php } ?>
    <input type="hidden" name="oauth_signature" value="<?php echo $signature ?>">
    <button type="submit">Launch</button>
</form>
<body>
</html>
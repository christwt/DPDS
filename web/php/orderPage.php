<?php

?>

<!-- Code adapted from http://earlysandwich.com/programming/php/integrate-paypal-payment-system-website-php-mysql-261/
-->
<html>
<head>
<title>Paypal</title>
</head>
<body>
    <style type="text/css">
        body { background: #c0c0c0 !important; }
    </style>   
<div style="text-align:center">
    <h1>Paypal Payment</h1>
<!--  From paypal button creator -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="SZX68WM8AQN7S">
<input type="hidden" name="currency_code" value="USD">
<input style="display: block; margin: 0 auto;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</style>
</body>
</html>

<?php
header('Content-Description: File Transfer');
header('Cache-control: private');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment;filename=2019112241.zip');
header('Expires: 0');
// header('Accept-Ranges: bytes');
header('X-Accel-Redirect: /2019112241.zip');
header("Location : http://128.199.121.38/");
// echo "xxxxx";
<?php



$message = '<p>Apache is being restarted</p>';
$output = shell_exec('/usr/local/apache2/bin/httpd -k graceful');
$message .= '<p>Apache was restarted</p>';

echo $message;
echo $output;

?>
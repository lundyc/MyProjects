<?php
$headers = 'From: <colin@lundy.me.uk>' . "\r\n" .
'Reply-To: <colin@lundy.me.uk>';

mail('<colin@lundy.me.uk>', 'test Subject', 'the message', $headers,
  '-fwebmaster@mobile-smiles.co.uk');
  
phpinfo();

?>
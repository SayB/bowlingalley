<?php

use lithium\storage\Session;

$messages = Session::read('flash');
Session::write('flash', []); // we just `flashed` it clean; so these are what we call flash messages :P

if (!empty($messages['success'])):
?>

	<p class="text-center alert-success"><?php echo $messages['success']; ?></p>

<?php
endif;

if (!empty($messages['failure'])):
?>

	<p class="text-center alert-danger"><?php echo $messages['failure']; ?></p>

<?php
endif;

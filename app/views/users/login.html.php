
<h1>Sign In:</h1>

<div class="container-narrow">

	<?php

	echo $this->form->create($user);

	echo $this->form->field('email');

	echo $this->form->field('password', [
		'type'      => 'password',
		'label'     => 'Password'
	]);

	echo $this->form->submit('Sign In');
	echo $this->form->end();

	?>


</div>

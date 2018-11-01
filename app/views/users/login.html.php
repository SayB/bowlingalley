
<h1>Sign In:</h1>

<div class="container-narrow">

	<?php

	echo $this->form->create($user);

	echo $this->form->field('question', [
        'value'     => 'When do you want it?',
        'disabled'   => true
    ]);

	echo $this->form->field('answer', [
		'type'      => 'password',
		'label'     => 'Password'
	]);

	echo $this->form->submit('Sign In');
	echo $this->form->end();

	?>


</div>

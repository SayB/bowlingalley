
<h1>Register:</h1>

<div class="container-narrow">

    <?php

        echo $this->form->create($user);
        echo $this->form->field('firstname');

        echo $this->form->field('lastname');

        echo $this->form->field('email');

        echo $this->form->field('password', [
            'type'      => 'password',
            'label'     => 'Password'
        ]);

        echo $this->form->field('confirm_password', [
            'type'      => 'password',
            'label'     => 'Confirm Password'
        ]);

        echo $this->form->submit('Register');
        echo $this->form->end();

    ?>


</div> <!-- /container -->
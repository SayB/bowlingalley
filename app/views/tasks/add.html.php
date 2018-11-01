
<h1>Add New Task:</h1>

<div class="container-narrow">

    <?php

    echo $this->form->create($task);
    echo $this->form->field('title');
    echo $this->form->field('body', [
        'type'  => 'textarea'
    ]);
    echo $this->form->submit('Add!');
    echo $this->form->end();

    ?>


</div> <!-- /container -->
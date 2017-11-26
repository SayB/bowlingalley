<?php
use lithium\storage\Session;
use lithium\security\Auth;

?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Application &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(['bootstrap.min', 'lithified']); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, ['type' => 'icon']); ?>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body class="lithified">
<div class="container-narrow">

	<div class="masthead">
		<ul class="nav nav-pills pull-right">
        <?php if (!$this->user->isLoggedIn()): ?>
			<li>
                <?php echo $this->html->link('Join', '/users/register'); ?>
			</li>
        <?php endif; ?>

			<li>
				<?php
                    if ($this->user->isLoggedIn()) {
						echo $this->html->link('Logout', '/users/logout');
                    } else {
						echo $this->html->link('Login', '/users/login');
                    }
                ?>
			</li>

        <?php if ($this->user->isLoggedIn()): ?>
            <li>
                <?php echo $this->html->link('Scores', '/scores'); ?>
            </li>
        <?php endif; ?>

		</ul>
		<a href="/"><h3>&#10177;</h3></a>
	</div>

	<hr>

    <div class="row">
    <?php if ($this->user->isLoggedIn()): ?>
        <h3 class="text-left">Welcome: <?php echo $this->user->read('firstname'); ?></h3>
    <?php endif; ?>
    </div>

    <div class="row-fluid">

        <?php echo $this->_view->render(['element' => 'flash-messages']); ?>

    </div>

	<div class="content">
		<?php echo $this->content(); ?>
	</div>

	<hr>

	<div class="footer">
		<p>&copy; For I am The Monk :-)</p>
	</div>

</div>

</body>
</html>

<?php echo $this->html->link('Play New Game', '/scores', ['class' => 'btn btn-large']) ?>

<h1>My Games:</h1>

<div class="container-narrow">
	<?php if (count($games) == 0): ?>
		<div class="well">
			<p>Seems you haven't played any games yet. Clikc the New Game button now to start playing!</p>
		</div>
	<?php else: ?>

		<table class="table table-bordered">

			<tr>
				<th>Game ID</th>
				<th>Score</th>
				<th>Played At</th>
			</tr>

		<?php foreach ($games->data() as $g): ?>

			<tr>
				<td><?=$g['id']?></td>
				<td><?=$g['score']?></td>
				<td><?php echo date('F jS, Y g:i a', strtotime($g['created'])); ?></td>
			</tr>

		<?php endforeach; ?>


		</table>

	<?php endif; ?>

</div> <!-- /container -->
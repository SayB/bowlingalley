<style>
    //
</style>

<h4>To-Do List Tree To Be Rendered Here... ( Similar to Google-Tasks )</h4>
<br />
<ul id="task-tree" class="well-large">

<?php foreach ($tasks as $t): ?>

    <li class="task-card">
        <div class="task-stub">
            <div class="title"><?php echo $t->title; ?></div>
            <div class="body"><?php echo $t->body; ?></div>
        </div>
    </li>

<?php endforeach; ?>

</ul>

<script>
    var tasks = <?php echo json_encode($tasks->data()); ?>;

    $(function () {
        for (var t in tasks) {
            var title = $("<div />", {
                "class": "title",
                "html": t.title
            });
            var body = $("<div />", {
                "class": "body",
                "html": t.body
            });
            var stub = $("<div />", {
                "class": "task-stub"
            });
            stub.append(title);
            stub.append(body);

            var card = $("<div />", {
                "class": "task-stub",
                "html": stub
            });

            var li = $('<li />', {
                "class": "task-card",
                html: card
            });
            $('#task-card').append(li);
        }
    });
</script>
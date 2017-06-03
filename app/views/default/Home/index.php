<h1>Hello, world!</h1>
<code><?=__FILE__?></code>

<?php if (!empty($departaments)) : ?>
    <ul class="list-group">
    <?php foreach ($departaments as $departament) : ?>

            <li class="list-group-item"><?= $departament->label?></li>


    <?php endforeach; ?>
    </ul>
<?php endif?>

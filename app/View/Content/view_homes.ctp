<?php foreach($homes as $home) { ?>

<h2><?= $home['Content']['name']; ?></h2>
<p><?= $home['Content']['content']; ?></p>
<p><a href="/content/viewHome/<?= $home['Content']['id']; ?>" class="btn btn-success"><i class="fa fa-eye"></i> View Gallery</a></p>

<?php } ?>


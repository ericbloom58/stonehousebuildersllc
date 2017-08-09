
<h2><?= $home['Content']['name']; ?></h2>
<p><?= $home['Content']['content']; ?></p>
//gallery code here.
<?php
if(!empty($images)):
    foreach($images as $img):
    ?>
    <img src='/<?= $img ?>' /><br />
  <?php endforeach;
  else:
    ?>
    NO IMAGES FOUND
 <?
<?php
endif;
?>


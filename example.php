<?php require_once 'vendor/autoload.php';
use Tuxedo\Form as Tuxedo; ?>

<h1>Test Form</h1>

<?= Tuxedo::open(function($f) { ?>
	
	<?= $f->text('yo') ?>

<?php }); ?>
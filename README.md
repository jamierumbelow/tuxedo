# Tuxedo

**Give your forms a little jazz.** Tuxedo is a lightweight form builder for PHP.

## Synopsis

```php
<?= Tuxedo::form($article, function($f){ ?>

  <h2><?= $f->title ?></h2>
	
	<?= $f->fieldset('Content', function($f){ ?>

		  <?= $f->text('title') ?>
		  <?= $f->textarea('body') ?>

	<?php }); ?>

	<?= $f->fieldset([ 'name' => 'Author', 'for' => 'author' ], function($f){ ?>
		
		<?= $f->text('first_name') ?>
		<?= $f->text('first_name') ?>

	<?php }); ?>

	<?= $f->fieldset('Metadata', function($f){ ?>

		<?= $f->date_dropdown('publish_date') ?>
		<?= $f->text('first_name') ?>
		<?= $f->tokens('tags') ?>

	<?php }); ?>

<?php }); ?>


<?= Tuxedo::open($article) ?>

  <h2><?= Tuxedo::title() ?></h2>
	
	<?= Tuxedo::openFieldset('Content') ?>

		  <?= Tuxedo::text('title') ?>
		  <?= Tuxedo::textarea('body') ?>

	<?= Tuxedo::closeFieldset() ?>

	<?= Tuxedo::openFieldset([ 'name' => 'Author', 'for' => 'author' ]) ?>
		
		<?= Tuxedo::text('first_name') ?>
		<?= Tuxedo::text('first_name') ?>

	<?= Tuxedo::closeFieldset() ?>

	<?= Tuxedo::openFieldset('Metadata') ?>

		<?= Tuxedo::date_dropdown('publish_date') ?>
		<?= Tuxedo::text('first_name') ?>
		<?= Tuxedo::tokens('tags') ?>

	<?= Tuxedo::closeFieldset() ?>

<?= Tuxedo::close() ?>
```

## Install

Install with Composer:

	{
		"require": {
			"jamierumbelow/tuxedo": "*"
		}
	}
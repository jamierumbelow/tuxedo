# Tuxedo

**Give your forms a little jazz.** Tuxedo is a lightweight form builder for PHP.

## Synopsis

```php
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
<<<<<<< HEAD
An uncaught Exception was encountered

Type:        <?= get_class($exception), "\n"; ?>
Message:     <?= $message, "\n"; ?>
Filename:    <?= $exception->getFile(), "\n"; ?>
Line Number: <?= $exception->getLine(); ?>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === true): ?>

	Backtrace:
	<?php foreach ($exception->getTrace() as $error): ?>
		<?php if (isset($error['file'])): ?>
			<?= trim('-' . $error['line'] . ' - ' . $error['file'] . '::' . $error['function']) . "\n" ?>
		<?php endif ?>
	<?php endforeach ?>
=======
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

An uncaught Exception was encountered

Type:        <?php echo get_class($exception), "\n"; ?>
Message:     <?php echo $message, "\n"; ?>
Filename:    <?php echo $exception->getFile(), "\n"; ?>
Line Number: <?php echo $exception->getLine(); ?>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

Backtrace:
<?php	foreach ($exception->getTrace() as $error): ?>
<?php		if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
	File: <?php echo $error['file'], "\n"; ?>
	Line: <?php echo $error['line'], "\n"; ?>
	Function: <?php echo $error['function'], "\n\n"; ?>
<?php		endif ?>
<?php	endforeach ?>
>>>>>>> 1fac51c0726fe7d97c50f69064fd6d084340142b

<?php endif ?>

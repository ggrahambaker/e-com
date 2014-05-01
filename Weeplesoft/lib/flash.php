<?php if (getFlash("password")): ?>
  <div class="alert alert-error"><?php echo getFlash("password"); ?></div>
<?php endif ?>

<?php if (getFlash("username")): ?>
  <div class="alert alert-error"><?php echo getFlash("username"); ?></div>
<?php endif ?>

<?php if (getFlash("notice")): ?>
  <div class="alert alert-notice"><?php echo getFlash("notice"); ?></div>
<?php endif ?>

<?php if (getFlash("classAdded")): ?>
  <div class="alert class-added"><?php echo getFlash("classAdded"); ?></div>
<?php endif ?>
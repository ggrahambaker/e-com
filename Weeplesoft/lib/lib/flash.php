<?php if (getFlash("error")): ?>
  <div class="alert alert-error"><?php echo getFlash("error"); ?></div>
<?php endif ?>

<?php if (getFlash("notice")): ?>
  <div class="alert alert-notice"><?php echo getFlash("notice"); ?></div>
<?php endif ?>
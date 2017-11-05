<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('users/update'); ?>
	<input type="hidden" name="email" value="<?php echo $user['email']; ?>">
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $user['username']; ?>">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="password" value="<?php echo $user['password']; ?>">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
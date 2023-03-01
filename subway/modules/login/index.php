<div class="module"><div class="mb" id='news'>
<h2>Staff Login</h2>

<?php echo $error; ?>

<form method="post" action="" name="aform" id="aform">
<input type="hidden" name="action" value="login">

<table class='center'>
<tr><td>Login:</td><td><input type="text" name="login" value="<?php echo htmlentities($_POST['login']); ?>"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Login"></td></tr>
</table>

</form>
</div></div>
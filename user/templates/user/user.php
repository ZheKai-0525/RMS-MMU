<?php ob_start(); ?>

<h2>Home Page in User folder</h2>
<?php echo $object['name'] ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
     Name: <input type="text" name="name"><br>
     E-mail: <input type="text" name="email"><br>
     <input type="submit">
</form>

<?php $contents = ob_get_clean(); ?>

<?php require_once(TEMPLATES_PATH . "/header.php"); ?>
<?php if (isset($_POST['pass']) && $_POST['pass'] == 'WelcomeToWideo!') : ?>

  <?php phpinfo(); phpinfo(INFO_MODULES); ?>

<?php else : ?>

  <form method="POST" action="secureinfo.php">
    Pass <input type="password" name="pass"></input><br/>
    <input type="submit" name="submit" value="Go"></input>
  </form>

<?php endif; ?>
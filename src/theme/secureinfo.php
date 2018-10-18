<?php
if (isset($_POST['pass'])) {

$pass = $_POST['pass'];

if($pass == "B1st3cc41")
{
        phpinfo();
        phpinfo(INFO_MODULES);
        
}
else
{
    if(isset($_POST))
    {?>

            <form method="POST" action="secureinfo.php">
            Pass <input type="password" name="pass"></input><br/>
            <input type="submit" name="submit" value="Go"></input>
            </form>
    <?}
}
} else {?>
        <form method="POST" action="secureinfo.php">
        Pass <input type="password" name="pass"></input><br/>
        <input type="submit" name="submit" value="Go"></input>
        </form>
<?}
?>
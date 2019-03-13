<?php include("includes/header.php"); ?>


<div class="container mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="login.php" id="loginform" method="post" name="login">
            <p>
                <label for="user_login">Имя опльзователя<br>
                    <input class="input" id="username" name="username" size="20"
                           type="text" value="">
                </label>
            </p>
            <p>
                <label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="20"
                           type="password" value="">
                </label>
            </p>
            <p class="submit"><input class="button" name="login" type= "submit" value="Log In"></p>
            <p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
        </form>
    </div>
</div>


<?php
if(isset($_POST["login"])){

    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);
        $password = md5($password);
        //кодируешь пароль который получил из формы
        //Проверяешь есть ли пользователь с таким именем и паролем в бд
        $sql = "SELECT * FROM usertbl WHERE user_name='".$username."' AND password='".$password."'";
        $result = $con ->query($sql);
        $user_arr = [];
        if($result){
            // Cycle through results
            while ($row = $result->fetch_array()){
                $user_arr[] = $row;
            }
        }

        if(count($user_arr))
        {
            $dbusername=$user_arr[0]["user_name"];
            $dbpassword=$user_arr[0]["password"];
            if($username == $dbusername && $password == $dbpassword)
            {
                // старое место расположения
                  session_start();
                $_SESSION['session_username']=$username;
                echo "$_SESSION";

                /* Перенаправление браузера */
                header("Location: edit.php");
            }
        } else {
            //  $message = "Invalid username or password!";

            echo  "Invalid username or password!";
        }
    } else {
        $message = "All fields are required!";
    }
}

?>
<?php include("includes/footer.php"); ?>

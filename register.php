<?php include("header.php"); ?>


<div class="container mregister">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="register.php" id="registerform" method="post" name="registerform">
            <p>
                <label for="user_login">Имя<br>
                <input class="input" id="f_name" name="f_name" size="32"  type="text" value=""></label>
            </p>
            <p>
                <label for="user_login">фамилия<br>
                <input class="input" id="l_name" name="l_name" size="32"  type="text" value=""></label>
            </p>
            <p>
                <label for="user_pass">E-mail<br>
                <input class="input" id="email" name="email" size="32" type="email" value=""></label>
            </p>
            <p>
                <label for="user_pass">Имя пользователя<br>
                <input class="input" id="username" name="username" size="20" type="text" value=""></label>
            </p>
            <p>
                <label for="user_pass">Пароль<br>
                <input class="input" id="password" name="password" size="32"   type="password" value=""></label>
            </p>
            <p class="submit">
                <input class="button" id="register" name="register" type="submit" value="Зарегистрироваться">
            </p>
            <p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
        </form>
    </div>
</div>


<?php

if(isset($_POST["register"])){


        $result  = $con->query("SELECT * FROM usertbl WHERE user_name='".$username."'");
        $user_arr = [];
        if($result){
            // Cycle through results
            while ($row = $result->fetch_object()){
                $user_arr[] = $row;
            }
        }

        if(!count($user_arr))
        {
            //закодировать пасс
            $password = md5($password);
            $sql="INSERT INTO usertbl (f_name, l_name, email, user_name, password) 
                  VALUES('$f_name', '$l_name', '$email', '$username', '$password')";
            if ($con->query($sql) === TRUE) {
                $message = "Account Successfully Created";
                session_start();
                $_SESSION['session_username']=$username;
                echo "$_SESSION";

                /* Перенаправление браузера */
                header("Location: edit.php");
            } else {
                $message = "Failed to insert data information!";
            }

        } else {
            $message = "That username already exists! Please try another one!";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<?php if (!empty($message)) {echo '<p class="error">' . 'MESSAGE: '. $message . '</p>';} ?>
<?php include("footer.php"); ?>

<?php include("includes/header.php"); ?>
<?php

//$oUser = new User();
//$oUser->getLastName("Last name");

if(isset($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    $username = $_SESSION["session_username"];
    echo $username;
}else{
    header("Location: intropage.php");}
    //получить данные пользователя из бд, зная только юзернейм который можно взять из сессии



    //$sql = "запрос на получение пользователя зная только юзернейм";


    $result  = $con->query("SELECT * FROM usertbl WHERE user_name='".$username."'");
    $user_arr = [];
    if($result){
        // Cycle through results
        while ($row = $result->fetch_array()){
            $user_arr[] = $row;
        }
    }
    if(count($user_arr)){
        $oCurrentUser = $user_arr[0];
    }else{
        header("Location: /login.php");
    }
//var_dump($oCurrentUser["id"]);
    //если пользователя нет в бд до разавторизовываемся

    //если пользователь найден то записываем в ассоциативный массив данные вида:
    //затем записываем в поля



?>

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>

<div class="container mregister">
    <div id="login">
        <h1>Изменение данных</h1>
        <?php echo '</a> <img src="' . $oCurrentUser['image'] . '" width="320" height="450" alt="">'; ?>
        <form action="edit.php" id="editform" method="post" name="editform" enctype="multipart/form-data">

            <input type="file" name="picture">
            <p>
                <label for="user_login">Имя<br>
                    <input class="input" id="f_name" name="f_name" size="32"  type="text" value="<?php echo $oCurrentUser["f_name"]?>"></label>
            </p>
            <p>
                <label for="user_login">фамилия<br>
                    <input class="input" id="l_name" name="l_name" size="32"  type="text" value="<?php echo $oCurrentUser["l_name"]?>"></label>
            </p>
            <p>
                <label for="user_pass">E-mail<br>
                    <input class="input" id="email" name="email" size="32" type="email" value="<?php echo $oCurrentUser["email"]?>"></label>
            </p>
            <p>
                <label for="user_pass">Имя пользователя<br>
                    <input class="input" id="username" name="username" size="20" type="text" value="<?php echo $username?>"></label>
            </p>
            <p>
                <label for="user_pass">Старый Пароль<br>
                    <input class="input" id="password" name="password" size="32"   type="password" value="<?php echo ""?>"></label>
            </p>
            <p>
                <label for="user_pass">Новый Пароль<br>
                    <input class="input" id="new_password" name="new_password" size="32"   type="password" value="<?php ""?>"></label>
            </p>
            <p class="submit">
                <input class="button" id="edit" name="edit" type="submit" value="Изменить">
            </p>
            <p><a href="logout.php">Выйти</a> из системы</p>
        </form>
    </div>
</div>
<?php include("includes/footer.php"); ?>

<?php

if(isset($_POST["edit"])){
    if($_FILES["picture"]["size"]) {
        // Пути загрузки файлов
        $path = 'image/';
        $tmp_path = 'tmp/';
        // Массив допустимых значений типа файла
        $types = array('image/gif', 'image/png', 'image/jpeg', 'image/bmp');
        // Максимальный размер файла
        $size = 10240000;
        $file_name = $_FILES['picture']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $_FILES['picture']['name'] = $oCurrentUser["id"] . "." . $ext;

        // Проверяем тип файла
        if (!in_array($_FILES['picture']['type'], $types))
            die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');

        // Проверяем размер файла
        if ($_FILES['picture']['size'] > $size)
            die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');

        if (!copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])) {
            echo 'Что-то пошло не так';
        } else {
            if (!empty ($oCurrentUser["image"])) {

                $sql = "UPDATE usertbl SET image = '" . $path . $_FILES['picture']['name'] . "' WHERE id='" . $oCurrentUser['id'] . "'";
                $con->query($sql);
                $image_way = $oCurrentUser["image"];
                unlink($path . $image_way);
            } else {
                var_dump($_FILES['picture']['name']);
                $sql = "UPDATE  usertbl SET image = '" . $path . $_FILES['picture']['name'] . "' WHERE id='" . $oCurrentUser['id'] . "'";
                $con->query($sql);
            }
        }
    }
    if(!empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['email']) && !empty($_POST['username'])) {
        $f_name= htmlspecialchars($_POST['f_name']);
        $l_name= htmlspecialchars($_POST['l_name']);
        $email=htmlspecialchars($_POST['email']);
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);
        $new_password=htmlspecialchars($_POST['new_password']);

        $result  = $con->query("SELECT * FROM usertbl WHERE id='".$oCurrentUser["id"]."'");
        $user_arr = [];
        if($result){
            // Cycle through results
            while ($row = $result->fetch_array()){
                $user_arr[] = $row;
            }
        }
        if(count($user_arr))
        {
            $sql = "UPDATE usertbl SET f_name='".$f_name."', l_name= '".$l_name."', email= '".$email."'";
            $password = md5($password);
            $dbpassword = $user_arr[0]["password"];
            $additionalMessage = "";
            if (!empty($new_password) && $password == $dbpassword ) {
                //закодировать пасс
                $new_password = md5($new_password);
                $sql .= ", password= '" . $new_password . "' ";
                $additionalMessage = " вместе с паролем";
            }
            $sql .= "WHERE user_name = '".$username."'";

            if ($con->query($sql) === TRUE) {
                $message = "Данные изменены ".$additionalMessage;
            } else {
               // var_dump($sql);
                $message = "Failed to insert data information!";
            }

        } else {
            $message = "That username already exists! Please try another one!";
        }
    } else {
        $message = "All fields are required!";
    }
    header("Refresh:0");
}
?>

<?php if (!empty($message)) {echo '<p class="error">' . 'MESSAGE: '. $message . '</p>';} ?>

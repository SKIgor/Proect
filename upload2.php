<?php



//dopinfo




if(isset($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    $username = $_SESSION["session_username"];
    $result  = $con->query("SELECT * FROM usertbl WHERE user_name='".$username."'");
    $user_arr = [];
}
if($result){
    // Cycle through results
    while ($row = $result->fetch_array()){
        $user_arr[] = $row;
    }
}



if(count($user_arr)){
    $oCurrentUser = $user_arr[0];

}

$image_way = $oCurrentUser["image"];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

        $file_name = $_FILES['picture']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $_FILES['picture']['name'] = $oCurrentUser["id"].".".$ext;

        // Проверяем тип файла
        if (!in_array($_FILES['picture']['type'], $types))
            die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');

        // Проверяем размер файла
        if ($_FILES['picture']['size'] > $size)
            die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');

        if (!copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])){
            echo 'Что-то пошло не так';
        }
        else {
            if (!empty ($oCurrentUser["image"]) ) {

                $sql = "UPDATE usertbl SET image = '".$path .$_FILES['picture']['name']."' WHERE id='".$oCurrentUser['id']."'";
                $con->query($sql);
                echo ' Загрузка удачна <a href="' . $path . $_FILES['picture']['name'] . '">Посмотреть</a>" <img src="' . $path . $_FILES['picture']['name'] . '" width="320" height="450" alt="">';
                unlink($path .$image_way);
            }
            else{
                var_dump($_FILES['picture']['name']);
                $sql = "UPDATE  usertbl SET image = '".$path .$_FILES['picture']['name']."' WHERE id='".$oCurrentUser['id']."'";
                $con->query($sql);
                echo ' Загрузка удачна <a href="' . $path . $_FILES['picture']['name'] . '">Посмотреть</a>" <img src="' . $path . $_FILES['picture']['name'] . '" width="320" height="450" alt="">';
            }


        }
        //var_dump($sql);
       // var_dump($_FILES['picture']['name']);
        //var_dump($_FILES['picture']['type']);
}



//    //unlink('image/$oCurrentUser["id"].".".bmp');
////unlink($tmp_path . $oCurrentUser["id"].".");
//var_dump($path);
//// Обработка запроса
//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//{
//
//    $file_name = $_FILES['picture']['name'];
//    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
//    $_FILES['picture']['name'] = $oCurrentUser["id"].".".$ext;
//    // Проверяем тип файла
//    if (!in_array($_FILES['picture']['type'], $types))
//        die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');
//
//    // Проверяем размер файла
//    if ($_FILES['picture']['size'] > $size)
//        die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');
//
//    // Загрузка файла и вывод сообщения
//    if (!copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name']))
//        echo 'Что-то пошло не так';
//    else
//        echo ' Загрузка удачна <a href="' . $path . $_FILES['picture']['name'] . '">Посмотреть</a>" <img src="' . $path . $_FILES['picture']['name'] . '" width="320" height="450" alt="">' ;
//    var_dump($_FILES['picture']['name']);
//    var_dump($_FILES['picture']['type']);
//}

?>


<form method="post">

</form>

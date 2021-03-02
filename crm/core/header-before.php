<?

class WebSiteSetting {
    public static function GetTitle() {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        
        //MySqli Select Query
        $results = $mysqli->query("SELECT PAGE_TITLE FROM wabsite_page WHERE URL='".$url."'");

        $res=$results->fetch_assoc();
        
        $results->free();

        $mysqli->close();
        return $res["PAGE_TITLE"];
    }
    public static function GetIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public static function RegisterConnect() {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $dateCreate=date("Y-m-d")." ".date("H:i:s");
        if(!empty($_COOKIE["USER_ID"])){//получение ID пользователя
            
            $resul = $mysqli->query("SELECT ID FROM `attendance` WHERE (`USER_ID`='".$_COOKIE["USER_ID"]."' OR `IP`='".md5(WebSiteSetting::GetIP())."')");//заходил ли пользователь до этого?
            if($row = $resul->fetch_assoc()) {//если да, то обновляем дату авторизации
                $mysqli->query("UPDATE `attendance` SET `DATE_CONNECT` = '".$dateCreate."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
                $mysqli->query("UPDATE `attendance` SET `IP` = '".md5(WebSiteSetting::GetIP())."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
                $mysqli->query("UPDATE `attendance` SET `USER_ID` = '".$_COOKIE["USER_ID"]."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
            }else{//если нет, то создаём как вновьзашедшего
                $mysqli->query("INSERT INTO `attendance` (`ID`, `USER_ID`, `DATE_CONNECT`, `IP`) 
                VALUES (NULL, '".$_COOKIE["USER_ID"]."', '".$dateCreate."', '".md5(WebSiteSetting::GetIP())."');");
            }
        }else{//создаём запись о неавторезированном пользователе
            $mysqli->query("INSERT INTO `attendance` (`ID`, `USER_ID`, `DATE_CONNECT`, `IP`) 
            VALUES (NULL, NULL, '".$dateCreate."', '".md5(WebSiteSetting::GetIP())."');");
        }

        $mysqli->close();
        
    }
    public static function Panel() {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $dateCreate=date("Y-m-d")." ".date("H:i:s");
        if(!empty($_COOKIE["USER_ID"])){//получение ID пользователя
            
            $resul = $mysqli->query("SELECT ID FROM `attendance` WHERE (`USER_ID`='".$_COOKIE["USER_ID"]."' OR `IP`='".md5(WebSiteSetting::GetIP())."')");//заходил ли пользователь до этого?
            if($row = $resul->fetch_assoc()) {//если да, то обновляем дату авторизации
                $mysqli->query("UPDATE `attendance` SET `DATE_CONNECT` = '".$dateCreate."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
                $mysqli->query("UPDATE `attendance` SET `IP` = '".md5(WebSiteSetting::GetIP())."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
                $mysqli->query("UPDATE `attendance` SET `USER_ID` = '".$_COOKIE["USER_ID"]."' WHERE `IP` = '".md5(WebSiteSetting::GetIP())."';");
            }else{//если нет, то создаём как вновьзашедшего
                $mysqli->query("INSERT INTO `attendance` (`ID`, `USER_ID`, `DATE_CONNECT`, `IP`) 
                VALUES (NULL, '".$_COOKIE["USER_ID"]."', '".$dateCreate."', '".md5(WebSiteSetting::GetIP())."');");
            }
        }else{//создаём запись о неавторезированном пользователе
            $mysqli->query("INSERT INTO `attendance` (`ID`, `USER_ID`, `DATE_CONNECT`, `IP`) 
            VALUES (NULL, NULL, '".$dateCreate."', '".md5(WebSiteSetting::GetIP())."');");
        }

        $mysqli->close();
        
    }
}


?>
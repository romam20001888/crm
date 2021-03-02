<?
class USER {
    public static function Add($PARAMS) {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $dateCreate=date("Y-m-d")." ".date("H:i:s");
        if(empty($PARAMS["LOGIN"])){//проверяем есть ли логин
            return "ERROR: Enter LOGIN";
        }
        if($PARAMS["PASSWORD"]==$PARAMS["CHECKPASSWORD"])//правниваем пароли
        {
            $PARAMS["CHECKWORD"]=md5($PARAMS["LOGIN"]."=".$PARAMS["PASSWORD"]);
            $PARAMS["PASSWORD"]=md5($PARAMS["PASSWORD"]);
            $PARAMS["CHECKPASSWORD"]=md5($PARAMS["CHECKPASSWORD"]);
            
        }else{
            return "ERROR: PASSWORD uneven CHECKPASSWORD";
        }
        if(empty($PARAMS["ACTIVE"])){//проверяем если не передан статус активет то присваеваем активен
            $PARAMS["ACTIVE"]="Y";
        }else{
            if(($PARAMS["ACTIVE"]!="Y")||($PARAMS["ACTIVE"]!="N")){
                $PARAMS["ACTIVE"]="Y";
            }
        }



        if(empty($PARAMS["CHECKWORD"])){//проверка на пустые поля
            $PARAMS["CHECKWORD"]="NULL";
        }else{
            $PARAMS["CHECKWORD"]="'".$PARAMS["CHECKWORD"]."'";
        }

        if(empty($PARAMS["NAME"])){
            $PARAMS["NAME"]="NULL";
        }else{
            $PARAMS["NAME"]="'".$PARAMS["NAME"]."'";
        }

        if(empty($PARAMS["LAST_NAME"])){
            $PARAMS["LAST_NAME"]="NULL";
        }else{
            $PARAMS["LAST_NAME"]="'".$PARAMS["LAST_NAME"]."'";
        }

        if(empty($PARAMS["EMAIL"])){
            $PARAMS["EMAIL"]="NULL";
        }else{
            $PARAMS["EMAIL"]="'".$PARAMS["EMAIL"]."'";
        }

        if(empty($PARAMS["LAST_LOGIN"])){
            $PARAMS["LAST_LOGIN"]="NULL";
        }else{
            $PARAMS["LAST_LOGIN"]="'".$PARAMS["LAST_LOGIN"]."'";
        }

        if(empty($PARAMS["SECOND_NAME"])){
            $PARAMS["SECOND_NAME"]="NULL";
        }else{
            $PARAMS["SECOND_NAME"]="'".$PARAMS["SECOND_NAME"]."'";
        }

        $results = $mysqli->query("INSERT INTO `user` (`ID`, `TIMESTAMP_X`, `LOGIN`, `PASSWORD`, `CHECKWORD`, `ACTIVE`, `NAME`, `LAST_NAME`, `EMAIL`, `LAST_LOGIN`, `SECOND_NAME`) 
        VALUES (NULL, '".$dateCreate."', '".$PARAMS["LOGIN"]."', '".$PARAMS["PASSWORD"]."', ".$PARAMS["CHECKWORD"].", '".$PARAMS["ACTIVE"]."', ".$PARAMS["NAME"].", ".$PARAMS["LAST_NAME"].", ".$PARAMS["EMAIL"].", ".$PARAMS["LAST_LOGIN"].", ".$PARAMS["SECOND_NAME"].");");
        
        $us_id = $mysqli->insert_id;

        if($results==true){
            
            $mysqli->query("INSERT INTO `user_group` (`ID`, `USER_ID`, `ID_GROUP`) 
            VALUES (NULL, '".$us_id."', '2');");
            return "User created successfully";
        }else{
            return "User creation error";
        }

        $results->free();

        $mysqli->close();
        
    }
    public static function AuthUser($PARAMS) {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $dateCreate=date("Y-m-d")." ".date("H:i:s");
        $PARAMS["PASSWORD"]=md5($PARAMS["PASSWORD"]);

        $results = $mysqli->query("SELECT * FROM `user` WHERE (`LOGIN`='".$PARAMS["LOGIN"]."' AND `PASSWORD`='".$PARAMS["PASSWORD"]."')");//получаем пользователя
        if($row = $results->fetch_assoc()){
            $resulter = $mysqli->query("UPDATE `user` SET `LAST_LOGIN` = '".$dateCreate."' WHERE `user`.`ID` = '".$row["ID"]."';");//сохраняем дату и всемя авторизации
           ?>
           <script>
            document.cookie = "USER=<?=$row['CHECKWORD']?>; path=/;"
            document.cookie = "USER_ID=<?=$row['ID']?>; path=/;"
           </script>
           <?
            return true;
        }else{
            return "ERROR: User is not found";
        }

        $results->free();

        $mysqli->close();
    }
    public static function GetGroupUser($UserID) {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $arr=[];
        $results = $mysqli->query("SELECT * FROM `user_group` WHERE `USER_ID`='".$UserID."'");//получаем пользователя
        while($row = $results->fetch_assoc()){
            $resul = $mysqli->query("SELECT * FROM `user_group_id` WHERE `ID`='".$row["ID_GROUP"]."'");//получаем пользователя
            if($rowe = $resul->fetch_assoc()){
                $arr[]=array(
                    "ID"=>$row["ID_GROUP"],
                    "NAME"=>$rowe["NAME"],
                    "DESCRIPTION"=>$rowe["DESCRIPTION"],
                );
            }
        }
        return $arr;
        $results->free();

        $mysqli->close();
    }
}

?>
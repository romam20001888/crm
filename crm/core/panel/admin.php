<?class Admin {
    public static function CheckAuth() {
        require $_SERVER['DOCUMENT_ROOT'].'/crm/dbcon.php';
        $results = $mysqli->query("SELECT * FROM `user` WHERE (`ID`='".$_COOKIE["USER_ID"]."' AND `CHECKWORD`='".$_COOKIE["USER"]."')");//получаем пользователя
        if($row = $results->fetch_assoc()){
            $resu = $mysqli->query("SELECT * FROM `user_group` WHERE (`USER_ID`='".$_COOKIE["USER_ID"]."' AND `ID_GROUP`='1')");//получаем пользователя
            if($rows = $resu->fetch_assoc())
            {
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}
?>
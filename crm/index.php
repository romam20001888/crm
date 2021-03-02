<?include $_SERVER['DOCUMENT_ROOT'].'/crm/header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=WebSiteSetting::GetTitle()?></title>
    <link rel="stylesheet" href="/crm/lib/bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crm/core/panel/style.css">
    <script src="/crm/lib/jquery-3.5.1/jquery.js"></script>
</head>
<body>
    <div class="adminAuth">
        <div class="container p-5 formAdmin">
            <div class="errorMessage my-3">

            </div>
            <input type="text" class="inputAuthAdmin" name="login" id="login" placeholder="Логин" >
            <input type="password" class="inputAuthAdmin" name="password" id="password" placeholder="Пароль" >
            <button class="buttonAuthAdmin">Войти</button>
        </div>
    </div>
    <script>
        $('.buttonAuthAdmin').on("click", function (){
            var log = $("#login").val()
            var pas = $("#password").val()
            if((log!="")&&(pas!="")){
                $(".errorMessage").html("")
            }else{
                $(".errorMessage").html("Заполните поля логин или пароль")
            }
        })
    </script>
</body>
</html>
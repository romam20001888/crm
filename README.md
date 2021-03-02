# header
{

    include $_SERVER['DOCUMENT_ROOT'].'/crm/header.php'; - вызвать компонет header

    /crm/core/header-before.php - файл для функций и классов header
    /crm/website/header.php - файл для вёрстки header

    Функции
    WebSiteSetting::GetTitle(); - получение title для страницы. Возвращает имя страницы из базы
    WebSiteSetting::GetIP(); - получение ip пользователя
    WebSiteSetting::RegisterConnect() - регистрация посещения пользователей
    WebSiteSetting::Panel() - отображение панели управления(только для админестраторов)
}
# footer
{

    include $_SERVER['DOCUMENT_ROOT'].'/crm/footer.php'; - вызвать компонет header

    /crm/core/footer-before.php - файл для функций и классов header
    /crm/website/footer.php - файл для вёрстки header

    Функции
}



# USER
{

    include $_SERVER['DOCUMENT_ROOT'].'/crm/core/user.php'; - вызвать компонет user

    Функции

    USER::Add(); - Добавление пользователя (Регистрация)
    обязательные параметры
        'LOGIN'=>"admin",
        'PASSWORD'=>"admin",
        'CHECKPASSWORD'=>"admin"
        
    USER::AuthUser(); - авторизация пользователей с сохранением куков
    обязательные параметры
        'LOGIN'=>"admin",
        'PASSWORD'=>"admin"

    USER::GetGroupUser(); - получение групп пользователя
    обязательные параметры
        $UserID
}


# lib
{
    <link rel="stylesheet" href="/crm/lib/bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/crm/core/panel/style.css">
    <script src="/crm/lib/jquery-3.5.1/jquery.js"></script>
    crm\lib\bootstrap-4.0.0 - bootstrap-4.0.0
    crm\lib\jquery-3.5.1 - jquery-3.5.1
}
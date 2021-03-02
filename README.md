# header
{

    include $_SERVER['DOCUMENT_ROOT'].'/crm/header.php'; - вызвать компонет header

    /crm/core/header-before.php - файл для функций и классов header
    /crm/website/header.php - файл для вёрстки header

    Функции
    GetSettingWebSite::GetTitle(); - получение title для страницы. Возвращает имя страницы из базы
    GetSettingWebSite::GetIP(); - получение ip пользователя
    GetSettingWebSite::RegisterConnect() - регистрация посещения пользователей
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

    GetGroupUser(); - получение групп пользователя
    обязательные параметры
        $UserID
}
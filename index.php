<?include $_SERVER['DOCUMENT_ROOT'].'/crm/header.php';
echo WebSiteSetting::Panel();
    
?>

<pre><?print_r(USER::GetGroupUser(9));?></pre>
<?include $_SERVER['DOCUMENT_ROOT'].'/crm/footer.php';?>
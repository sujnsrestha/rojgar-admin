<?php
require '../vendor/autoload.php';
require_once "../config/config.php";
require_once "../system/Database.php";
require_once "../config/mail.php";

$phpVersion = phpversion();
$uri = null;
if ($phpVersion <= 7) {
    $uri = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
} else {
    $uri = $_GET['url'] ?? 'dashboard';

}

$title = $uri;

$uri = $uri . '.php';

if (!isset($_SESSION['username']) || $_SESSION['is_login'] != true) {
    $_SESSION['error'] = "Please login first";
    redirect_to('admin/login');
    exit();
}


$patePath = page_path('admin/pages/' . $uri);


require_once "layouts/header.php";


if (file_exists($patePath) && is_file($patePath)) {
    require_once "layouts/nav.php";
    require_once "layouts/top-header.php";
    require_once $patePath;
} else {
    echo "
<div class='right_col' role='main'>
<hr>Sorry Page not found</h1>
</div>
";

}


?>

<?php
require_once "layouts/footer.php";
?>


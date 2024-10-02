<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


ini_set('session.gc_maxlifetime', 3600); // Set session timeout to 1 hour
session_set_cookie_params(3600);
session_start();

require_once '../controllers/ProductController.php';

$controller = new ProductController();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';


switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'save':
        $controller->save();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>
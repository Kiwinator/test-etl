<?php
    require_once __DIR__ . '/vendor/autoload.php';

    use app\models\agencies\handlers\AgencyExportHandler;
    use app\models\agencies\repositories\AgencyRepository;
    use app\models\agencies\services\AgencyServices;

    use app\models\contacts\handlers\ContactExportHandler;
    use app\models\contacts\repositories\ContactRepository;
    use app\models\contacts\services\ContactServices;

    use app\models\managers\handlers\ManagerExportHandler;
    use app\models\managers\repositories\ManagerRepository;
    use app\models\managers\services\ManagerServices;

    use app\models\estates\handlers\EstateExportHandler;
    use app\models\estates\repositories\EstateRepository;
    use app\models\estates\services\EstateServices;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    header('Content-Type: application/xml');
    
    $params = [];

    foreach ($_GET as $param => $value) {
        $params[$param] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    
    $result = '<?xml version="1.0" encoding="UTF-8"?><error>Нет данных</error>';

    if ($uri === '/agencies') {
        $repository = new AgencyRepository();
        $services = new AgencyServices($repository);
        $handler = new AgencyExportHandler($services);
        
    } elseif ($uri === '/contacts') {
        $repository = new ContactRepository();
        $services = new ContactServices($repository);
        $handler = new ContactExportHandler($services);
        
    } elseif ($uri === '/managers') {
        $repository = new ManagerRepository();
        $services = new ManagerServices($repository);
        $handler = new ManagerExportHandler($services);
        
    } elseif ($uri === '/estates') {
        $repository = new EstateRepository();
        $services = new EstateServices($repository);
        $handler = new EstateExportHandler($services);
    }

    if (isset($handler)) {
        $result = $handler->handle($params);
    }
        
    echo $result;
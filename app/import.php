<?php
    require_once __DIR__ . '/vendor/autoload.php';

    
    use app\modules\import\services\ImportServices;
    use app\modules\import\builders\ImportBuilder;
    use app\modules\import\helpers\ImportHelper;
    use app\modules\import\handlers\ImportHandler;
    use app\modules\import\validators\ImportFormValidator;

    use app\models\agencies\builders\AgencyBuilder;
    use app\models\agencies\repositories\AgencyRepository;
    use app\models\agencies\handlers\AgencyCreateHandler;
    use app\models\agencies\handlers\AgencyUpdateHandler;
    use app\models\agencies\services\AgencyServices;
    use app\models\agencies\validators\AgencyFormValidator;


    use app\models\contacts\builders\ContactBuilder;
    use app\models\contacts\repositories\ContactRepository;
    use app\models\contacts\handlers\ContactCreateHandler;
    use app\models\contacts\handlers\ContactUpdateHandler;
    use app\models\contacts\services\ContactServices;
    use app\models\contacts\validators\ContactFormValidator;


    use app\models\managers\builders\ManagerBuilder;
    use app\models\managers\repositories\ManagerRepository;
    use app\models\managers\handlers\ManagerCreateHandler;
    use app\models\managers\handlers\ManagerUpdateHandler;
    use app\models\managers\services\ManagerServices;
    use app\models\managers\validators\ManagerFormValidator;

    use app\models\estates\builders\EstateBuilder;
    use app\models\estates\repositories\EstateRepository;
    use app\models\estates\handlers\EstateCreateHandler;
    use app\models\estates\handlers\EstateUpdateHandler;
    use app\models\estates\services\EstateServices;
    use app\models\estates\validators\EstateFormValidator;

    $params = $argv[1];

    $agencyRepository = new AgencyRepository();
    $agencyServices = new AgencyServices($agencyRepository);
    $agencyBuilder = new AgencyBuilder();
    $agencyValidator = new AgencyFormValidator();
    $agencyCreateHandler = new AgencyCreateHandler($agencyServices, $agencyBuilder, $agencyValidator);
    $agencyUpdateHandler = new AgencyUpdateHandler($agencyServices, $agencyBuilder, $agencyValidator);

    $contactRepository = new ContactRepository();
    $contactServices = new ContactServices($contactRepository);
    $contactBuilder = new ContactBuilder();
    $contactValidator = new ContactFormValidator();
    $contactCreateHandler = new ContactCreateHandler($contactServices, $contactBuilder, $contactValidator);
    $contactUpdateHandler = new ContactUpdateHandler($contactServices, $contactBuilder, $contactValidator);

    $managerRepository = new ManagerRepository();
    $managerServices = new ManagerServices($managerRepository);
    $managerBuilder = new ManagerBuilder();
    $managerValidator = new ManagerFormValidator();
    $managerCreateHandler = new ManagerCreateHandler($managerServices, $managerBuilder, $managerValidator);
    $managerUpdateHandler = new ManagerUpdateHandler($managerServices, $managerBuilder, $managerValidator);

    $estateRepository = new EstateRepository();
    $estateServices = new EstateServices($estateRepository);
    $estateBuilder = new EstateBuilder();
    $estateValidator = new EstateFormValidator();
    $estateCreateHandler = new EstateCreateHandler($estateServices, $estateBuilder, $estateValidator);
    $estateUpdateHandler = new EstateUpdateHandler($estateServices, $estateBuilder, $estateValidator);

    $services = new ImportServices();
    $builder = new ImportBuilder();
    $helper = new ImportHelper(
        $agencyServices, $agencyCreateHandler, $agencyUpdateHandler,
        $contactServices, $contactCreateHandler, $contactUpdateHandler,
        $managerServices, $managerCreateHandler, $managerUpdateHandler, 
        $estateServices, $estateCreateHandler, $estateUpdateHandler
    );
    $validator = new ImportFormValidator();
    $handler = new ImportHandler($services, $builder, $helper, $validator);

    $result = 'Нет данных';

    if (isset($handler)) {
        $result = $handler->handle($params);
    }
        
    echo $result;
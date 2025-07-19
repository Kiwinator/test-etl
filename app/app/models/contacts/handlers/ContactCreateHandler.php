<?php
    namespace app\models\contacts\handlers;

    use app\models\contacts\services\ContactServices;
    use app\models\contacts\builders\ContactBuilder;
    use app\models\contacts\validators\ContactFormValidator;
    use app\models\contacts\dto\ContactDTO;

    class ContactCreateHandler {
        public function __construct(
            private ContactServices $services,
            private ContactBuilder $builder,
            private ContactFormValidator $validator
        ) {}

        /**
         * Хэндлер создания контакта
         * @param array $data
         * @return ContactDTO
         * @throws \Exception
         */
        public function handle(array $data): ContactDTO {
            $this->builder
                ->setName($data['name'])
                ->setPhones($data['phones'])
                ->setId(null);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $contact = $this->services->create($dto);

                if (!$contact) {
                    throw new \Exception('Не удалось создать контакт');
                }

                return $contact;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }
# test-etl

## Описание

**test-etl** — это ETL-система на PHP для работы с агентствами, менеджерами, контактами и объектами недвижимости. Проект поддерживает импорт данных из Excel, валидацию, CRUD-операции через репозитории, а также экспорт данных в XML.

## Быстрый старт (через Docker)

1. **Склонируйте репозиторий:**
   ```sh
   git clone https://github.com/Kiwinator/test-etl.git
   cd test-etl
   ```


3. **Запустите проект:**
   ```sh
   docker compose up --build
   ```

4. **Импортируйте необходимые файлы Excel в папку `app/files/` и запустите команду ниже.**

	```sh
	docker-compose exec php php import.php название_файла
	```

5. **Доступные эндпоинты:**
   - `http://localhost:8080/agencies` — экспорт агентств в XML
   - `http://localhost:8080/contacts` — экспорт контактов в XML
   - `http://localhost:8080/managers` — экспорт менеджеров в XML
   - `http://localhost:8080/estates` — экспорт объектов недвижимости в XML
   
   Фильтрация эндпоинтов происходит через GET-параметры
	

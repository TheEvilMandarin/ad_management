# Ad management

Сервис для проекта "Доска объявлений товаров"

Перед началом работы:
1. Указываем в .env доступы к БД
2. `composer i && npm i`
3. `php artisan key:generate`
4. `php artisan storage:link`

Сервис разработан при помощи шаблона Ensi Backend Service Skeleton, о котором можно узнать [здесь](https://gitlab.com/greensight/ensi/templates/backend-service-skeleton)

## Модификации относительно чистого Laravel

### Структура сервиса

Подробно прочитать про отличия структуры сервиса от стандартного для Laravel вида можно почитать [здесь](docs/structure.md)

### Готовый .gitignore

Внесены всякие pdf-ки, архивы, служебные файлы IDEшек и служебных инструментов

### Timezone и Locale

config('app.timezone') = 'Europe/Moscow';
config('app.locale') = 'ru';

### Дополнительный общий .env

Переменные окружения читаются не только из .env файла в корне проекта, но и из .env файла в директории на уровень выше, если он есть.
Приоритет остается у переменных из локального файла. Упрощает управление переменными окружения на тестовом сервере с множеством площадок.
Реализация в `bootstrap/environment.php`.

### Добавлены lang файлы для русского языка

Для пагинации и валидации.

### Git hooks

Хуки лежат в репозитории, в директории .git_hooks
Устанавливаются c помощью скрипта ./setup_git_hooks.sh

### Ensi Storage

Для работы с файлами в Ensi добавлен пакет [ensi/laravel-ensi-filesystem](https://gitlab.com/greensight/ensi/packages/laravel-ensi-filesystem)
Для работы всего этого нужно

1. Чтобы config/ensi-filesystem.php был выставлен корректный код текущего сервиса в качестве дефолтного
2. В config/filesystems.php в $ensiServicesCodes нужно задать список сервисов, с чьими хранилищами будет осуществляться взаимодействие (включая текущий).

### Добавлены технические пакеты для упрощения разработки и улучшения её качества

composer.json:
"barryvdh/laravel-ide-helper",
"beyondcode/laravel-dump-server",
"friendsofphp/php-cs-fixer",
"php-parallel-lint/php-var-dump-check"

package.json:
"husky"
"@stoplight/spectral"
"@openapitools/openapi-generator-cli // для ускорения openapi генераторов

Часть из них задействована в хуках

### Добавлен хэлсчек

GET /health возвращает ОК с кодом 200.

### Установлены пакеты для работы с API

- [greensight/laravel-serve-stoplight](https://github.com/greensight/laravel-serve-stoplight/)
- [greensight/laravel-openapi-client-generator](https://github.com/greensight/laravel-openapi-client-generator/)
- [greensight/laravel-openapi-server-generator](https://github.com/greensight/laravel-openapi-server-generator/)
- [spatie/laravel-query-builder](https://github.com/spatie/laravel-query-builder/)

Пример описания API при помощи спецификации openapi 3 под требования генераторов и [Ensi API Design Guide](https://ensi-platform.gitlab.io/docs/guid/api) можно найти [здесь](https://gitlab.com/greensight/ensi/templates/openapi-example)

### Подчищено всё ненужное из Laravel для чистоты и быстродействия

- встроенный в Laravel фронтэнд
- всё что касается User Management-а и сессий
- AWS, PUSHER и прочее в конфигах
- Broadcasting
- большинство middleware подлюкченных по-умолчанию
- часть Service Provider-ов закоментирована (если из-за этого что-то сломалось - раскоментируйте)

### robots.txt

robots.txt изменен, чтобы по-умолчанию приложение запрещало роботам индексацию если они вдруг до него доберутся

### ini_set('serialize_precision', -1)

Решает кейс
```
$price = ["price" => round("45.99", 2)]; 
echo json_encode($price);
```

`{"price":45.990000000000002}`

Выставляется в `app/bootstrap.php`

### Ошибки валидации всегда возвращаются как json в нужном формате

Реализовано в `App\Exceptions\Handlers.php`

### Лицензия

[Открытая лицензия на право использования программы для ЭВМ Greensight Ecom Platform (GEP)](LICENSE.md).

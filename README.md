DSS (Dvizh Shop Skeleton)
===============================

Скелетон основан на модулях Dvizh, предназначен для быстрой сборки MVP (минимально жизнеспособный продукт) Интернет-магазина. Данное решение навязывает свою модульно-аспектную архитектуру приложения, направленную на

* Быструю разработку первой версии приложения за счет использования готовых конфигурируемых CRUD модулей, сервисов, поведений и виджетов.
* Долгосрочное развитие и поддержку без необходимости полного рефакторинга или переписывания с нуля до того момента, пока проект не "выстрелит"

Целевая аудитория - опытные программисты.

Скелетон имеет высокий порог входа по сравнению с CMS. Для того, чтобы собрать магазин на готовых модулях Dvizh, нужно знать:

* PHP (синтаксис ООП обязателен)
* HTML
* Yii2 фреймворк
* Git

Основные термины:

* Скелетон - базовый каркас приложения, зависящий от некоторых модулей и содержаших в себе аспекты с информацией о том, как модули связываются в рамках обслуживаемой предметной области
* Модуль - максимально изолированный от других модулей набор классов
* CRUD - контроллеры и вью файлы, формирующие и сохраняющие данные через модели
* Сервис - экземпляр объекта (как правило, синглтон), доступный глобально в системе через yii::$app->serviceName и предоставляющий API для работы с какими-дибо данными
* Событие - некоторое событие в модуле, которое потенциально может "заинтересовать" другие модули
* Аспект - коллбек, знающий о всех модулях в системе и реагирующий на события в этих модулях модулях. Как правило, реализуется посредством поведений Yii2. С точки зрения архитектуры приложения скелетона Dvizh, аспект находится на пересечении модулей
* Модель - AR модель, содержашая геттеры\сеттеры сущности и примитивное API для работы с данными сущности
* Виджет

Модули
===============================
Используемые в скелетоне важные модули:

* [dvizh/yii2-shop](https://github.com/dvizh/yii2-shop) - CRUD для управления товарами, модификациями, ценами, категориями, производителями, значениями фильтров
* [dvizh/yii2-filter](https://github.com/dvizh/yii2-filter) - CRUD для фильтров на сайте, набор виджетов для быстрого применения фильтов на фронте с помощью Ajax
* [dvizh/yii2-field](https://github.com/dvizh/yii2-field) - CRUD управления кастомными полями любой AR сущности
* [dvizh/yii2-gallery](https://github.com/dvizh/yii2-gallery) - виджет загрузки картинок, виджет вывода картинок в виде галереи
* [dvizh/yii2-seo](https://github.com/dvizh/yii2-seo) - виджет позволяет прикреплять к моделям важные для SEO поля
* [dvizh/yii2-order](https://github.com/dvizh/yii2-order) - CRUD заказов, набор виджетов для создания заказа и с аналитическими отчетами о заказах за период
* [dvizh/yii2-cart](https://github.com/dvizh/yii2-cart) - сервис и набор виджетов для быстрой разработки функционала корзины на сайте. В корзину можно положить любую модель, имплементируюущую нужный интерфейс.
* [dvizh/yii2-promocode](https://github.com/dvizh/yii2-promocode) - CRUD для управления скидками на сайте, сервис работы со скидками
* [dvizh/yii2-certificate](https://github.com/dvizh/yii2-certificate) - CRUD для управления подарочными сертификатами на сайте, сервис работы со скидками

Установка
===============================

Установка через Composer:

```
composer create-project --prefer-dist --stability=dev dvizh/shop-skeleton
```

Выполнение миграций модулей:

```
php yii migrate/up --migrationPath=migrations
php yii migrate/up --migrationPath=@yii/rbac/migrations
php yii migrate/up --migrationPath=common/modules/dektrium/yii2-user/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-shop/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-order/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-cart/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-filter/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-field/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-seo/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-gallery/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-promocode/src/migrations
php yii migrate/up --migrationPath=vendor/dvizh/yii2-certificate/src/migrations
```

Панель администрирования по умолчанию:

/backend/web/

administrator:10111988

Использование
===============================
Использовать компоненты модулей нужно согласно документации этх модулей.

[![author-check](https://github.com/Marre-86/php-project-57/actions/workflows/author-check.yml/badge.svg)](https://github.com/Marre-86/php-project-57/actions/workflows/author-check.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/b94488bb34dd62430bc2/maintainability)](https://codeclimate.com/github/Marre-86/php-project-57/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b94488bb34dd62430bc2/test_coverage)](https://codeclimate.com/github/Marre-86/php-project-57/test_coverage)

# Desription

["Task Manager"](https://php-project-57-production-f070.up.railway.app/) is a web application where multiple users can create, manage and track tasks. Each task is assigned a status and optional executor and labels (tags). Only authenticated users are authorized to create and edit tasks. The authenticated user automatically becomes a creator of a created task and he is entitled to assign the task to any other user of the app. After the task is created and displays in the general list, all users can edit it and change its status, but only the creator can delete the task.

# About this project

This web application is the graduation project of a 10-month **Php web-developing** comprehensive course on the online educational platform [Hexlet](https://en.hexlet.io/). It was developed in the **Laravel PHP framework** (ver. 10.0), and only up-to-date backend approaches and techniques were used.

As an authentication module Laravel Breeze starter kit is implemented into the project. CRUD actions are accomplished with the usage of resource controllers, which unify created routes and reduce the amount of code. HTML forms are generated using the Laravel Collective package.

All user data is stored in the **PostgreSQL database**. Operations of storing and extracting database data are implemented through Laravel's built-in **ORM Eloquent**. Migration files are written, models and relationships between them (o2m, m2m) are developed and implemented. For filtering records from the database by request query parameters Query Builder (an additional component of Laravel) is used.

All created controller's actions are covered by automated tests (feature tests) based on PHPUnit and Laravel built-in assertion methods. A test coverage report from **Codeclimate** was added to this project.

**GitHub Actions** CI/CD workflow for this project was also created and tuned in a way that every commit is instantly being built, tested and deployed if no errors were found. **Railway** deployment platform [serves as a host](https://php-project-57-production-f070.up.railway.app/)  of this web app. Also it is linked to the real-time error tracking platform **Rollbar**.

Full localization for two languages (English, Russian) has been conducted.

There are some Javascript elements in the app (deleting entities from the database approval, auto-hiding flash messages in 3 seconds), integrated to it with **Vite** frontend build tool, which is recommended by Laravel mechanism for bundling assets.

Basic CSS adaptation for mobile phone screens has been also conducted (originally developed for desktops).

# Описание

["Менеджер задач"](https://php-project-57-production-f070.up.railway.app/) - система управления задачами, позволяющая ставить и изменять задачи, назначая им исполнителей и присваивая различные статусы. Правами создавать и изменять задачи наделены только зарегистрированные пользователи, причём вошедшие под своими данными пользователями становятся авторами создаваемой задачи, а исполнителем могут выбирать из всех пользователей системы. После того, как задача создана и появилась в общем списке, все пользователи имеют право редактировать её и изменять статус, но удалить задачу имеет право только её автор.

# О проекте

Данное веб-приложение является завершающим учебным проектом курса **PHP-разработчик** на [Хекслете](https://ru.hexlet.io/my). Оно было реализовано во фреймворке **Laravel** (версия ^10.0) с применением всех современных подходов к сайтостроению и различных компонентов Laravel, облегчающим и убыстряющим процесс разработки.

В качестве модуля регистрации и аутентификации в проекте используется **Laravel Breeze**. CRUD-операции реализованы с применением ресурсного роутинга, унифицирующего состав создаваемых маршрутов и сокращающего количество кода. Формы отправки пользовательских данных реализованы с использованием доп. библиотеки laravel-collective.

Данные в проекте хранятся в БД **PostgreSQL**. Все операции сохранения и извлечения данных из неё реализованы посредством встроенного в Laravel **ORM Eloquent**. Написаны файлы миграций, спроектированы модели, описаны связи между ними (o2m, m2m). Реализована фильтрация записей из БД по вводимым пользователем GET-параметрам через Query Builder

На все созданные экшны (обработчики маршрутов) мной были написаны автоматические тесты на базе PHPUnit и встроенных в Laravel методов-хелперов. В проект добавлен отчёт о проценте покрытия кода тестами от **Codeclimate**, создан и подключен к **Github Actions** воркфлоу непрерывной интеграции (CI). Проект [задеплоен на PaaS-платоформу **Railway**](https://php-project-57-production-f070.up.railway.app/) и подключен к сервису отслеживания и мгновенного оповещения о возникающих в продакшне ошибок **Rollbar**.

Выполнена полная локализация приложения, оно доступно для использования на русском и английском языках.

В приложении точечно присутствуют элементы JS-скриптов (подтверждение удаления сущностей из БД, автоматическое скрытие флеш-сообщений через 3 секунды), вводимые в проект через **Vite** (встроенный в Laravel механизм сборки "ассетов" CSS и JavaScript).

Выполнена базовая CSS-настройка адаптации готового сайта к экранам смартфонов (изначально разрабатывалось для десктопа).

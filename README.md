Тестовое задание Indigolabs
============================

Используемые образы:
- postgres:14.1-alpine
- nginx:1.19.5-alpine
- php:8.1-fpm-buster

Сборка и запуск проекта:

```bash
cd /path/to/indigolabs-test/docker && docker-compose up -d --build
```

Подключиться к контейнеру indigolabs_test.php:

```bash
docker exec -ti indigolabs_test.php bash
```

Запуск команды инсталляции, создании базы данных внутри контейнера:

```bash
sf app:install
```

Приминение миграции (нужно выполнить для создания таблиц):

```bash
sf app:migrate 00001_init.up
```

Запуск бота:

```bash
sf app:telegram-bot:start
```
Токен для бота прописываем в переменные окружения .env - BOT_TOKEN

Очистка истории регистрации/аутентификации (удаляются записи старше 1 месяца):

```bash
sf app:auth-history:delete
```

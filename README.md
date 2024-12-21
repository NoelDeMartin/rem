# Rem

> [!WARNING]
> This is an experimental service I've implemented in order to serve [Solid](https://solidproject.org/) client documents with content negotiation. Learn more about the motivations in my [ActivityPods Compatibility Report](https://github.com/NoelDeMartin/ramen/blob/main/docs/activitypods.md).

## Development

```sh
git clone git@github.com:NoelDeMartin/rem.git rem
cd rem
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve --host=localhost
```

## Production

```sh
git clone https://github.com/NoelDeMartin/rem.git rem --branch headless
cd rem
./rem install
```

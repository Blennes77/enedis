"# enedis"
composer require server
composer require doctrine/data-fixtures
composer require fzaninotto/faker

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
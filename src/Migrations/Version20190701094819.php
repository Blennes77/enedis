<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701094819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE meteo (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, temperature DOUBLE PRECISION NOT NULL, pressure DOUBLE PRECISION NOT NULL, temperature_min DOUBLE PRECISION NOT NULL, temperature_max DOUBLE PRECISION NOT NULL, humidity DOUBLE PRECISION NOT NULL, wind_speed DOUBLE PRECISION NOT NULL, wind_direction INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE e_hourly');
        $this->addSql('DROP TABLE meteo_old');
        $this->addSql('DROP TABLE retry');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE e_hourly (time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, kw DOUBLE PRECISION DEFAULT NULL COMMENT \'Kw sur 30 mn\', kwh DOUBLE PRECISION DEFAULT NULL COMMENT \'Kw/2\', PRIMARY KEY(time)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE meteo_old (time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, temp DOUBLE PRECISION DEFAULT NULL, pressure DOUBLE PRECISION DEFAULT NULL, tmin DOUBLE PRECISION DEFAULT NULL, tmax DOUBLE PRECISION DEFAULT NULL, humidity DOUBLE PRECISION DEFAULT NULL, speed DOUBLE PRECISION DEFAULT NULL, deg DOUBLE PRECISION DEFAULT NULL, clouds INT DEFAULT NULL, weather_id INT DEFAULT NULL, sunrise DATETIME DEFAULT NULL, sunset DATETIME DEFAULT NULL, PRIMARY KEY(time)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE retry (last_update_enedis DATE NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci, lastname VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci, email VARCHAR(50) NOT NULL COLLATE utf8mb4_general_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE meteo');
    }
}

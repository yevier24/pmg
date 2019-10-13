<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191013031245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carga_meta (id INT AUTO_INCREMENT NOT NULL, cadena VARCHAR(255) NOT NULL, tienda VARCHAR(255) NOT NULL, fecha DATE NOT NULL, dia_semana VARCHAR(255) NOT NULL, semana INT NOT NULL, meta INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tienda CHANGE empresa empresa INT DEFAULT NULL, CHANGE zona zona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE supervisor supervisor INT DEFAULT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT NULL, CHANGE rut rut VARCHAR(12) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE foto foto SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE carga CHANGE columna1 columna1 VARCHAR(255) DEFAULT NULL, CHANGE columna2 columna2 VARCHAR(255) DEFAULT NULL, CHANGE columna3 columna3 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE carga_meta');
        $this->addSql('ALTER TABLE carga CHANGE columna1 columna1 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE columna2 columna2 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE columna3 columna3 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tienda CHANGE empresa empresa INT DEFAULT NULL, CHANGE zona zona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE supervisor supervisor INT DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rut rut VARCHAR(12) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE foto foto SMALLINT DEFAULT NULL');
    }
}

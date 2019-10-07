<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191006173606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tienda ADD name INT DEFAULT NULL, DROP empresa');
        $this->addSql('ALTER TABLE tienda ADD CONSTRAINT FK_C0C6E53E5E237E06 FOREIGN KEY (name) REFERENCES empresa (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0C6E53E5E237E06 ON tienda (name)');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT NULL, CHANGE rut rut VARCHAR(12) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE foto foto SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tienda DROP FOREIGN KEY FK_C0C6E53E5E237E06');
        $this->addSql('DROP INDEX UNIQ_C0C6E53E5E237E06 ON tienda');
        $this->addSql('ALTER TABLE tienda ADD empresa VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP name');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rut rut VARCHAR(12) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE foto foto SMALLINT DEFAULT NULL');
    }
}

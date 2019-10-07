<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190929060657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trabajador DROP FOREIGN KEY FK_42157CDFEADC3BE5');
        $this->addSql('DROP INDEX UNIQ_42157CDFEADC3BE5 ON trabajador');
        $this->addSql('ALTER TABLE trabajador CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT NULL, CHANGE rut rut VARCHAR(12) DEFAULT NULL, CHANGE foto id_foto INT NOT NULL');
        $this->addSql('ALTER TABLE trabajador ADD CONSTRAINT FK_42157CDF61FC27E7 FOREIGN KEY (id_foto) REFERENCES item (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42157CDF61FC27E7 ON trabajador (id_foto)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE foto foto SMALLINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trabajador DROP FOREIGN KEY FK_42157CDF61FC27E7');
        $this->addSql('DROP INDEX UNIQ_42157CDF61FC27E7 ON trabajador');
        $this->addSql('ALTER TABLE trabajador CHANGE pass pass VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rut rut VARCHAR(12) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE id_foto foto INT NOT NULL');
        $this->addSql('ALTER TABLE trabajador ADD CONSTRAINT FK_42157CDFEADC3BE5 FOREIGN KEY (foto) REFERENCES item (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42157CDFEADC3BE5 ON trabajador (foto)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE foto foto SMALLINT DEFAULT NULL');
    }
}

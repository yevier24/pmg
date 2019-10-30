<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029224753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gastos (id INT AUTO_INCREMENT NOT NULL, modelo_pdv_1 VARCHAR(255) DEFAULT NULL, tipo_pdv_1 VARCHAR(255) DEFAULT NULL, pdv_1_q VARCHAR(255) DEFAULT NULL, modelo_pdv_2 VARCHAR(255) DEFAULT NULL, tipo_pdv_2 VARCHAR(255) DEFAULT NULL, pdv_2_q VARCHAR(255) DEFAULT NULL, sup_dias_se VARCHAR(255) DEFAULT NULL, tipo_supervision VARCHAR(255) DEFAULT NULL, zona_ciudad VARCHAR(255) DEFAULT NULL, cadena VARCHAR(255) DEFAULT NULL, tienda VARCHAR(255) DEFAULT NULL, venta_promedio VARCHAR(255) DEFAULT NULL, incremento_venta VARCHAR(255) DEFAULT NULL, venta_total VARCHAR(255) DEFAULT NULL, comision_retail VARCHAR(255) DEFAULT NULL, margen_tienda VARCHAR(255) DEFAULT NULL, supervision VARCHAR(255) DEFAULT NULL, vendedor_reposicion_01 VARCHAR(255) DEFAULT NULL, vendedor_reposicion_02 VARCHAR(255) DEFAULT NULL, bodegaje VARCHAR(255) DEFAULT NULL, packing VARCHAR(255) DEFAULT NULL, picking VARCHAR(255) DEFAULT NULL, transporte VARCHAR(255) DEFAULT NULL, costo_mercaderia VARCHAR(255) DEFAULT NULL, merma VARCHAR(255) DEFAULT NULL, muebles VARCHAR(255) DEFAULT NULL, margen_operacional VARCHAR(255) DEFAULT NULL, gastos_administracion VARCHAR(255) DEFAULT NULL, resultado_actual VARCHAR(255) DEFAULT NULL, resultado_modelo VARCHAR(255) DEFAULT NULL, diferencial VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tienda CHANGE empresa empresa INT DEFAULT NULL, CHANGE zona zona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE supervisor supervisor INT DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE rut rut VARCHAR(12) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE foto foto SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE carga CHANGE columna1 columna1 VARCHAR(255) DEFAULT NULL, CHANGE columna2 columna2 VARCHAR(255) DEFAULT NULL, CHANGE columna3 columna3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE carga_meta CHANGE cadena cadena INT DEFAULT NULL, CHANGE tienda tienda INT DEFAULT NULL, CHANGE venta venta NUMERIC(11, 2) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE gastos');
        $this->addSql('ALTER TABLE carga CHANGE columna1 columna1 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE columna2 columna2 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE columna3 columna3 VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE carga_meta CHANGE cadena cadena INT DEFAULT NULL, CHANGE tienda tienda INT DEFAULT NULL, CHANGE venta venta NUMERIC(11, 2) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE tienda CHANGE empresa empresa INT DEFAULT NULL, CHANGE zona zona INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE foto foto INT DEFAULT NULL, CHANGE supervisor supervisor INT DEFAULT NULL, CHANGE pass pass VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE rut rut VARCHAR(12) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone INT DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE foto foto SMALLINT DEFAULT NULL');
    }
}

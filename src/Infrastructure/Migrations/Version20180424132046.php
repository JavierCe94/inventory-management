<?php declare(strict_types = 1);

namespace Inventory\Management\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424132046 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE garment_size (id INTEGER NOT NULL, garment_id INTEGER NOT NULL, size_id INTEGER NOT NULL, stock INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_56234C9A9CDB257C ON garment_size (garment_id)');
        $this->addSql('CREATE INDEX IDX_56234C9A498DA827 ON garment_size (size_id)');
        $this->addSql('CREATE TABLE size (id INTEGER NOT NULL, size_type_id INTEGER NOT NULL, size_value VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7C0246A20215EEB ON size (size_type_id)');
        $this->addSql('CREATE TABLE size_type (id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE garment (id INTEGER NOT NULL, garment_type_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B881175CE4AFAD8F ON garment (garment_type_id)');
        $this->addSql('CREATE TABLE garment_type (id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE film (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, url VARCHAR(75) DEFAULT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8244BE22A7FF5209 ON film (request_employee_id)');
        $this->addSql('CREATE TABLE request_employee_garment (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, garment_size_id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D4EC0DEA7FF5209 ON request_employee_garment (request_employee_id)');
        $this->addSql('CREATE INDEX IDX_5D4EC0DE686E893B ON request_employee_garment (garment_size_id)');
        $this->addSql('CREATE TABLE request_employee (id INTEGER NOT NULL, employee INTEGER NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE garment_size');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE size_type');
        $this->addSql('DROP TABLE garment');
        $this->addSql('DROP TABLE garment_type');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE request_employee_garment');
        $this->addSql('DROP TABLE request_employee');
    }
}

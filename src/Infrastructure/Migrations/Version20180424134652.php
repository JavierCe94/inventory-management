<?php declare(strict_types = 1);

namespace Inventory\Management\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424134652 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE department (id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee (id INTEGER NOT NULL, employee_status_id INTEGER DEFAULT NULL, image VARCHAR(100) DEFAULT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL, name VARCHAR(50) DEFAULT \'-\' NOT NULL, in_ss_number VARCHAR(30) DEFAULT \'-\' NOT NULL, telephone VARCHAR(12) DEFAULT \'-\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1ADE62BBB ON employee (nif)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A19DADBEC7 ON employee (in_ss_number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1450FF010 ON employee (telephone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A16E6768FF ON employee (employee_status_id)');
        $this->addSql('CREATE TABLE employee_status (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, sub_department_id INTEGER DEFAULT NULL, first_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, seniority_date DATETIME DEFAULT \'00/00/00\' NOT NULL, expiration_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, possible_renewal DATETIME DEFAULT \'00/00/00\' NOT NULL, available_holly_days INTEGER DEFAULT 0 NOT NULL, holly_days_pending_to_apply_for INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5231A189AE80F5DF ON employee_status (department_id)');
        $this->addSql('CREATE INDEX IDX_5231A189612D3201 ON employee_status (sub_department_id)');
        $this->addSql('CREATE TABLE sub_department (id INTEGER NOT NULL, department_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1D67247AE80F5DF ON sub_department (department_id)');
        $this->addSql('DROP INDEX IDX_B881175CE4AFAD8F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__garment AS SELECT id, garment_type_id, name FROM garment');
        $this->addSql('DROP TABLE garment');
        $this->addSql('CREATE TABLE garment (id INTEGER NOT NULL, garment_type_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_B881175CE4AFAD8F FOREIGN KEY (garment_type_id) REFERENCES garment_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO garment (id, garment_type_id, name) SELECT id, garment_type_id, name FROM __temp__garment');
        $this->addSql('DROP TABLE __temp__garment');
        $this->addSql('CREATE INDEX IDX_B881175CE4AFAD8F ON garment (garment_type_id)');
        $this->addSql('DROP INDEX IDX_56234C9A498DA827');
        $this->addSql('DROP INDEX IDX_56234C9A9CDB257C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__garment_size AS SELECT id, garment_id, size_id, stock FROM garment_size');
        $this->addSql('DROP TABLE garment_size');
        $this->addSql('CREATE TABLE garment_size (id INTEGER NOT NULL, garment_id INTEGER NOT NULL, size_id INTEGER NOT NULL, stock INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_56234C9A9CDB257C FOREIGN KEY (garment_id) REFERENCES garment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_56234C9A498DA827 FOREIGN KEY (size_id) REFERENCES size (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO garment_size (id, garment_id, size_id, stock) SELECT id, garment_id, size_id, stock FROM __temp__garment_size');
        $this->addSql('DROP TABLE __temp__garment_size');
        $this->addSql('CREATE INDEX IDX_56234C9A498DA827 ON garment_size (size_id)');
        $this->addSql('CREATE INDEX IDX_56234C9A9CDB257C ON garment_size (garment_id)');
        $this->addSql('DROP INDEX IDX_F7C0246A20215EEB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__size AS SELECT id, size_type_id, size_value FROM size');
        $this->addSql('DROP TABLE size');
        $this->addSql('CREATE TABLE size (id INTEGER NOT NULL, size_type_id INTEGER NOT NULL, size_value VARCHAR(3) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_F7C0246A20215EEB FOREIGN KEY (size_type_id) REFERENCES size_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO size (id, size_type_id, size_value) SELECT id, size_type_id, size_value FROM __temp__size');
        $this->addSql('DROP TABLE __temp__size');
        $this->addSql('CREATE INDEX IDX_F7C0246A20215EEB ON size (size_type_id)');
        $this->addSql('DROP INDEX IDX_8244BE22A7FF5209');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film AS SELECT id, request_employee_id, url, date_creation FROM film');
        $this->addSql('DROP TABLE film');
        $this->addSql('CREATE TABLE film (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, url VARCHAR(75) DEFAULT NULL COLLATE BINARY, date_creation DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_8244BE22A7FF5209 FOREIGN KEY (request_employee_id) REFERENCES request_employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO film (id, request_employee_id, url, date_creation) SELECT id, request_employee_id, url, date_creation FROM __temp__film');
        $this->addSql('DROP TABLE __temp__film');
        $this->addSql('CREATE INDEX IDX_8244BE22A7FF5209 ON film (request_employee_id)');
        $this->addSql('DROP INDEX IDX_5D4EC0DE686E893B');
        $this->addSql('DROP INDEX IDX_5D4EC0DEA7FF5209');
        $this->addSql('CREATE TEMPORARY TABLE __temp__request_employee_garment AS SELECT id, request_employee_id, garment_size_id FROM request_employee_garment');
        $this->addSql('DROP TABLE request_employee_garment');
        $this->addSql('CREATE TABLE request_employee_garment (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, garment_size_id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_5D4EC0DEA7FF5209 FOREIGN KEY (request_employee_id) REFERENCES request_employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5D4EC0DE686E893B FOREIGN KEY (garment_size_id) REFERENCES garment_size (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO request_employee_garment (id, request_employee_id, garment_size_id) SELECT id, request_employee_id, garment_size_id FROM __temp__request_employee_garment');
        $this->addSql('DROP TABLE __temp__request_employee_garment');
        $this->addSql('CREATE INDEX IDX_5D4EC0DE686E893B ON request_employee_garment (garment_size_id)');
        $this->addSql('CREATE INDEX IDX_5D4EC0DEA7FF5209 ON request_employee_garment (request_employee_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_status');
        $this->addSql('DROP TABLE sub_department');
        $this->addSql('DROP INDEX IDX_8244BE22A7FF5209');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film AS SELECT id, request_employee_id, url, date_creation FROM film');
        $this->addSql('DROP TABLE film');
        $this->addSql('CREATE TABLE film (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, url VARCHAR(75) DEFAULT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO film (id, request_employee_id, url, date_creation) SELECT id, request_employee_id, url, date_creation FROM __temp__film');
        $this->addSql('DROP TABLE __temp__film');
        $this->addSql('CREATE INDEX IDX_8244BE22A7FF5209 ON film (request_employee_id)');
        $this->addSql('DROP INDEX IDX_B881175CE4AFAD8F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__garment AS SELECT id, garment_type_id, name FROM garment');
        $this->addSql('DROP TABLE garment');
        $this->addSql('CREATE TABLE garment (id INTEGER NOT NULL, garment_type_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO garment (id, garment_type_id, name) SELECT id, garment_type_id, name FROM __temp__garment');
        $this->addSql('DROP TABLE __temp__garment');
        $this->addSql('CREATE INDEX IDX_B881175CE4AFAD8F ON garment (garment_type_id)');
        $this->addSql('DROP INDEX IDX_56234C9A9CDB257C');
        $this->addSql('DROP INDEX IDX_56234C9A498DA827');
        $this->addSql('CREATE TEMPORARY TABLE __temp__garment_size AS SELECT id, garment_id, size_id, stock FROM garment_size');
        $this->addSql('DROP TABLE garment_size');
        $this->addSql('CREATE TABLE garment_size (id INTEGER NOT NULL, garment_id INTEGER NOT NULL, size_id INTEGER NOT NULL, stock INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO garment_size (id, garment_id, size_id, stock) SELECT id, garment_id, size_id, stock FROM __temp__garment_size');
        $this->addSql('DROP TABLE __temp__garment_size');
        $this->addSql('CREATE INDEX IDX_56234C9A9CDB257C ON garment_size (garment_id)');
        $this->addSql('CREATE INDEX IDX_56234C9A498DA827 ON garment_size (size_id)');
        $this->addSql('DROP INDEX IDX_5D4EC0DEA7FF5209');
        $this->addSql('DROP INDEX IDX_5D4EC0DE686E893B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__request_employee_garment AS SELECT id, request_employee_id, garment_size_id FROM request_employee_garment');
        $this->addSql('DROP TABLE request_employee_garment');
        $this->addSql('CREATE TABLE request_employee_garment (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, garment_size_id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO request_employee_garment (id, request_employee_id, garment_size_id) SELECT id, request_employee_id, garment_size_id FROM __temp__request_employee_garment');
        $this->addSql('DROP TABLE __temp__request_employee_garment');
        $this->addSql('CREATE INDEX IDX_5D4EC0DEA7FF5209 ON request_employee_garment (request_employee_id)');
        $this->addSql('CREATE INDEX IDX_5D4EC0DE686E893B ON request_employee_garment (garment_size_id)');
        $this->addSql('DROP INDEX IDX_F7C0246A20215EEB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__size AS SELECT id, size_type_id, size_value FROM size');
        $this->addSql('DROP TABLE size');
        $this->addSql('CREATE TABLE size (id INTEGER NOT NULL, size_type_id INTEGER NOT NULL, size_value VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO size (id, size_type_id, size_value) SELECT id, size_type_id, size_value FROM __temp__size');
        $this->addSql('DROP TABLE __temp__size');
        $this->addSql('CREATE INDEX IDX_F7C0246A20215EEB ON size (size_type_id)');
    }
}

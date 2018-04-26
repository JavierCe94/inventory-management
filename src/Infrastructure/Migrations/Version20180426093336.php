<?php declare(strict_types = 1);

namespace Inventory\Management\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426093336 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE department (id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employee (id INTEGER NOT NULL, employee_status_id INTEGER DEFAULT NULL, type_admin BOOLEAN DEFAULT \'0\' NOT NULL, image VARCHAR(100) DEFAULT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL, name VARCHAR(50) DEFAULT \'-\' NOT NULL, in_ss_number VARCHAR(30) DEFAULT \'-\' NOT NULL, telephone VARCHAR(12) DEFAULT \'-\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1ADE62BBB ON employee (nif)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A19DADBEC7 ON employee (in_ss_number)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A1450FF010 ON employee (telephone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D9F75A16E6768FF ON employee (employee_status_id)');
        $this->addSql('CREATE TABLE employee_status (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, sub_department_id INTEGER DEFAULT NULL, first_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, seniority_date DATETIME DEFAULT \'00/00/00\' NOT NULL, expiration_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, possible_renewal DATETIME DEFAULT \'00/00/00\' NOT NULL, available_holi_days INTEGER DEFAULT 0 NOT NULL, holi_days_pending_to_apply_for INTEGER DEFAULT 0 NOT NULL, disabled_employee BOOLEAN DEFAULT \'0\' NOT NULL, holidays_pending_to_apply_for INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5231A189AE80F5DF ON employee_status (department_id)');
        $this->addSql('CREATE INDEX IDX_5231A189612D3201 ON employee_status (sub_department_id)');
        $this->addSql('CREATE TABLE sub_department (id INTEGER NOT NULL, department_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1D67247AE80F5DF ON sub_department (department_id)');
        $this->addSql('CREATE TABLE garment_size (id INTEGER NOT NULL, garment_id INTEGER NOT NULL, size_id INTEGER NOT NULL, stock INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_56234C9A9CDB257C ON garment_size (garment_id)');
        $this->addSql('CREATE INDEX IDX_56234C9A498DA827 ON garment_size (size_id)');
        $this->addSql('CREATE TABLE garment (id INTEGER NOT NULL, garment_type_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B881175CE4AFAD8F ON garment (garment_type_id)');
        $this->addSql('CREATE TABLE garment_type (id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE size (id INTEGER NOT NULL, garment_type_id INTEGER NOT NULL, size_value VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7C0246AE4AFAD8F ON size (garment_type_id)');
        $this->addSql('CREATE TABLE firm (id INTEGER NOT NULL, request_employee_id INTEGER DEFAULT NULL, url VARCHAR(75) DEFAULT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_560581FDA7FF5209 ON firm (request_employee_id)');
        $this->addSql('CREATE TABLE request_employee (id INTEGER NOT NULL, employee INTEGER NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE request_employee_garment (id INTEGER NOT NULL, request_employee_id INTEGER NOT NULL, garment_size_id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D4EC0DEA7FF5209 ON request_employee_garment (request_employee_id)');
        $this->addSql('CREATE INDEX IDX_5D4EC0DE686E893B ON request_employee_garment (garment_size_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_status');
        $this->addSql('DROP TABLE sub_department');
        $this->addSql('DROP TABLE garment_size');
        $this->addSql('DROP TABLE garment');
        $this->addSql('DROP TABLE garment_type');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE firm');
        $this->addSql('DROP TABLE request_employee');
        $this->addSql('DROP TABLE request_employee_garment');
    }
}

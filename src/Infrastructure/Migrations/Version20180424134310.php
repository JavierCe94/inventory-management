<?php declare(strict_types = 1);

namespace App\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424134310 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_9FB2BF62E9F7ADAE');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62ADE62BBB');
        $this->addSql('DROP INDEX UNIQ_9FB2BF6282D4FFC8');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62F037AB0F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, nif, image, name, inssnumber, tel FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL COLLATE BINARY, image VARCHAR(100) DEFAULT NULL COLLATE BINARY, name VARCHAR(50) DEFAULT \'-\' NOT NULL COLLATE BINARY, inssnumber VARCHAR(30) DEFAULT \'-\' NOT NULL COLLATE BINARY, tel VARCHAR(12) DEFAULT \'-\' NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker (id, nif, image, name, inssnumber, tel) SELECT id, nif, image, name, inssnumber, tel FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62ADE62BBB ON worker (nif)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF6282D4FFC8 ON worker (inssnumber)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62F037AB0F ON worker (tel)');
        $this->addSql('DROP INDEX IDX_FAA2D475AE80F5DF');
        $this->addSql('DROP INDEX IDX_FAA2D475612D3201');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker_status AS SELECT id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for FROM worker_status');
        $this->addSql('DROP TABLE worker_status');
        $this->addSql('CREATE TABLE worker_status (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, sub_department_id INTEGER DEFAULT NULL, worker_id INTEGER DEFAULT NULL, first_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, seniority_date DATETIME DEFAULT \'00/00/00\' NOT NULL, expiration_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, possible_renewal DATETIME DEFAULT \'00/00/00\' NOT NULL, available_hollydays INTEGER DEFAULT 0 NOT NULL, hollydays_pending_to_apply_for INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_FAA2D475AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FAA2D475612D3201 FOREIGN KEY (sub_department_id) REFERENCES sub_department (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FAA2D4756B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO worker_status (id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for) SELECT id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for FROM __temp__worker_status');
        $this->addSql('DROP TABLE __temp__worker_status');
        $this->addSql('CREATE INDEX IDX_FAA2D475AE80F5DF ON worker_status (department_id)');
        $this->addSql('CREATE INDEX IDX_FAA2D475612D3201 ON worker_status (sub_department_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FAA2D4756B20BA36 ON worker_status (worker_id)');
        $this->addSql('DROP INDEX UNIQ_CD1DE18AE9F7ADAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__department AS SELECT id, worker_status_id FROM department');
        $this->addSql('DROP TABLE department');
        $this->addSql('CREATE TABLE department (id INTEGER NOT NULL, worker_status_id INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_CD1DE18AE9F7ADAE FOREIGN KEY (worker_status_id) REFERENCES worker_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO department (id, worker_status_id) SELECT id, worker_status_id FROM __temp__department');
        $this->addSql('DROP TABLE __temp__department');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD1DE18AE9F7ADAE ON department (worker_status_id)');
        $this->addSql('DROP INDEX IDX_E1D67247AE80F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sub_department AS SELECT id, department_id FROM sub_department');
        $this->addSql('DROP TABLE sub_department');
        $this->addSql('CREATE TABLE sub_department (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_E1D67247AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sub_department (id, department_id) SELECT id, department_id FROM __temp__sub_department');
        $this->addSql('DROP TABLE __temp__sub_department');
        $this->addSql('CREATE INDEX IDX_E1D67247AE80F5DF ON sub_department (department_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_CD1DE18AE9F7ADAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__department AS SELECT id, worker_status_id FROM department');
        $this->addSql('DROP TABLE department');
        $this->addSql('CREATE TABLE department (id INTEGER NOT NULL, worker_status_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO department (id, worker_status_id) SELECT id, worker_status_id FROM __temp__department');
        $this->addSql('DROP TABLE __temp__department');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CD1DE18AE9F7ADAE ON department (worker_status_id)');
        $this->addSql('DROP INDEX IDX_E1D67247AE80F5DF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sub_department AS SELECT id, department_id FROM sub_department');
        $this->addSql('DROP TABLE sub_department');
        $this->addSql('CREATE TABLE sub_department (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sub_department (id, department_id) SELECT id, department_id FROM __temp__sub_department');
        $this->addSql('DROP TABLE __temp__sub_department');
        $this->addSql('CREATE INDEX IDX_E1D67247AE80F5DF ON sub_department (department_id)');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62ADE62BBB');
        $this->addSql('DROP INDEX UNIQ_9FB2BF6282D4FFC8');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62F037AB0F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, image, nif, name, inssnumber, tel FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, image VARCHAR(100) DEFAULT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL, name VARCHAR(50) DEFAULT \'-\' NOT NULL, inssnumber VARCHAR(30) DEFAULT \'-\' NOT NULL, tel VARCHAR(12) DEFAULT \'-\' NOT NULL, worker_status_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker (id, image, nif, name, inssnumber, tel) SELECT id, image, nif, name, inssnumber, tel FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62ADE62BBB ON worker (nif)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF6282D4FFC8 ON worker (inssnumber)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62F037AB0F ON worker (tel)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62E9F7ADAE ON worker (worker_status_id)');
        $this->addSql('DROP INDEX IDX_FAA2D475AE80F5DF');
        $this->addSql('DROP INDEX IDX_FAA2D475612D3201');
        $this->addSql('DROP INDEX UNIQ_FAA2D4756B20BA36');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker_status AS SELECT id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for FROM worker_status');
        $this->addSql('DROP TABLE worker_status');
        $this->addSql('CREATE TABLE worker_status (id INTEGER NOT NULL, department_id INTEGER DEFAULT NULL, sub_department_id INTEGER DEFAULT NULL, first_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, seniority_date DATETIME DEFAULT \'00/00/00\' NOT NULL, expiration_contract_date DATETIME DEFAULT \'00/00/00\' NOT NULL, possible_renewal DATETIME DEFAULT \'00/00/00\' NOT NULL, available_hollydays INTEGER DEFAULT 0 NOT NULL, hollydays_pending_to_apply_for INTEGER DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker_status (id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for) SELECT id, department_id, sub_department_id, first_contract_date, seniority_date, expiration_contract_date, possible_renewal, available_hollydays, hollydays_pending_to_apply_for FROM __temp__worker_status');
        $this->addSql('DROP TABLE __temp__worker_status');
        $this->addSql('CREATE INDEX IDX_FAA2D475AE80F5DF ON worker_status (department_id)');
        $this->addSql('CREATE INDEX IDX_FAA2D475612D3201 ON worker_status (sub_department_id)');
    }
}

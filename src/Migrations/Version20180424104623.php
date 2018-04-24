<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424104623 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_9FB2BF62E9F7ADAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, worker_status_id, nif, image, name, inssnumber, tel FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, worker_status_id INTEGER DEFAULT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL COLLATE BINARY, image VARCHAR(100) DEFAULT NULL COLLATE BINARY, name VARCHAR(50) DEFAULT \'-\' NOT NULL COLLATE BINARY, inssnumber VARCHAR(30) DEFAULT \'-\' NOT NULL COLLATE BINARY, tel VARCHAR(12) DEFAULT \'-\' NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_9FB2BF62E9F7ADAE FOREIGN KEY (worker_status_id) REFERENCES worker_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO worker (id, worker_status_id, nif, image, name, inssnumber, tel) SELECT id, worker_status_id, nif, image, name, inssnumber, tel FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62E9F7ADAE ON worker (worker_status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62ADE62BBB ON worker (nif)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF6282D4FFC8 ON worker (inssnumber)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62F037AB0F ON worker (tel)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_9FB2BF62ADE62BBB');
        $this->addSql('DROP INDEX UNIQ_9FB2BF6282D4FFC8');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62F037AB0F');
        $this->addSql('DROP INDEX UNIQ_9FB2BF62E9F7ADAE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, worker_status_id, image, nif, name, inssnumber, tel FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, worker_status_id INTEGER DEFAULT NULL, image VARCHAR(100) DEFAULT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL, name VARCHAR(50) DEFAULT \'-\' NOT NULL, inssnumber VARCHAR(30) DEFAULT \'-\' NOT NULL, tel VARCHAR(9) DEFAULT \'-\' NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker (id, worker_status_id, image, nif, name, inssnumber, tel) SELECT id, worker_status_id, image, nif, name, inssnumber, tel FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9FB2BF62E9F7ADAE ON worker (worker_status_id)');
    }
}

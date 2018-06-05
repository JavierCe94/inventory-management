<?php declare(strict_types=1);

namespace Inventory\Management\Infrastructure\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180605073856 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE size_type');
        $this->addSql('ALTER TABLE request_employee CHANGE date_modification date_modification DATETIME NOT NULL, CHANGE status status VARCHAR(50) NOT NULL, CHANGE employee employee_id INT NOT NULL');
        $this->addSql('ALTER TABLE request_employee ADD CONSTRAINT FK_A8BA95848C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_A8BA95848C03F15C ON request_employee (employee_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE size_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE request_employee DROP FOREIGN KEY FK_A8BA95848C03F15C');
        $this->addSql('DROP INDEX IDX_A8BA95848C03F15C ON request_employee');
        $this->addSql('ALTER TABLE request_employee CHANGE date_modification date_modification DATETIME DEFAULT NULL, CHANGE status status VARCHAR(50) DEFAULT \'DRAFT\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE employee_id employee INT NOT NULL');
    }
}

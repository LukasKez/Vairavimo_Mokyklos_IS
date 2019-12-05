<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205113825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE marsrutas ADD filialas_id INT NOT NULL');
        $this->addSql('ALTER TABLE marsrutas ADD CONSTRAINT FK_98C435F89DC8CED0 FOREIGN KEY (filialas_id) REFERENCES filialas (id)');
        $this->addSql('CREATE INDEX IDX_98C435F89DC8CED0 ON marsrutas (filialas_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE marsrutas DROP FOREIGN KEY FK_98C435F89DC8CED0');
        $this->addSql('DROP INDEX IDX_98C435F89DC8CED0 ON marsrutas');
        $this->addSql('ALTER TABLE marsrutas DROP filialas_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191207144211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis ADD instruktorius INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis ADD CONSTRAINT FK_FE3E4782FAE2CE4C FOREIGN KEY (instruktorius) REFERENCES instruktorius (id)');
        $this->addSql('CREATE INDEX IDX_FE3E4782FAE2CE4C ON instruktoriaus_tvarkarastis (instruktorius)');
        $this->addSql('ALTER TABLE kliento_tvarkarastis ADD klientas INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kliento_tvarkarastis ADD CONSTRAINT FK_A4279CCFE777D966 FOREIGN KEY (klientas) REFERENCES klientas (id)');
        $this->addSql('CREATE INDEX IDX_A4279CCFE777D966 ON kliento_tvarkarastis (klientas)');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis DROP FOREIGN KEY FK_FE3E4782FAE2CE4C');
        $this->addSql('DROP INDEX IDX_FE3E4782FAE2CE4C ON instruktoriaus_tvarkarastis');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis DROP instruktorius');
        $this->addSql('ALTER TABLE kliento_tvarkarastis DROP FOREIGN KEY FK_A4279CCFE777D966');
        $this->addSql('DROP INDEX IDX_A4279CCFE777D966 ON kliento_tvarkarastis');
        $this->addSql('ALTER TABLE kliento_tvarkarastis DROP klientas');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}

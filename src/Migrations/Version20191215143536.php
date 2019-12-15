<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191215143536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE algalapis (id INT AUTO_INCREMENT NOT NULL, instruktorius INT DEFAULT NULL, instruktoriaus_tvarkarastis INT DEFAULT NULL, data DATE NOT NULL, dirbtos_valandos INT NOT NULL, valandinis_uzmokestis DOUBLE PRECISION NOT NULL, atlyginimas DOUBLE PRECISION NOT NULL, INDEX IDX_5176083BFAE2CE4C (instruktorius), INDEX IDX_5176083BFE3E4782 (instruktoriaus_tvarkarastis), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE algalapis ADD CONSTRAINT FK_5176083BFAE2CE4C FOREIGN KEY (instruktorius) REFERENCES instruktorius (id)');
        $this->addSql('ALTER TABLE algalapis ADD CONSTRAINT FK_5176083BFE3E4782 FOREIGN KEY (instruktoriaus_tvarkarastis) REFERENCES instruktoriaus_tvarkarastis (id)');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL');
        $this->addSql('ALTER TABLE pravaziavimas CHANGE ivertinimas ivertinimas DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE algalapis');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE pravaziavimas CHANGE ivertinimas ivertinimas DOUBLE PRECISION NOT NULL');
    }
}

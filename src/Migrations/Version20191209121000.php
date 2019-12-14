<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209121000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE egzaminas DROP laikas, CHANGE data data DATETIME NOT NULL');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis CHANGE pradzia pradzia DATETIME NOT NULL, CHANGE pabaiga pabaiga DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE egzaminas ADD laikas VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE data data DATE NOT NULL');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarastis CHANGE pradzia pradzia DATE NOT NULL, CHANGE pabaiga pabaiga DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}

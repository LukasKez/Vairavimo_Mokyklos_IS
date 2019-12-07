<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191207140520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instruktoriaus_tvarkarascio_egzaminas (egzaminas_id INT NOT NULL, instruktoriaus_tvarkarastis_id INT NOT NULL, INDEX IDX_AD4D5DE83B5E41A1 (egzaminas_id), INDEX IDX_AD4D5DE8FAA9CE49 (instruktoriaus_tvarkarastis_id), PRIMARY KEY(egzaminas_id, instruktoriaus_tvarkarastis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarascio_egzaminas ADD CONSTRAINT FK_AD4D5DE83B5E41A1 FOREIGN KEY (egzaminas_id) REFERENCES egzaminas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE instruktoriaus_tvarkarascio_egzaminas ADD CONSTRAINT FK_AD4D5DE8FAA9CE49 FOREIGN KEY (instruktoriaus_tvarkarastis_id) REFERENCES instruktoriaus_tvarkarastis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instruktoriaus_tvarkarascio_egzaminas');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}

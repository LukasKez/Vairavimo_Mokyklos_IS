<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191214170600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pravaziavimas (id INT AUTO_INCREMENT NOT NULL, kliento_tvarkarastis INT DEFAULT NULL, instruktoriaus_tvarkarastis INT DEFAULT NULL, data DATETIME NOT NULL, ivertinimas DOUBLE PRECISION NOT NULL, INDEX IDX_79ABDBC9A4279CCF (kliento_tvarkarastis), INDEX IDX_79ABDBC9FE3E4782 (instruktoriaus_tvarkarastis), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pravaziavimas ADD CONSTRAINT FK_79ABDBC9A4279CCF FOREIGN KEY (kliento_tvarkarastis) REFERENCES kliento_tvarkarastis (id)');
        $this->addSql('ALTER TABLE pravaziavimas ADD CONSTRAINT FK_79ABDBC9FE3E4782 FOREIGN KEY (instruktoriaus_tvarkarastis) REFERENCES instruktoriaus_tvarkarastis (id)');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL');
        $this->addSql('ALTER TABLE transporto_priemone ADD modelis INT DEFAULT NULL, ADD filialas INT DEFAULT NULL, DROP fk_filialas, DROP fk_modelis, CHANGE busena busena INT DEFAULT NULL, CHANGE pavaru_deze pavaru_deze INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporto_priemone ADD CONSTRAINT FK_503D18AA33917113 FOREIGN KEY (busena) REFERENCES transporto_priemones_busena (id)');
        $this->addSql('ALTER TABLE transporto_priemone ADD CONSTRAINT FK_503D18AABC73FE75 FOREIGN KEY (pavaru_deze) REFERENCES pavaru_deze (id)');
        $this->addSql('ALTER TABLE transporto_priemone ADD CONSTRAINT FK_503D18AAD21B5B44 FOREIGN KEY (modelis) REFERENCES modelis (id)');
        $this->addSql('ALTER TABLE transporto_priemone ADD CONSTRAINT FK_503D18AAF1217D3C FOREIGN KEY (filialas) REFERENCES filialas (id)');
        $this->addSql('CREATE INDEX IDX_503D18AA33917113 ON transporto_priemone (busena)');
        $this->addSql('CREATE INDEX IDX_503D18AABC73FE75 ON transporto_priemone (pavaru_deze)');
        $this->addSql('CREATE INDEX IDX_503D18AAD21B5B44 ON transporto_priemone (modelis)');
        $this->addSql('CREATE INDEX IDX_503D18AAF1217D3C ON transporto_priemone (filialas)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pravaziavimas');
        $this->addSql('ALTER TABLE naudotojas CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE transporto_priemone DROP FOREIGN KEY FK_503D18AA33917113');
        $this->addSql('ALTER TABLE transporto_priemone DROP FOREIGN KEY FK_503D18AABC73FE75');
        $this->addSql('ALTER TABLE transporto_priemone DROP FOREIGN KEY FK_503D18AAD21B5B44');
        $this->addSql('ALTER TABLE transporto_priemone DROP FOREIGN KEY FK_503D18AAF1217D3C');
        $this->addSql('DROP INDEX IDX_503D18AA33917113 ON transporto_priemone');
        $this->addSql('DROP INDEX IDX_503D18AABC73FE75 ON transporto_priemone');
        $this->addSql('DROP INDEX IDX_503D18AAD21B5B44 ON transporto_priemone');
        $this->addSql('DROP INDEX IDX_503D18AAF1217D3C ON transporto_priemone');
        $this->addSql('ALTER TABLE transporto_priemone ADD fk_filialas INT NOT NULL, ADD fk_modelis INT NOT NULL, DROP modelis, DROP filialas, CHANGE busena busena INT NOT NULL, CHANGE pavaru_deze pavaru_deze INT NOT NULL');
    }
}

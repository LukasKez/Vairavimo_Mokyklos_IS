<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205184646 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE egzaminas (id INT AUTO_INCREMENT NOT NULL, tipas INT DEFAULT NULL, data DATE NOT NULL, laikas VARCHAR(255) NOT NULL, adresas VARCHAR(255) NOT NULL, INDEX IDX_714CBD426D451BAB (tipas), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE egzaminu_tipai (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filialas (id INT AUTO_INCREMENT NOT NULL, miestas_id INT NOT NULL, pavadinimas VARCHAR(255) NOT NULL, adresas VARCHAR(255) NOT NULL, telefono_numeris VARCHAR(255) NOT NULL, INDEX IDX_F1217D3CA6B3B65A (miestas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instruktoriaus_tvarkarastis (id INT AUTO_INCREMENT NOT NULL, pradzia DATE NOT NULL, pabaiga DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instruktorius (id INT AUTO_INCREMENT NOT NULL, naudotojo_id INT DEFAULT NULL, filialo_id INT DEFAULT NULL, asmens_kodas VARCHAR(255) NOT NULL, vardas VARCHAR(255) NOT NULL, pavarde VARCHAR(255) NOT NULL, gimimo_data DATE NOT NULL, vairavimo_stazas_metais INT NOT NULL, telefono_numeris VARCHAR(255) NOT NULL, INDEX IDX_FAE2CE4CFB8AC1CE (naudotojo_id), INDEX IDX_FAE2CE4C33F62AB8 (filialo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE klientas (id INT AUTO_INCREMENT NOT NULL, naudotojo_id INT DEFAULT NULL, asmens_kodas VARCHAR(255) NOT NULL, vardas VARCHAR(255) NOT NULL, pavarde VARCHAR(255) NOT NULL, gimimo_metai DATE NOT NULL, telefono_numeris VARCHAR(255) NOT NULL, INDEX IDX_E777D966FB8AC1CE (naudotojo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kliento_tvarkarastis (id INT AUTO_INCREMENT NOT NULL, pradzia DATE NOT NULL, pabaiga DATE DEFAULT NULL, vairavimu_skaicius INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE laikomas_egzaminas (id INT AUTO_INCREMENT NOT NULL, rezultatas INT DEFAULT NULL, balas DOUBLE PRECISION NOT NULL, bandymo_numeris INT NOT NULL, fk_Egzaminas INT DEFAULT NULL, fk_Klientas INT DEFAULT NULL, fk_Instruktorius INT DEFAULT NULL, INDEX IDX_8861635D92E4E871 (fk_Egzaminas), INDEX IDX_8861635D2C29F8EE (fk_Klientas), INDEX IDX_8861635D2DD6F07B (fk_Instruktorius), INDEX IDX_8861635D92EE2848 (rezultatas), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marsrutas (id INT AUTO_INCREMENT NOT NULL, filialas_id INT NOT NULL, nuoroda VARCHAR(255) NOT NULL, INDEX IDX_98C435F89DC8CED0 (filialas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE miestas (id INT AUTO_INCREMENT NOT NULL, pavadinimas VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naudotojas (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles TEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9AEA1613E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rezultato_tipas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE egzaminas ADD CONSTRAINT FK_714CBD426D451BAB FOREIGN KEY (tipas) REFERENCES egzaminu_tipai (id)');
        $this->addSql('ALTER TABLE filialas ADD CONSTRAINT FK_F1217D3CA6B3B65A FOREIGN KEY (miestas_id) REFERENCES miestas (id)');
        $this->addSql('ALTER TABLE instruktorius ADD CONSTRAINT FK_FAE2CE4CFB8AC1CE FOREIGN KEY (naudotojo_id) REFERENCES naudotojas (id)');
        $this->addSql('ALTER TABLE instruktorius ADD CONSTRAINT FK_FAE2CE4C33F62AB8 FOREIGN KEY (filialo_id) REFERENCES filialas (id)');
        $this->addSql('ALTER TABLE klientas ADD CONSTRAINT FK_E777D966FB8AC1CE FOREIGN KEY (naudotojo_id) REFERENCES naudotojas (id)');
        $this->addSql('ALTER TABLE laikomas_egzaminas ADD CONSTRAINT FK_8861635D92E4E871 FOREIGN KEY (fk_Egzaminas) REFERENCES egzaminas (id)');
        $this->addSql('ALTER TABLE laikomas_egzaminas ADD CONSTRAINT FK_8861635D2C29F8EE FOREIGN KEY (fk_Klientas) REFERENCES klientas (id)');
        $this->addSql('ALTER TABLE laikomas_egzaminas ADD CONSTRAINT FK_8861635D2DD6F07B FOREIGN KEY (fk_Instruktorius) REFERENCES instruktorius (id)');
        $this->addSql('ALTER TABLE laikomas_egzaminas ADD CONSTRAINT FK_8861635D92EE2848 FOREIGN KEY (rezultatas) REFERENCES rezultato_tipas (id)');
        $this->addSql('ALTER TABLE marsrutas ADD CONSTRAINT FK_98C435F89DC8CED0 FOREIGN KEY (filialas_id) REFERENCES filialas (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE laikomas_egzaminas DROP FOREIGN KEY FK_8861635D92E4E871');
        $this->addSql('ALTER TABLE egzaminas DROP FOREIGN KEY FK_714CBD426D451BAB');
        $this->addSql('ALTER TABLE instruktorius DROP FOREIGN KEY FK_FAE2CE4C33F62AB8');
        $this->addSql('ALTER TABLE marsrutas DROP FOREIGN KEY FK_98C435F89DC8CED0');
        $this->addSql('ALTER TABLE laikomas_egzaminas DROP FOREIGN KEY FK_8861635D2DD6F07B');
        $this->addSql('ALTER TABLE laikomas_egzaminas DROP FOREIGN KEY FK_8861635D2C29F8EE');
        $this->addSql('ALTER TABLE filialas DROP FOREIGN KEY FK_F1217D3CA6B3B65A');
        $this->addSql('ALTER TABLE instruktorius DROP FOREIGN KEY FK_FAE2CE4CFB8AC1CE');
        $this->addSql('ALTER TABLE klientas DROP FOREIGN KEY FK_E777D966FB8AC1CE');
        $this->addSql('ALTER TABLE laikomas_egzaminas DROP FOREIGN KEY FK_8861635D92EE2848');
        $this->addSql('DROP TABLE egzaminas');
        $this->addSql('DROP TABLE egzaminu_tipai');
        $this->addSql('DROP TABLE filialas');
        $this->addSql('DROP TABLE instruktoriaus_tvarkarastis');
        $this->addSql('DROP TABLE instruktorius');
        $this->addSql('DROP TABLE klientas');
        $this->addSql('DROP TABLE kliento_tvarkarastis');
        $this->addSql('DROP TABLE laikomas_egzaminas');
        $this->addSql('DROP TABLE marsrutas');
        $this->addSql('DROP TABLE miestas');
        $this->addSql('DROP TABLE naudotojas');
        $this->addSql('DROP TABLE rezultato_tipas');
    }
}

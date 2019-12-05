<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205152809 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE filialas (id INT AUTO_INCREMENT NOT NULL, miestas_id INT NOT NULL, pavadinimas VARCHAR(255) NOT NULL, adresas VARCHAR(255) NOT NULL, telefono_numeris VARCHAR(255) NOT NULL, INDEX IDX_F1217D3CA6B3B65A (miestas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marsrutas (id INT AUTO_INCREMENT NOT NULL, filialas_id INT NOT NULL, nuoroda VARCHAR(255) NOT NULL, INDEX IDX_98C435F89DC8CED0 (filialas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE miestas (id INT AUTO_INCREMENT NOT NULL, pavadinimas VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE naudotojas (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles TEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9AEA1613E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filialas ADD CONSTRAINT FK_F1217D3CA6B3B65A FOREIGN KEY (miestas_id) REFERENCES miestas (id)');
        $this->addSql('ALTER TABLE marsrutas ADD CONSTRAINT FK_98C435F89DC8CED0 FOREIGN KEY (filialas_id) REFERENCES filialas (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE marsrutas DROP FOREIGN KEY FK_98C435F89DC8CED0');
        $this->addSql('ALTER TABLE filialas DROP FOREIGN KEY FK_F1217D3CA6B3B65A');
        $this->addSql('DROP TABLE filialas');
        $this->addSql('DROP TABLE marsrutas');
        $this->addSql('DROP TABLE miestas');
        $this->addSql('DROP TABLE naudotojas');
    }
}

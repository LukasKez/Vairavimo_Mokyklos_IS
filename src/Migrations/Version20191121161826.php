<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121161826 extends AbstractMigration
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
        $this->addSql('CREATE TABLE miestas (id INT AUTO_INCREMENT NOT NULL, pavadinimas VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filialas ADD CONSTRAINT FK_F1217D3CA6B3B65A FOREIGN KEY (miestas_id) REFERENCES miestas (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE filialas DROP FOREIGN KEY FK_F1217D3CA6B3B65A');
        $this->addSql('DROP TABLE filialas');
        $this->addSql('DROP TABLE miestas');
    }
}

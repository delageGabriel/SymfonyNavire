<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216163913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ais_ship_type_port (ais_ship_type_id INT NOT NULL, port_id INT NOT NULL, INDEX IDX_E2C18803479E0B84 (ais_ship_type_id), INDEX IDX_E2C1880376E92A9C (port_id), PRIMARY KEY(ais_ship_type_id, port_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE port (id INT AUTO_INCREMENT NOT NULL, idpays INT NOT NULL, nom VARCHAR(60) NOT NULL, indicatif VARCHAR(5) NOT NULL, INDEX IDX_43915DCCE750CD0E (idpays), UNIQUE INDEX portindicatif_unique (indicatif), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ais_ship_type_port ADD CONSTRAINT FK_E2C18803479E0B84 FOREIGN KEY (ais_ship_type_id) REFERENCES aisshiptype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ais_ship_type_port ADD CONSTRAINT FK_E2C1880376E92A9C FOREIGN KEY (port_id) REFERENCES port (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE port ADD CONSTRAINT FK_43915DCCE750CD0E FOREIGN KEY (idpays) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE navire ADD idpays INT NOT NULL, DROP letype');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038E750CD0E FOREIGN KEY (idpays) REFERENCES pays (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EED1038B519409E ON navire (imo)');
        $this->addSql('CREATE INDEX IDX_EED1038E750CD0E ON navire (idpays)');
        $this->addSql('CREATE UNIQUE INDEX mmsi_unique ON navire (mmsi)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ais_ship_type_port DROP FOREIGN KEY FK_E2C1880376E92A9C');
        $this->addSql('DROP TABLE ais_ship_type_port');
        $this->addSql('DROP TABLE port');
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038E750CD0E');
        $this->addSql('DROP INDEX UNIQ_EED1038B519409E ON navire');
        $this->addSql('DROP INDEX IDX_EED1038E750CD0E ON navire');
        $this->addSql('DROP INDEX mmsi_unique ON navire');
        $this->addSql('ALTER TABLE navire ADD letype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP idpays');
    }
}

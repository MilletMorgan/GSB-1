<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200407154514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE note_frais');
        $this->addSql('ALTER TABLE fiche CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frais_forfait DROP INDEX UNIQ_B64A3FAE54B12B3D, ADD INDEX IDX_B64A3FAE54B12B3D (ligne_ff_id)');
        $this->addSql('ALTER TABLE frais_forfait CHANGE ligne_ff_id ligne_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_ff CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE type_ff_id type_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_hf CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note_frais (id INT AUTO_INCREMENT NOT NULL, nb_justificatifs INT NOT NULL, montant INT NOT NULL, date_modif DATETIME NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE fiche CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frais_forfait DROP INDEX IDX_B64A3FAE54B12B3D, ADD UNIQUE INDEX UNIQ_B64A3FAE54B12B3D (ligne_ff_id)');
        $this->addSql('ALTER TABLE frais_forfait CHANGE ligne_ff_id ligne_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_ff CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE type_ff_id type_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_hf CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL');
    }
}

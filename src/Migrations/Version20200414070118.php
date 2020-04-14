<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414070118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom_vehicule VARCHAR(255) NOT NULL, INDEX IDX_292FFF1DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE fiche CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frais_forfait CHANGE ligne_ff_id ligne_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_ff CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE type_ff_id type_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_hf CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C25028246C6E55B5 ON app_users (nom)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824A625945B ON app_users (prenom)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824C35F0816 ON app_users (adresse)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C250282443C3D9C3 ON app_users (ville)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C25028245F0C5BA7 ON app_users (cp)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824F85E0677 ON app_users (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824E7927C74 ON app_users (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP INDEX UNIQ_C25028246C6E55B5 ON app_users');
        $this->addSql('DROP INDEX UNIQ_C2502824A625945B ON app_users');
        $this->addSql('DROP INDEX UNIQ_C2502824C35F0816 ON app_users');
        $this->addSql('DROP INDEX UNIQ_C250282443C3D9C3 ON app_users');
        $this->addSql('DROP INDEX UNIQ_C25028245F0C5BA7 ON app_users');
        $this->addSql('DROP INDEX UNIQ_C2502824F85E0677 ON app_users');
        $this->addSql('DROP INDEX UNIQ_C2502824E7927C74 ON app_users');
        $this->addSql('ALTER TABLE fiche CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frais_forfait CHANGE ligne_ff_id ligne_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_ff CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL, CHANGE type_ff_id type_ff_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_hf CHANGE fiche_id fiche_id INT DEFAULT NULL, CHANGE etat_id etat_id INT DEFAULT NULL');
    }
}

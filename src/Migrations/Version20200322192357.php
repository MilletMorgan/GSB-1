<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322192357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, ordre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche (id INT AUTO_INCREMENT NOT NULL, etat_id INT DEFAULT NULL, user_id INT DEFAULT NULL, mois INT NOT NULL, annee INT NOT NULL, INDEX IDX_4C13CC78D5E86FF (etat_id), INDEX IDX_4C13CC78A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais_forfait (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_ff (id INT AUTO_INCREMENT NOT NULL, fiche_id INT DEFAULT NULL, etat_id INT DEFAULT NULL, type_ff_id INT DEFAULT NULL, frais_forfait_id INT DEFAULT NULL, date_ffrais DATE NOT NULL, quantite INT NOT NULL, INDEX IDX_33D5F395DF522508 (fiche_id), INDEX IDX_33D5F395D5E86FF (etat_id), INDEX IDX_33D5F395591146FA (type_ff_id), INDEX IDX_33D5F3957B70375E (frais_forfait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_hf (id INT AUTO_INCREMENT NOT NULL, fiche_id INT DEFAULT NULL, etat_id INT DEFAULT NULL, date_frais DATE NOT NULL, label VARCHAR(255) NOT NULL, montant INT NOT NULL, INDEX IDX_AD56DE1BDF522508 (fiche_id), INDEX IDX_AD56DE1BD5E86FF (etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_frais (id INT AUTO_INCREMENT NOT NULL, nb_justificatifs INT NOT NULL, montant INT NOT NULL, date_modif DATETIME NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_ff (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, prenom VARCHAR(180) NOT NULL, adresse VARCHAR(180) NOT NULL, ville VARCHAR(180) NOT NULL, cp VARCHAR(180) NOT NULL, date_embauche DATETIME NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C25028246C6E55B5 (nom), UNIQUE INDEX UNIQ_C2502824A625945B (prenom), UNIQUE INDEX UNIQ_C2502824C35F0816 (adresse), UNIQUE INDEX UNIQ_C250282443C3D9C3 (ville), UNIQUE INDEX UNIQ_C25028245F0C5BA7 (cp), UNIQUE INDEX UNIQ_C2502824F85E0677 (username), UNIQUE INDEX UNIQ_C2502824E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395591146FA FOREIGN KEY (type_ff_id) REFERENCES type_ff (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F3957B70375E FOREIGN KEY (frais_forfait_id) REFERENCES frais_forfait (id)');
        $this->addSql('ALTER TABLE ligne_hf ADD CONSTRAINT FK_AD56DE1BDF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE ligne_hf ADD CONSTRAINT FK_AD56DE1BD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78D5E86FF');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395D5E86FF');
        $this->addSql('ALTER TABLE ligne_hf DROP FOREIGN KEY FK_AD56DE1BD5E86FF');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395DF522508');
        $this->addSql('ALTER TABLE ligne_hf DROP FOREIGN KEY FK_AD56DE1BDF522508');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F3957B70375E');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395591146FA');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('DROP TABLE frais_forfait');
        $this->addSql('DROP TABLE ligne_ff');
        $this->addSql('DROP TABLE ligne_hf');
        $this->addSql('DROP TABLE note_frais');
        $this->addSql('DROP TABLE type_ff');
        $this->addSql('DROP TABLE app_users');
    }
}

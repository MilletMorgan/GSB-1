<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221100314 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche ADD etat_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_4C13CC78D5E86FF ON fiche (etat_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC78A76ED395 ON fiche (user_id)');
        $this->addSql('ALTER TABLE ligne_ff ADD fiche_id INT DEFAULT NULL, ADD etat_id INT DEFAULT NULL, ADD type_ff_id INT DEFAULT NULL, ADD frais_forfait_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F395591146FA FOREIGN KEY (type_ff_id) REFERENCES type_ff (id)');
        $this->addSql('ALTER TABLE ligne_ff ADD CONSTRAINT FK_33D5F3957B70375E FOREIGN KEY (frais_forfait_id) REFERENCES frais_forfait (id)');
        $this->addSql('CREATE INDEX IDX_33D5F395DF522508 ON ligne_ff (fiche_id)');
        $this->addSql('CREATE INDEX IDX_33D5F395D5E86FF ON ligne_ff (etat_id)');
        $this->addSql('CREATE INDEX IDX_33D5F395591146FA ON ligne_ff (type_ff_id)');
        $this->addSql('CREATE INDEX IDX_33D5F3957B70375E ON ligne_ff (frais_forfait_id)');
        $this->addSql('ALTER TABLE ligne_hf ADD fiche_id INT DEFAULT NULL, ADD etat_id INT DEFAULT NULL, CHANGE montant montant INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_hf ADD CONSTRAINT FK_AD56DE1BDF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id)');
        $this->addSql('ALTER TABLE ligne_hf ADD CONSTRAINT FK_AD56DE1BD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('CREATE INDEX IDX_AD56DE1BDF522508 ON ligne_hf (fiche_id)');
        $this->addSql('CREATE INDEX IDX_AD56DE1BD5E86FF ON ligne_hf (etat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78D5E86FF');
        $this->addSql('ALTER TABLE fiche DROP FOREIGN KEY FK_4C13CC78A76ED395');
        $this->addSql('DROP INDEX IDX_4C13CC78D5E86FF ON fiche');
        $this->addSql('DROP INDEX IDX_4C13CC78A76ED395 ON fiche');
        $this->addSql('ALTER TABLE fiche DROP etat_id, DROP user_id');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395DF522508');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395D5E86FF');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F395591146FA');
        $this->addSql('ALTER TABLE ligne_ff DROP FOREIGN KEY FK_33D5F3957B70375E');
        $this->addSql('DROP INDEX IDX_33D5F395DF522508 ON ligne_ff');
        $this->addSql('DROP INDEX IDX_33D5F395D5E86FF ON ligne_ff');
        $this->addSql('DROP INDEX IDX_33D5F395591146FA ON ligne_ff');
        $this->addSql('DROP INDEX IDX_33D5F3957B70375E ON ligne_ff');
        $this->addSql('ALTER TABLE ligne_ff DROP fiche_id, DROP etat_id, DROP type_ff_id, DROP frais_forfait_id');
        $this->addSql('ALTER TABLE ligne_hf DROP FOREIGN KEY FK_AD56DE1BDF522508');
        $this->addSql('ALTER TABLE ligne_hf DROP FOREIGN KEY FK_AD56DE1BD5E86FF');
        $this->addSql('DROP INDEX IDX_AD56DE1BDF522508 ON ligne_hf');
        $this->addSql('DROP INDEX IDX_AD56DE1BD5E86FF ON ligne_hf');
        $this->addSql('ALTER TABLE ligne_hf DROP fiche_id, DROP etat_id, CHANGE montant montant DOUBLE PRECISION NOT NULL');
    }
}

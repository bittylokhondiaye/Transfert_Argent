<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724103649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT NOT NULL, numero_compte INT NOT NULL, nom_propriétaire LONGTEXT NOT NULL, date_creation DATE NOT NULL, montant INT NOT NULL, cniproprietaire INT NOT NULL, UNIQUE INDEX UNIQ_CFF6526098DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, user_partenaire_id INT NOT NULL, type VARCHAR(255) NOT NULL, date_transaction DATE NOT NULL, montant INT NOT NULL, numero_expediteur INT NOT NULL, cniexpediteur INT NOT NULL, numero_destinataire INT NOT NULL, cnidestinataire INT NOT NULL, INDEX IDX_723705D17650BEFC (user_partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, super_admin_id INT NOT NULL, num_compte_bancaire INT NOT NULL, linéa INT NOT NULL, adresse VARCHAR(255) NOT NULL, raison_social VARCHAR(255) NOT NULL, INDEX IDX_32FFA373BBF91D3B (super_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_partenaire (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT DEFAULT NULL, INDEX IDX_FAC105F698DE13AC (partenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_partenaire_user_partenaire (admin_partenaire_id INT NOT NULL, user_partenaire_id INT NOT NULL, INDEX IDX_74CACD21461CCCCB (admin_partenaire_id), INDEX IDX_74CACD217650BEFC (user_partenaire_id), PRIMARY KEY(admin_partenaire_id, user_partenaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, prenom LONGTEXT NOT NULL, nom LONGTEXT NOT NULL, telephone INT NOT NULL, mail VARCHAR(255) NOT NULL, cni INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526098DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D17650BEFC FOREIGN KEY (user_partenaire_id) REFERENCES user_partenaire (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373BBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE admin_partenaire ADD CONSTRAINT FK_FAC105F698DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE admin_partenaire_user_partenaire ADD CONSTRAINT FK_74CACD21461CCCCB FOREIGN KEY (admin_partenaire_id) REFERENCES admin_partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_partenaire_user_partenaire ADD CONSTRAINT FK_74CACD217650BEFC FOREIGN KEY (user_partenaire_id) REFERENCES user_partenaire (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526098DE13AC');
        $this->addSql('ALTER TABLE admin_partenaire DROP FOREIGN KEY FK_FAC105F698DE13AC');
        $this->addSql('ALTER TABLE admin_partenaire_user_partenaire DROP FOREIGN KEY FK_74CACD21461CCCCB');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA373BBF91D3B');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE admin_partenaire');
        $this->addSql('DROP TABLE admin_partenaire_user_partenaire');
        $this->addSql('DROP TABLE super_admin');
    }
}

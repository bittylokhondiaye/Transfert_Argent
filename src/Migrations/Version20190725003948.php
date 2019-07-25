<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725003948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX telephone ON user_partenaire');
        $this->addSql('DROP INDEX mot_de_passe ON user_partenaire');
        $this->addSql('DROP INDEX cni ON user_partenaire');
        $this->addSql('DROP INDEX mail ON user_partenaire');
        $this->addSql('ALTER TABLE user_partenaire CHANGE login login VARCHAR(255) NOT NULL, CHANGE nom nom LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE partenaire CHANGE mot_de_passe mot_de_passe VARCHAR(255) NOT NULL, CHANGE Mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE admin_partenaire ADD login VARCHAR(255) NOT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL, ADD prenom LONGTEXT NOT NULL, ADD nom LONGTEXT NOT NULL, ADD telephone INT NOT NULL, ADD mail VARCHAR(255) NOT NULL, ADD cni INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE admin_partenaire DROP login, DROP mot_de_passe, DROP prenom, DROP nom, DROP telephone, DROP mail, DROP cni');
        $this->addSql('ALTER TABLE partenaire CHANGE mot_de_passe mot_de_passe VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mail Mail VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_partenaire CHANGE login login VARCHAR(11) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX telephone ON user_partenaire (telephone)');
        $this->addSql('CREATE UNIQUE INDEX mot_de_passe ON user_partenaire (mot_de_passe)');
        $this->addSql('CREATE UNIQUE INDEX cni ON user_partenaire (cni)');
        $this->addSql('CREATE UNIQUE INDEX mail ON user_partenaire (mail)');
    }
}

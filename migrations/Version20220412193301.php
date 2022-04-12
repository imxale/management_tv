<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412193301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoriecsa (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diffusion (id INT AUTO_INCREMENT NOT NULL, id_programme_id INT NOT NULL, lejour DATE NOT NULL, horaire TIME NOT NULL, direct TINYINT(1) NOT NULL, INDEX IDX_5938415B417A0F9C (id_programme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emission (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, titreoriginal VARCHAR(255) DEFAULT NULL, anneproduction DATE NOT NULL, numsaison INT DEFAULT NULL, INDEX IDX_F0225CF44296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, id_emission_id INT NOT NULL, id_categoriecsa_id INT NOT NULL, titre VARCHAR(255) NOT NULL, duree BIGINT NOT NULL, INDEX IDX_3DDCB9FFFF08087 (id_emission_id), INDEX IDX_3DDCB9FFD5408C8 (id_categoriecsa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diffusion ADD CONSTRAINT FK_5938415B417A0F9C FOREIGN KEY (id_programme_id) REFERENCES programme (id)');
        $this->addSql('ALTER TABLE emission ADD CONSTRAINT FK_F0225CF44296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFFF08087 FOREIGN KEY (id_emission_id) REFERENCES emission (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFD5408C8 FOREIGN KEY (id_categoriecsa_id) REFERENCES categoriecsa (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFD5408C8');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFFF08087');
        $this->addSql('ALTER TABLE emission DROP FOREIGN KEY FK_F0225CF44296D31F');
        $this->addSql('ALTER TABLE diffusion DROP FOREIGN KEY FK_5938415B417A0F9C');
        $this->addSql('DROP TABLE categoriecsa');
        $this->addSql('DROP TABLE diffusion');
        $this->addSql('DROP TABLE emission');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

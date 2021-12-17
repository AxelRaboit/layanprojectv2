<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217091636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, siret INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD society_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E6389D24 ON user (society_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E6389D24');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP INDEX IDX_8D93D649E6389D24 ON user');
        $this->addSql('ALTER TABLE user DROP society_id');
    }
}

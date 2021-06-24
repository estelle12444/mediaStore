<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623174632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_voix (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, type_article VARCHAR(255) NOT NULL, date_de_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE FULLTEXT INDEX IDX_537EDD3FF7747B46DE44026 ON article_illustration (titre, description)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories_voix');
        $this->addSql('DROP INDEX IDX_537EDD3FF7747B46DE44026 ON article_illustration');
    }
}

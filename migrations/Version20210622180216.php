<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622180216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE FULLTEXT INDEX IDX_29DDEBD6FF7747B46DE44026 ON article_img (titre, description)');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B70A83DFF7747B46DE44026 ON article_video (titre, description)');
        $this->addSql('CREATE FULLTEXT INDEX IDX_763802A0FF7747B46DE44026 ON article_voix (titre, description)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_29DDEBD6FF7747B46DE44026 ON article_img');
        $this->addSql('DROP INDEX IDX_B70A83DFF7747B46DE44026 ON article_video');
        $this->addSql('DROP INDEX IDX_763802A0FF7747B46DE44026 ON article_voix');
    }
}

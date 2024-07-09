<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210626105040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_illustration_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_img_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE article_voix_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_voix_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personnalisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article_illustration (id INT NOT NULL, illustration_name VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) DEFAULT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, active BOOLEAN DEFAULT NULL, auteur INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_537EDD3FF7747B46DE44026 ON article_illustration (titre, description)');
        $this->addSql('CREATE TABLE article_img (id INT NOT NULL, filename VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) DEFAULT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, auteur INT DEFAULT NULL, active BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29DDEBD6FF7747B46DE44026 ON article_img (titre, description)');
        $this->addSql('CREATE TABLE article_video (id INT NOT NULL, video_name VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) DEFAULT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, active BOOLEAN DEFAULT NULL, auteur INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B70A83DFF7747B46DE44026 ON article_video (titre, description)');
        $this->addSql('CREATE TABLE article_voix (id INT NOT NULL, voix_name VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) NOT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, active BOOLEAN NOT NULL, auteur INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_763802A0FF7747B46DE44026 ON article_voix (titre, description)');
        $this->addSql('CREATE TABLE categories (id INT NOT NULL, titre VARCHAR(255) NOT NULL, type_article VARCHAR(255) NOT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sous_titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE categories_voix (id INT NOT NULL, titre VARCHAR(255) NOT NULL, type_article VARCHAR(255) NOT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personnalisation (id INT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_whatsapp VARCHAR(255) NOT NULL, type_de_projet VARCHAR(255) NOT NULL, modele_photo VARCHAR(255) NOT NULL, messages TEXT NOT NULL, created_at_messages TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(25) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, civilite VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, active BOOLEAN NOT NULL, date_de_naissance TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, numero_whatsapp VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_illustration_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_img_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_video_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_voix_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_voix_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personnalisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE article_illustration');
        $this->addSql('DROP TABLE article_img');
        $this->addSql('DROP TABLE article_video');
        $this->addSql('DROP TABLE article_voix');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_voix');
        $this->addSql('DROP TABLE personnalisation');
        $this->addSql('DROP TABLE "user"');
    }
}

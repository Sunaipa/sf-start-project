<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309154031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD author_id INT DEFAULT NULL, DROP auteur');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('ALTER TABLE comment CHANGE email email VARCHAR(80) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE title title VARCHAR(128) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE author CHANGE first_name first_name VARCHAR(45) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(45) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationality nationality VARCHAR(45) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B ON book');
        $this->addSql('ALTER TABLE book ADD auteur VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP author_id, CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE genre genre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE editeur editeur VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category CHANGE category_name category_name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comment CHANGE email email VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE category category VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

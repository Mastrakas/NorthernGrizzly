<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202134328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD type_article_id INT NOT NULL, ADD media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666F9750B9 FOREIGN KEY (type_article_id) REFERENCES type_article (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_23A0E666F9750B9 ON article (type_article_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66EA9FDD75 ON article (media_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666F9750B9');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EA9FDD75');
        $this->addSql('DROP INDEX IDX_23A0E666F9750B9 ON article');
        $this->addSql('DROP INDEX UNIQ_23A0E66EA9FDD75 ON article');
        $this->addSql('ALTER TABLE article DROP type_article_id, DROP media_id');
    }
}

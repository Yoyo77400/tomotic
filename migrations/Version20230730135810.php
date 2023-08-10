<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230730135810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD contenu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3C1CC488 FOREIGN KEY (contenu_id) REFERENCES contenu (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F3C1CC488 ON image (contenu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3C1CC488');
        $this->addSql('DROP INDEX IDX_C53D045F3C1CC488 ON image');
        $this->addSql('ALTER TABLE image DROP contenu_id');
    }
}

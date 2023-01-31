<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127034255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE img_history_slide (id INT AUTO_INCREMENT NOT NULL, slide_name_id INT DEFAULT NULL, INDEX IDX_673478A5A00E1DDF (slide_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE img_history_slide ADD CONSTRAINT FK_673478A5A00E1DDF FOREIGN KEY (slide_name_id) REFERENCES history (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_history_slide DROP FOREIGN KEY FK_673478A5A00E1DDF');
        $this->addSql('DROP TABLE img_history_slide');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127193323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_history_slide ADD history_slide_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE img_history_slide ADD CONSTRAINT FK_673478A59DA197CD FOREIGN KEY (history_slide_id) REFERENCES history (id)');
        $this->addSql('CREATE INDEX IDX_673478A59DA197CD ON img_history_slide (history_slide_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE img_history_slide DROP FOREIGN KEY FK_673478A59DA197CD');
        $this->addSql('DROP INDEX IDX_673478A59DA197CD ON img_history_slide');
        $this->addSql('ALTER TABLE img_history_slide DROP history_slide_id');
    }
}

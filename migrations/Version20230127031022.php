<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127031022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD customer_img_slide_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7D1E3D90 FOREIGN KEY (customer_img_slide_id) REFERENCES history (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F7D1E3D90 ON image (customer_img_slide_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7D1E3D90');
        $this->addSql('DROP INDEX IDX_C53D045F7D1E3D90 ON image');
        $this->addSql('ALTER TABLE image DROP customer_img_slide_id');
    }
}

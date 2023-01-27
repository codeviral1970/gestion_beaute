<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124214357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F387E8506');
        $this->addSql('DROP INDEX UNIQ_C53D045F387E8506 ON image');
        $this->addSql('ALTER TABLE image DROP user_account_image_id');
        $this->addSql('ALTER TABLE user ADD user_avatar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986D8B6F4 FOREIGN KEY (user_avatar_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986D8B6F4 ON user (user_avatar_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD user_account_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F387E8506 FOREIGN KEY (user_account_image_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F387E8506 ON image (user_account_image_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986D8B6F4');
        $this->addSql('DROP INDEX UNIQ_8D93D64986D8B6F4 ON user');
        $this->addSql('ALTER TABLE user DROP user_avatar_id');
    }
}

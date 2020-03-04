<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200226145533 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD post_url VARCHAR(255) NOT NULL, CHANGE id_source id_source INT DEFAULT NULL, CHANGE id_theme id_theme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content RENAME INDEX content_post0_fk TO IDX_FEC530A9D1AA708F');
        $this->addSql('ALTER TABLE access RENAME INDEX access_group_dash0_fk TO IDX_6692B5417BE06A7');
        $this->addSql('ALTER TABLE user CHANGE id_group_dash id_group_dash INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE access RENAME INDEX idx_6692b5417be06a7 TO access_group_dash0_FK');
        $this->addSql('ALTER TABLE content RENAME INDEX idx_fec530a9d1aa708f TO content_post0_FK');
        $this->addSql('ALTER TABLE post DROP post_url, CHANGE id_source id_source INT NOT NULL, CHANGE id_theme id_theme INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id_group_dash id_group_dash INT NOT NULL');
    }
}

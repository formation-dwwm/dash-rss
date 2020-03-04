<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302145421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD alert TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY content_tag_FK');
        $this->addSql('DROP INDEX IDX_FEC530A9D1AA708F ON content');
        $this->addSql('ALTER TABLE content DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE content CHANGE id id_content INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9205899D9 FOREIGN KEY (id_content) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9205899D9 ON content (id_content)');
        $this->addSql('ALTER TABLE content ADD PRIMARY KEY (id_content, id_post)');
        $this->addSql('ALTER TABLE access DROP FOREIGN KEY access_theme_FK');
        $this->addSql('DROP INDEX IDX_6692B5417BE06A7 ON access');
        $this->addSql('ALTER TABLE access DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE access CHANGE id id_theme INT NOT NULL');
        $this->addSql('ALTER TABLE access ADD CONSTRAINT FK_6692B5479F0A638 FOREIGN KEY (id_theme) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_6692B5479F0A638 ON access (id_theme)');
        $this->addSql('ALTER TABLE access ADD PRIMARY KEY (id_theme, id_group_dash)');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE access DROP FOREIGN KEY FK_6692B5479F0A638');
        $this->addSql('DROP INDEX IDX_6692B5479F0A638 ON access');
        $this->addSql('ALTER TABLE access DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE access CHANGE id_theme id INT NOT NULL');
        $this->addSql('ALTER TABLE access ADD CONSTRAINT access_theme_FK FOREIGN KEY (id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_6692B54BF396750 ON access (id)');
        $this->addSql('ALTER TABLE access ADD PRIMARY KEY (id, id_group_dash)');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9205899D9');
        $this->addSql('DROP INDEX IDX_FEC530A9205899D9 ON content');
        $this->addSql('ALTER TABLE content DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE content CHANGE id_content id INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT content_tag_FK FOREIGN KEY (id) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX IDX_FEC530A9BF396750 ON content (id)');
        $this->addSql('ALTER TABLE content ADD PRIMARY KEY (id, id_post)');
        $this->addSql('ALTER TABLE post DROP alert');
        $this->addSql('ALTER TABLE user DROP email');
    }
}

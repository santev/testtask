<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127123131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX unique_category_idx ON category (name)');
        $this->addSql('CREATE UNIQUE INDEX unique_currency_idx ON currency (name)');
        $this->addSql('CREATE UNIQUE INDEX unique_item_idx ON item (name, category_id)');
        $this->addSql('ALTER TABLE size ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F7C0246A12469DE2 ON size (category_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_size_idx ON size (type, value, category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE size DROP CONSTRAINT FK_F7C0246A12469DE2');
        $this->addSql('DROP INDEX IDX_F7C0246A12469DE2');
        $this->addSql('DROP INDEX unique_size_idx');
        $this->addSql('ALTER TABLE size DROP category_id');
        $this->addSql('DROP INDEX unique_currency_idx');
        $this->addSql('DROP INDEX unique_item_idx');
        $this->addSql('DROP INDEX unique_category_idx');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127084457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, currency_id INT NOT NULL, item_id INT NOT NULL, size_id INT DEFAULT NULL, value NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CAC822D938248176 ON price (currency_id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9126F525E ON price (item_id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9498DA827 ON price (size_id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D938248176 FOREIGN KEY (currency_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9498DA827 FOREIGN KEY (size_id) REFERENCES size (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD price_by_size BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1F1B251E12469DE2 ON item (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        // $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D938248176');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D9126F525E');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D9498DA827');
        $this->addSql('DROP TABLE price');
        $this->addSql('ALTER TABLE category DROP price_by_size');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251E12469DE2');
        $this->addSql('DROP INDEX IDX_1F1B251E12469DE2');
        $this->addSql('ALTER TABLE item DROP category_id');
    }
}

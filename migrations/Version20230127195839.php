<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127195839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq');
        $this->addSql('SELECT setval(\'category_id_seq\', (SELECT MAX(id) FROM category))');
        $this->addSql('ALTER TABLE category ALTER id SET DEFAULT nextval(\'category_id_seq\')');
        $this->addSql('CREATE SEQUENCE currency_id_seq');
        $this->addSql('SELECT setval(\'currency_id_seq\', (SELECT MAX(id) FROM currency))');
        $this->addSql('ALTER TABLE currency ALTER id SET DEFAULT nextval(\'currency_id_seq\')');
        $this->addSql('CREATE SEQUENCE item_id_seq');
        $this->addSql('SELECT setval(\'item_id_seq\', (SELECT MAX(id) FROM item))');
        $this->addSql('ALTER TABLE item ALTER id SET DEFAULT nextval(\'item_id_seq\')');
        $this->addSql('CREATE SEQUENCE price_id_seq');
        $this->addSql('SELECT setval(\'price_id_seq\', (SELECT MAX(id) FROM price))');
        $this->addSql('ALTER TABLE price ALTER id SET DEFAULT nextval(\'price_id_seq\')');
        $this->addSql('CREATE SEQUENCE size_id_seq');
        $this->addSql('SELECT setval(\'size_id_seq\', (SELECT MAX(id) FROM size))');
        $this->addSql('ALTER TABLE size ALTER id SET DEFAULT nextval(\'size_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE price ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE currency ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE size ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE category ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE item ALTER id DROP DEFAULT');
    }
}

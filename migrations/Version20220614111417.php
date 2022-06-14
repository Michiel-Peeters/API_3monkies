<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614111417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tip_given DROP FOREIGN KEY FK_1A928365476C47F6');
        $this->addSql('DROP INDEX IDX_1A928365476C47F6 ON tip_given');
        $this->addSql('ALTER TABLE tip_given ADD description VARCHAR(255) NOT NULL, DROP tip_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tip_given ADD tip_id INT NOT NULL, DROP description');
        $this->addSql('ALTER TABLE tip_given ADD CONSTRAINT FK_1A928365476C47F6 FOREIGN KEY (tip_id) REFERENCES tip (id)');
        $this->addSql('CREATE INDEX IDX_1A928365476C47F6 ON tip_given (tip_id)');
    }
}

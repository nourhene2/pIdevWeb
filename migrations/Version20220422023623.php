<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422023623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX fk2 ON lignedecommande');
        $this->addSql('DROP INDEX fk3 ON lignedecommande');
        $this->addSql('CREATE INDEX fk2 ON lignedecommande (prix)');
        $this->addSql('CREATE INDEX fk3 ON lignedecommande (quantite)');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) DEFAULT NULL, ADD fullname VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX fk3 ON lignedecommande');
        $this->addSql('DROP INDEX fk2 ON lignedecommande');
        $this->addSql('CREATE INDEX fk3 ON lignedecommande (quantite(768))');
        $this->addSql('CREATE INDEX fk2 ON lignedecommande (prix(768))');
        $this->addSql('ALTER TABLE user DROP image, DROP fullname');
    }
}

<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130163023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE generator_config (id INT AUTO_INCREMENT NOT NULL, seed INT NOT NULL, min INT NOT NULL, max INT NOT NULL, format LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD generator_config_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C3A524A75 FOREIGN KEY (generator_config_id) REFERENCES generator_config (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C3A524A75 ON game (generator_config_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3A524A75');
        $this->addSql('DROP TABLE generator_config');
        $this->addSql('DROP INDEX UNIQ_232B318C3A524A75 ON game');
        $this->addSql('ALTER TABLE game DROP generator_config_id');
    }
}

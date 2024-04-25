<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424225414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495567B3B43D');
        $this->addSql('DROP INDEX IDX_42C8495567B3B43D ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE users_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE user_id users_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495567B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C8495567B3B43D ON reservation (users_id)');
    }
}

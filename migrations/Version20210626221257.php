<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210626221257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create bill table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE bill (
          id VARCHAR(36) NOT NULL,
          number VARCHAR(20) NOT NULL,
          period_from DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
          period_to DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
          tax_percent DOUBLE PRECISION NOT NULL,
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE bill');
    }
}

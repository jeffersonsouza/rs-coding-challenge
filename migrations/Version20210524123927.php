<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524123927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDED17F50A6 ON booking (uuid)');
        $this->addSql('ALTER TABLE booking_equipment CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_400A1E80D17F50A6 ON booking_equipment (uuid)');
        $this->addSql('ALTER TABLE booking_equipment RENAME INDEX idx_d4ae03423301c60 TO IDX_400A1E803301C60');
        $this->addSql('ALTER TABLE booking_equipment RENAME INDEX idx_d4ae0342517fe9fe TO IDX_400A1E80517FE9FE');
        $this->addSql('ALTER TABLE campervan CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6891BB7FD17F50A6 ON campervan (uuid)');
        $this->addSql('ALTER TABLE equipment CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D338D583D17F50A6 ON equipment (uuid)');
        $this->addSql('ALTER TABLE station CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F39F8B1D17F50A6 ON station (uuid)');
        $this->addSql('ALTER TABLE station_equipment CHANGE uuid uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51BCBB98D17F50A6 ON station_equipment (uuid)');
        $this->addSql('ALTER TABLE station_equipment RENAME INDEX idx_c7d32db121bdb235 TO IDX_51BCBB9821BDB235');
        $this->addSql('ALTER TABLE station_equipment RENAME INDEX idx_c7d32db1517fe9fe TO IDX_51BCBB98517FE9FE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E00CEDDED17F50A6 ON booking');
        $this->addSql('ALTER TABLE booking CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX UNIQ_400A1E80D17F50A6 ON booking_equipment');
        $this->addSql('ALTER TABLE booking_equipment CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE booking_equipment RENAME INDEX idx_400a1e803301c60 TO IDX_D4AE03423301C60');
        $this->addSql('ALTER TABLE booking_equipment RENAME INDEX idx_400a1e80517fe9fe TO IDX_D4AE0342517FE9FE');
        $this->addSql('DROP INDEX UNIQ_6891BB7FD17F50A6 ON campervan');
        $this->addSql('ALTER TABLE campervan CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX UNIQ_D338D583D17F50A6 ON equipment');
        $this->addSql('ALTER TABLE equipment CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX UNIQ_9F39F8B1D17F50A6 ON station');
        $this->addSql('ALTER TABLE station CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('DROP INDEX UNIQ_51BCBB98D17F50A6 ON station_equipment');
        $this->addSql('ALTER TABLE station_equipment CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE station_equipment RENAME INDEX idx_51bcbb9821bdb235 TO IDX_C7D32DB121BDB235');
        $this->addSql('ALTER TABLE station_equipment RENAME INDEX idx_51bcbb98517fe9fe TO IDX_C7D32DB1517FE9FE');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527111324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE extra (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, extra_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, imagefile VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisation (id INT AUTO_INCREMENT NOT NULL, function_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_nr INT NOT NULL, INDEX IDX_E6E132B467048801 (function_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, type_id_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_729F519B714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_image (room_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_8F81A5F454177093 (room_id), INDEX IDX_8F81A5F43DA5256D (image_id), PRIMARY KEY(room_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, extra_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B467048801 FOREIGN KEY (function_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE room_image ADD CONSTRAINT FK_8F81A5F454177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_image ADD CONSTRAINT FK_8F81A5F43DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user ADD tel_nr INT DEFAULT NULL, ADD mobile_nr INT DEFAULT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD insertion_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) NOT NULL, ADD zip VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD last_activity DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room_image DROP FOREIGN KEY FK_8F81A5F43DA5256D');
        $this->addSql('ALTER TABLE room_image DROP FOREIGN KEY FK_8F81A5F454177093');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B714819A0');
        $this->addSql('DROP TABLE extra');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_image');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE fos_user DROP tel_nr, DROP mobile_nr, DROP first_name, DROP insertion_name, DROP last_name, DROP address, DROP zip, DROP city, DROP country, DROP last_activity');
    }
}

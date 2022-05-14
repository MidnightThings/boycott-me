<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509204314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, crdate DATETIME NOT NULL, tstamp DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, crdate DATETIME NOT NULL, tstamp DATETIME NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_goal (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, category_id INT NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', sort_order INT NOT NULL, deleted TINYINT(1) NOT NULL, INDEX IDX_865DA7E7A76ED395 (user_id), INDEX IDX_865DA7E712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_goal_day (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_goal_id INT NOT NULL, accomplished TINYINT(1) NOT NULL, INDEX IDX_349A0702A76ED395 (user_id), INDEX IDX_349A07023E7004F4 (user_goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_goal ADD CONSTRAINT FK_865DA7E7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_goal ADD CONSTRAINT FK_865DA7E712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_goal_day ADD CONSTRAINT FK_349A0702A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_goal_day ADD CONSTRAINT FK_349A07023E7004F4 FOREIGN KEY (user_goal_id) REFERENCES user_goal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_goal DROP FOREIGN KEY FK_865DA7E712469DE2');
        $this->addSql('ALTER TABLE user_goal DROP FOREIGN KEY FK_865DA7E7A76ED395');
        $this->addSql('ALTER TABLE user_goal_day DROP FOREIGN KEY FK_349A0702A76ED395');
        $this->addSql('ALTER TABLE user_goal_day DROP FOREIGN KEY FK_349A07023E7004F4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_goal');
        $this->addSql('DROP TABLE user_goal_day');
    }
}

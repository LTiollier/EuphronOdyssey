<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221016153354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, series INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_program (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_ED352B703EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_program_exercise (sub_program_id INT NOT NULL, exercise_id INT NOT NULL, INDEX IDX_8424AF00127394C7 (sub_program_id), INDEX IDX_8424AF00E934951A (exercise_id), PRIMARY KEY(sub_program_id, exercise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, sub_program_id INT NOT NULL, date DATETIME(6) NOT NULL, INDEX IDX_D5128A8FA76ED395 (user_id), INDEX IDX_D5128A8F127394C7 (sub_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_serie (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, exercise_id INT NOT NULL, serie INT NOT NULL, result INT DEFAULT NULL, INDEX IDX_45E01959BEFD98D1 (training_id), INDEX IDX_45E01959E934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME(6) NOT NULL, available_at DATETIME(6) NOT NULL, delivered_at DATETIME(6) DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sub_program ADD CONSTRAINT FK_ED352B703EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE sub_program_exercise ADD CONSTRAINT FK_8424AF00127394C7 FOREIGN KEY (sub_program_id) REFERENCES sub_program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sub_program_exercise ADD CONSTRAINT FK_8424AF00E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F127394C7 FOREIGN KEY (sub_program_id) REFERENCES sub_program (id)');
        $this->addSql('ALTER TABLE training_serie ADD CONSTRAINT FK_45E01959BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE training_serie ADD CONSTRAINT FK_45E01959E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sub_program DROP FOREIGN KEY FK_ED352B703EB8070A');
        $this->addSql('ALTER TABLE sub_program_exercise DROP FOREIGN KEY FK_8424AF00127394C7');
        $this->addSql('ALTER TABLE sub_program_exercise DROP FOREIGN KEY FK_8424AF00E934951A');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FA76ED395');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F127394C7');
        $this->addSql('ALTER TABLE training_serie DROP FOREIGN KEY FK_45E01959BEFD98D1');
        $this->addSql('ALTER TABLE training_serie DROP FOREIGN KEY FK_45E01959E934951A');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE sub_program');
        $this->addSql('DROP TABLE sub_program_exercise');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE training_serie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

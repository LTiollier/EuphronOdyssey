<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221016063454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE training_serie (training_id INT NOT NULL, exercise_id INT NOT NULL, INDEX IDX_45E01959BEFD98D1 (training_id), INDEX IDX_45E01959E934951A (exercise_id), PRIMARY KEY(training_id, exercise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training_serie ADD CONSTRAINT FK_45E01959BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE training_serie ADD CONSTRAINT FK_45E01959E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_serie DROP FOREIGN KEY FK_45E01959BEFD98D1');
        $this->addSql('ALTER TABLE training_serie DROP FOREIGN KEY FK_45E01959E934951A');
        $this->addSql('DROP TABLE training_serie');
    }
}

<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123211351 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cell (id INT AUTO_INCREMENT NOT NULL, prisoner_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE daily_worker_schedule (id INT AUTO_INCREMENT NOT NULL, worker_id INT NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departament (id INT AUTO_INCREMENT NOT NULL, departament_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE execution (id INT AUTO_INCREMENT NOT NULL, execution_date DATE NOT NULL, prisoner_id INT NOT NULL, worker_id INT NOT NULL, has_done TINYINT(1) NOT NULL, last_wish_order_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jail_jobs (id INT AUTO_INCREMENT NOT NULL, job_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jail_job_schedule (id INT AUTO_INCREMENT NOT NULL, prisoner_id INT NOT NULL, job_id INT NOT NULL, rate DOUBLE PRECISION NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE last_wish_order (id INT AUTO_INCREMENT NOT NULL, last_wish_staff_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE last_wish_staff (id INT AUTO_INCREMENT NOT NULL, last_wish_staff_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_order (id INT AUTO_INCREMENT NOT NULL, medical_product_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_products (id INT AUTO_INCREMENT NOT NULL, medical_product_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prisoner (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, join_date DATETIME NOT NULL, date_of_birdth DATETIME NOT NULL, cell_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sample_entity (id INT AUTO_INCREMENT NOT NULL, first_property INT NOT NULL, second_property VARCHAR(50) DEFAULT NULL, third_property DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_order (id INT AUTO_INCREMENT NOT NULL, social_product_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_product_lack (id INT AUTO_INCREMENT NOT NULL, social_product_id INT NOT NULL, number_of_lack INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_products (id INT AUTO_INCREMENT NOT NULL, social_product_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplies (id INT AUTO_INCREMENT NOT NULL, supply_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supply_order (id INT AUTO_INCREMENT NOT NULL, supply_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visits (id INT AUTO_INCREMENT NOT NULL, prisoner_id INT NOT NULL, visit_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, departament_id INT NOT NULL, salary INT NOT NULL, bonus INT NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cell');
        $this->addSql('DROP TABLE daily_worker_schedule');
        $this->addSql('DROP TABLE departament');
        $this->addSql('DROP TABLE execution');
        $this->addSql('DROP TABLE jail_jobs');
        $this->addSql('DROP TABLE jail_job_schedule');
        $this->addSql('DROP TABLE last_wish_order');
        $this->addSql('DROP TABLE last_wish_staff');
        $this->addSql('DROP TABLE medical_order');
        $this->addSql('DROP TABLE medical_products');
        $this->addSql('DROP TABLE prisoner');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE sample_entity');
        $this->addSql('DROP TABLE social_order');
        $this->addSql('DROP TABLE social_product_lack');
        $this->addSql('DROP TABLE social_products');
        $this->addSql('DROP TABLE supplies');
        $this->addSql('DROP TABLE supply_order');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visits');
        $this->addSql('DROP TABLE worker');
    }
}

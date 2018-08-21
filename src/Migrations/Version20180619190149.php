<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180619190149 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE products (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, prod_unit_id INT UNSIGNED DEFAULT NULL, time_unit_id INT UNSIGNED DEFAULT NULL, amount INT UNSIGNED NOT NULL DEFAULT \'0\', INDEX IDX_PRODUCTS_NAME (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_units (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, INDEX IDX_PRODUCT_UNITS_NAME (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time_units (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, INDEX IDX_TIME_UNITS_NAME (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_PRODUCTS_PROD_UNIT_ID FOREIGN KEY (prod_unit_id) REFERENCES product_units (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_PRODUCTS_TIME_UNIT_ID FOREIGN KEY (time_unit_id) REFERENCES time_units (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_PRODUCTS_PROD_UNIT_ID');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_PRODUCTS_TIME_UNIT_ID');

        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE production_units');
        $this->addSql('DROP TABLE time_units');
    }
}

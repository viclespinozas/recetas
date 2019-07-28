<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190728012955 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipes_ingredients (recipes_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_761206B0FDF2B1FA (recipes_id), INDEX IDX_761206B03EC4DCE (ingredients_id), PRIMARY KEY(recipes_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B0FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B03EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preparation_image CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE recipes_id recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredients CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE recipes CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE recipes_has_ingredients RENAME INDEX fk_recipes_has_ingredients_recipes1_idx TO IDX_A08D7529FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_has_ingredients RENAME INDEX fk_recipes_has_ingredients_ingredients1_idx TO IDX_A08D75293EC4DCE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipes_ingredients');
        $this->addSql('ALTER TABLE ingredients CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE preparation_image CHANGE id id INT NOT NULL, CHANGE recipes_id recipes_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipes CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE recipes_has_ingredients RENAME INDEX idx_a08d7529fdf2b1fa TO fk_recipes_has_ingredients_recipes1_idx');
        $this->addSql('ALTER TABLE recipes_has_ingredients RENAME INDEX idx_a08d75293ec4dce TO fk_recipes_has_ingredients_ingredients1_idx');
    }
}

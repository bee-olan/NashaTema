<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250312074527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE admin_pchelo_childs_seq CASCADE');
        $this->addSql('CREATE TABLE dre_ras_rod_lini_wet_nomw_noms (id UUID NOT NULL, mattrut_id UUID NOT NULL, zakazal_id UUID NOT NULL, nom VARCHAR(255) NOT NULL, god VARCHAR(255) NOT NULL, tit VARCHAR(255) NOT NULL, sort_nom INT NOT NULL, status VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_87A5F732B633F19F ON dre_ras_rod_lini_wet_nomw_noms (mattrut_id)');
        $this->addSql('CREATE INDEX IDX_87A5F732FA237BF ON dre_ras_rod_lini_wet_nomw_noms (zakazal_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_noms.id IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_nom_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_noms.mattrut_id IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_trut_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_noms.zakazal_id IS \'(DC2Type:admin_uchasties_uchastie_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_noms.status IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_nom_stat)\'');
        $this->addSql('CREATE TABLE dre_ras_rod_lini_wet_nomw_truts (id UUID NOT NULL, nomwet_id UUID NOT NULL, name_ot VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6095F12ABAA3F07 ON dre_ras_rod_lini_wet_nomw_truts (nomwet_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_truts.id IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_trut_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomw_truts.nomwet_id IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_id)\'');
        $this->addSql('CREATE TABLE dre_ras_rod_lini_wet_nomws (id UUID NOT NULL, wetka_id UUID NOT NULL, nom_w VARCHAR(255) NOT NULL, god_w VARCHAR(255) NOT NULL, tit_w VARCHAR(255) NOT NULL, sort_nom_wet INT NOT NULL, nom_mat VARCHAR(255) NOT NULL, god_mat VARCHAR(255) NOT NULL, tit_mat VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8DB290407EF2A16D ON dre_ras_rod_lini_wet_nomws (wetka_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomws.id IS \'(DC2Type:dre_ras_rod_lini_wet_nomw_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wet_nomws.wetka_id IS \'(DC2Type:dre_ras_rod_lini_wet_id)\'');
        $this->addSql('CREATE TABLE dre_ras_rod_lini_wets (id UUID NOT NULL, linia_id UUID NOT NULL, name_w VARCHAR(255) NOT NULL, sort_wetka INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A856164400E94F9 ON dre_ras_rod_lini_wets (linia_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wets.id IS \'(DC2Type:dre_ras_rod_lini_wet_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_lini_wets.linia_id IS \'(DC2Type:dre_ras_rod_lini_id)\'');
        $this->addSql('CREATE TABLE dre_ras_rod_linis (id UUID NOT NULL, stranmat_id UUID NOT NULL, name VARCHAR(255) NOT NULL, sort_lini INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A74B2C8D871DB5A2 ON dre_ras_rod_linis (stranmat_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_linis.id IS \'(DC2Type:dre_ras_rod_lini_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_linis.stranmat_id IS \'(DC2Type:dre_ras_rod_stranmat_id)\'');
        $this->addSql('CREATE TABLE dre_ras_rod_stranmats (id UUID NOT NULL, rodo_id UUID NOT NULL, strana_id UUID NOT NULL, name_s VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_168332F889CE8909 ON dre_ras_rod_stranmats (rodo_id)');
        $this->addSql('CREATE INDEX IDX_168332F883FA2C41 ON dre_ras_rod_stranmats (strana_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_stranmats.id IS \'(DC2Type:dre_ras_rod_stranmat_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rod_stranmats.rodo_id IS \'(DC2Type:dre_ras_rod_id)\'');
        $this->addSql('CREATE TABLE dre_ras_rods (id UUID NOT NULL, rasa_id UUID NOT NULL, name_matkov VARCHAR(255) NOT NULL, kod_matkov VARCHAR(255) NOT NULL, sort_rodo INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D28BA75F81DBD4D8 ON dre_ras_rods (rasa_id)');
        $this->addSql('COMMENT ON COLUMN dre_ras_rods.id IS \'(DC2Type:dre_ras_rod_id)\'');
        $this->addSql('COMMENT ON COLUMN dre_ras_rods.rasa_id IS \'(DC2Type:dre_ras_id)\'');
        $this->addSql('CREATE TABLE dre_strans (id UUID NOT NULL, name VARCHAR(255) NOT NULL, nomer INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomw_noms ADD CONSTRAINT FK_87A5F732B633F19F FOREIGN KEY (mattrut_id) REFERENCES dre_ras_rod_lini_wet_nomw_truts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomw_noms ADD CONSTRAINT FK_87A5F732FA237BF FOREIGN KEY (zakazal_id) REFERENCES admin_uchasties_uchasties (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomw_truts ADD CONSTRAINT FK_6095F12ABAA3F07 FOREIGN KEY (nomwet_id) REFERENCES dre_ras_rod_lini_wet_nomws (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomws ADD CONSTRAINT FK_8DB290407EF2A16D FOREIGN KEY (wetka_id) REFERENCES dre_ras_rod_lini_wets (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wets ADD CONSTRAINT FK_6A856164400E94F9 FOREIGN KEY (linia_id) REFERENCES dre_ras_rod_linis (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_linis ADD CONSTRAINT FK_A74B2C8D871DB5A2 FOREIGN KEY (stranmat_id) REFERENCES dre_ras_rod_stranmats (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_stranmats ADD CONSTRAINT FK_168332F889CE8909 FOREIGN KEY (rodo_id) REFERENCES dre_ras_rods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rod_stranmats ADD CONSTRAINT FK_168332F883FA2C41 FOREIGN KEY (strana_id) REFERENCES dre_strans (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dre_ras_rods ADD CONSTRAINT FK_D28BA75F81DBD4D8 FOREIGN KEY (rasa_id) REFERENCES dre_rass (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER childpchelo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_parent_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_files ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_files ALTER childpchelo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER parent_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_executors ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_executors ALTER childpchelo_id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomw_noms DROP CONSTRAINT FK_87A5F732B633F19F');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomw_truts DROP CONSTRAINT FK_6095F12ABAA3F07');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wet_nomws DROP CONSTRAINT FK_8DB290407EF2A16D');
        $this->addSql('ALTER TABLE dre_ras_rod_lini_wets DROP CONSTRAINT FK_6A856164400E94F9');
        $this->addSql('ALTER TABLE dre_ras_rod_linis DROP CONSTRAINT FK_A74B2C8D871DB5A2');
        $this->addSql('ALTER TABLE dre_ras_rod_stranmats DROP CONSTRAINT FK_168332F889CE8909');
        $this->addSql('ALTER TABLE dre_ras_rod_stranmats DROP CONSTRAINT FK_168332F883FA2C41');
        $this->addSql('CREATE SEQUENCE admin_pchelo_childs_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE dre_ras_rod_lini_wet_nomw_noms');
        $this->addSql('DROP TABLE dre_ras_rod_lini_wet_nomw_truts');
        $this->addSql('DROP TABLE dre_ras_rod_lini_wet_nomws');
        $this->addSql('DROP TABLE dre_ras_rod_lini_wets');
        $this->addSql('DROP TABLE dre_ras_rod_linis');
        $this->addSql('DROP TABLE dre_ras_rod_stranmats');
        $this->addSql('DROP TABLE dre_ras_rods');
        $this->addSql('DROP TABLE dre_strans');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER parent_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE admin_pchelo_childs ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_executors ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_executors ALTER childpchelo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_files ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_files ALTER childpchelo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER childpchelo_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER childpchelo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_parent_id TYPE INT');
        $this->addSql('ALTER TABLE admin_pchelo_child_changes ALTER set_parent_id DROP DEFAULT');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m240105_153622_identities
 */
class m240105_153622_identities extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%person_identifier_type}}', [
            'id' => $this->primaryKey(),
            'country' => $this->string(2)->notNull(),
            'country_name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%industry}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%identity_type}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%identity_data}}', [
            'id' => $this->primaryKey(),
            'identity_type_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'person_identifier_type_id' => $this->integer(),
            'person_identifier' => $this->string(),
            'phone' => $this->string(20),
            'email' => $this->string(),
            'additional_info' => $this->string(),
            'registration_number' => $this->string(30),
            'vat_number' => $this->string(30),
            'vat_rate' => $this->decimal(5, 2),
            'contact_person' => $this->string(50),
            'industry_id' => $this->integer(),
            'registration_date' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_identity_data_identity_type',
            '{{%identity_data}}',
            'identity_type_id',
            '{{%identity_type}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_identity_data_person_identifier_type',
            '{{%identity_data}}',
            'person_identifier_type_id',
            '{{%person_identifier_type}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_identity_data_industry',
            '{{%identity_data}}',
            'industry_id',
            '{{%industry}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{%identity}}', [
            'id' => $this->primaryKey(),
            'address_id' => $this->integer()->notNull(),
            'identity_data_id' => $this->integer()->notNull(),
        ]);


        $this->addForeignKey(
            'fk_identity_address',
            '{{%identity}}',
            'address_id',
            '{{%address}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_identity_identity_data',
            '{{%identity}}',
            'identity_data_id',
            '{{%identity_data}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // Drop all tables
        $this->dropForeignKey('fk_identity_data_person_identifier_type', '{{%identity_data}}');
        $this->dropForeignKey('fk_identity_data_industry', '{{%identity_data}}');
        $this->dropTable('{{%identity_data}}');

        $this->dropForeignKey('fk_identity_identity_type', '{{%identity}}');
        $this->dropForeignKey('fk_identity_address', '{{%identity}}');
        $this->dropForeignKey('fk_identity_identity_data', '{{%identity}}');
        $this->dropTable('{{%identity}}');

        $this->dropTable('{{%person_identifier_type}}');
        $this->dropTable('{{%industry}}');
        $this->dropTable('{{%identity_type}}');
    }
}
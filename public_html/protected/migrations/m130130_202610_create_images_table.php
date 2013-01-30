<?php

class m130130_202610_create_images_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('images', array(
            'id' => 'pk',
            'title' => 'string',
            'url' => 'string',
        ));
	}

	public function down()
	{
        $this->dropTable('images');
	}
}
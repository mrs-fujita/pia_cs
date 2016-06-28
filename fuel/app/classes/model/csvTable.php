<?php

class Model_CsvTable extends Model_Crud
{

	protected static $_table_name = "csv_table";

	public static function save_csv_table_from_file_name($file_name, $admin_id)
	{
		$ob = Model_CsvTable::forge()->set(array(
			"admin_id"  => $admin_id,
			"file_name" => $file_name,
			"add_time"  => date('Y-m-d H-i-s'),
		));

		if($ob->save()) return true;
		else return false;
	}
}

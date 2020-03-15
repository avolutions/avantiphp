<?php
	use core\database\Table;
	use core\database\Column;
	use core\database\ColumnType;
	
	class CreateMigrationTable {
		public $version = "1";
		
		public function migrate() {
			$columns = array();
			$columns[] = new Column("MigrationID", ColumnType::INT, 255, null, null, true, true);
			$columns[] = new Column("Version", ColumnType::VARCHAR, 255);
			$columns[] = new Column("Name", ColumnType::VARCHAR, 255);
			$columns[] = new Column("CreateDate", ColumnType::DATETIME, NULL, Column::CURRENT_TIMESTAMP);		
			Table::create("migration", $columns);
		}
	}
?>
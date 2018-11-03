<?php
/*	TNB-PHP
	@author - Tran Nhat Bao
	@All rights reserved
	Support by	:	_
	Edited by	:	_
*/
//	Public function
class	lg_mysql
{
	var		$conn;
	var		$db_name;
	var		$count_query	=	0;
//	init
	public	function	__construct( $host , $db_user , $db_pass , $db_name)
	{
		$this->$db_name	=	$db_name;
	
		$this->conn	=	mysqli_connect($host , $db_user, $db_pass, $db_name)		or die("Can't connect");
		//mysqli_set_charset($this->conn, "utf8");
	}
	public	function	__destruct()
	{
		@mysqli_close( $this->conn );
	}
//	select - insert - update - delete
	public	function	query ( $query )
	{
		return	@mysqli_query($this->conn , $query);
	}
	public	function	charset ()
	{
		@mysqli_set_charset($this->conn, "utf8");
	}
	public	function	select ( $table , $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
	public	function	selectother ($filed="*", $table , $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT ".$filed." FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
    public	function	selectjoin ( $table,$table2 ,$on, $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM ".$table." INNER JOIN ".$table2." ON ".$on;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
    public	function	selectmedia ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM media_file INNER JOIN media_relationship ON media_file.id = media_relationship.media_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	mysqli_query($this->conn , $sql);
	}
    public	function	selectpost ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM post INNER JOIN post_lang ON post.id = post_lang.post_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
    public	function	get_post_field ($field="*", $where = "" , $clause = "" )
	{
		$this->count_query++;
        if(trim($field)){
            $sql .=	"SELECT $field FROM post INNER JOIN post_lang ON post.id = post_lang.post_id";
        }
		if (trim($where) != ""){
			$sql .= " WHERE ".$where;
        }
		if (trim($clause) != ""){
			$sql .= " ".$clause;
        }
		return	mysqli_query($this->conn , $sql);
	}
    public	function	selectpage ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM vn_page INNER JOIN vn_page_lang ON vn_page.id = vn_page_lang.page_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
	public	function	selectpostcat ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM postcat INNER JOIN postcat_lang ON postcat.id = postcat_lang.postcat_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
	public	function	selectgallery ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM vn_gallery INNER JOIN vn_gallery_lang ON vn_gallery.id = vn_gallery_lang.gallery_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
	public	function	selectgalmenu ( $where = "" , $clause = "" )
	{
		$this->count_query++;
		$sql	=	"SELECT * FROM vn_gallery_menu INNER JOIN  vn_gallery_menu_lang ON vn_gallery_menu.id = vn_gallery_menu_lang.gallery_menu_id";
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		if (trim($clause) != "")
			$sql .= " ".$clause;
		return	@mysqli_query($this->conn , $sql);
	}
	public	function	insert	( $table , $feild , $values )
	{
		$this->count_query++;
		$sql	=	"INSERT INTO ".$table;
		if	( trim($feild) != "" )
			$sql	.=	" (".$feild.")";
		$sql	.=	" VALUES (".$values.");";
		@mysqli_query($this->conn , $sql);
		return	mysqli_insert_id($this->conn);
	}
	public	function	update	( $table , $feild , $value , $where )
	{
		$this->count_query++;
		$sql	=	"UPDATE $table SET $feild = '".$this->inj_str($value)."'";
		if	( trim($where) != "" )
			$sql	.=	" WHERE ".$where;
		return @mysqli_query($this->conn , $sql);
	}
	public	function	delete	( $table , $where = "" )
	{
		$this->count_query++;
		$sql	=	"DELETE FROM ".$table;
		if (trim($where) != "")
			$sql .= " WHERE ".$where;
		@mysqli_query($this->conn , $sql);
		$this->optimize($table);
	}
//	optimize
	public	function	optimize ( $table_name )
	{
		return	@mysqli_query($this->conn , "OPTIMIZE $table_name");
	}
//	fetch
	public	function	fetch_row ( $rs )
	{
		return	@mysqli_fetch_row( $rs );
	}
	public	function	fetch ( $rs )
	{
		return  @mysqli_fetch_array( $rs );
	}
//	Trả về - số records - của - 1 Result Set
	public	function	num_rows ( $rs )
	{
		return	mysqli_num_rows( $rs );
	}
//	Hàm này - dùng để - chuyển - các ký tự - đặc biệt - sang - thể Escape - chống - Hack - SQL Injection
	public	function	inj_str	( $txt )
	{
		return mysqli_real_escape_string($this->conn , $txt);
	}
	public	function	escape ( $txt )
	{
		return mysqli_real_escape_string($this->conn , $txt);
	}
	public	function	error()
	{
		return mysqli_error($this->conn);
	}
/* -----------------------------------------
        Các hàm áp dụng với 1 Tables        
----------------------------------------- */
	public	function	show_tables ()
	{
		return	mysqli_query($this->conn , "SHOW TABLES");
	}
	public	function	show_create_table ( $table_name )
	{
		return	mysqli_query($this->conn , "SHOW CREATE TABLE ".$table_name);
	}
	public	function	show_creation_table ( $table_name )
	{
		$row	=	mysqli_fetch_array($this->show_create_table($table_name));
		return	$row["Create Table"];
	}
}
?>
<?php
require "vendor/autoload.php";
class sql
{
	function __construct($tableName, $asdf="")
	{
		$core = new core();
		$this->table = $tableName;
		$this->con = $core->dbConnect();
	}
	function select($col = "", $where = "", $vars = "", $options = "")
	{
		if(empty($col)){ $col = "*"; }
		else{ $col = explode(" ",$col);$col = implode(", ", $col); }
		if(!empty($where))
		{
			if(empty($vars) && $vars != 0){ return false; }
			$where = explode(" ", $where);
			$vars = explode(" ", $vars);
			if(count($where) != count($vars)){ return false; }
			$where = implode(" = ? AND ", $where);
			$where .= " = ?";
			$sqlString = "SELECT $col FROM $this->table WHERE $where $options";
			$this->query = $this->con->prepare($sqlString);
			$this->query->execute($vars);
		}
		else
		{
			$sqlString = "SELECT $col FROM $this->table $options";
			$this->query = $this->con->query($sqlString);
		}
		
		$fetch = $this->query->fetchAll(PDO::FETCH_ASSOC);
		return $fetch;
	}
	function insert($col, $vars, $options = "")
	{
		if(empty($col)){ return false; }
		$col = explode(" ",$col); 
		$vars = explode(" ", $vars);
		if(count($col) != count($vars)){ return false; }
		$col = implode(", ",$col);
		$where .= " = ?";
		$fill = array_fill(0,count($vars),"?");
		for($i = 0; $i < count($vars); $i++)
		{
			if(strpos($vars[$i],"()") !== false)
			{
				$fill[$i] = $vars[$i];
				unset($vars[$i]);	
			}
		}
		$vars = array_values($vars);
		$fill = implode(", ",$fill);
		$sqlString = "INSERT INTO $this->table ($col) VALUES ($fill)";
		$this->query = $this->con->prepare($sqlString);
		$this->query->execute($vars);
	}
	function delete()
	{
		//1. Add stuff for delete. 2. Profit?
	}
	function update($col, $where = "", $vars = "", $options = "")
	{
		if(empty($col)){ return false; }
		$col = explode(" ",$col); 
		if(!empty($where))
		{
			if(empty($vars)){ return false; }
			$where = explode(" ", $where);
			$vars = explode(" ", $vars);
			if((count($where)+count($col)) != count($vars)){ return false; }
			$col = implode(" = ?, ", $col);
			$col .= " = ?";
			$where = implode(" = ? AND ", $where);
			$where .= " = ?";
			$sqlString = "UPDATE $this->table SET $col WHERE $where";
		}
		else
		{
			return false;
		}
		$this->query = $this->con->prepare($sqlString);
		$this->query->execute($vars);
	}
}
?>
<?php

	// Baris dibawah mungkin menyebabkan bug pada beberapa server, 
	// Ubah jadi include("config/database.php"); jika menggunakan server apache2
	// include("../config/database.php");
		
	// database() berfungsi untuk membuat koneksi ke database
	// Beberapa variabel seperti HOSTNAME, USERNAME, PASSWORD, DATABASE dapat
	// dilihat pada config/database.php
	function database()
	{
		$db = new mysqli (HOSTNAME, USERNAME, PASSWORD, DATABASE) or die (mysqli_errno ());
		return $db;
	}

	// all() memberikan seluruh nilai dari tabel yang dipilih
	// Query: "SELECT * FROM table_name"
	// Keyword: Tampil semua data
	function all($table) 
	{
		$sql = "SELECT * FROM $table";
		$result = database()->query ($sql);
		return result_builder($result);
	}

	// find() memberikan nilai berdasarkan rules yang diberikan
	// Query: SELECT * FROM table_name WHERE a1 = x1 AND a2 = x2 AND ...
	// Keyword: Cari data
	function find($table, $rules)
	{
		$sql = "SELECT * FROM $table WHERE " . where_builder($rules);
		$result = database()->query ($sql);
		return result_builder($result);
	}

	// delete() berfungsi untuk menghapus data dari tabel
	// Query: DELETE FROM table_name WHERE a1 = x1 AND a2 = x2 AND ...
	// Keyword: Hapus data
	function delete($table, $rules)
	{
		$sql = "DELETE FROM $table WHERE " . where_builder($rules);
		$conn = database();
		$result = $conn->query($sql);
		return $conn->affected_rows;
	}

	// update() berfungsi untuk mengubah data dari tabel
	// Query: UPDATE table_name SET b1 = y1, b2 = y2, ... WHERE a1 = x1 AND a2 = x2 AND ...
	// Keyword: Hapus data
	function update($table, $data, $rules)
	{
		$sql = "UPDATE $table SET " . data_builder($data) . " WHERE " . where_builder($rules);
		$conn = database();
		$result = $conn->query($sql);
		return $conn->affected_rows;
	}

	// insert() berfungsi untuk menambah data ke tabel
	// Query: INSERT INTO table_name (a1, a2, a3, ...) VALUES (x1, x2, x3, ...)
	// Keyword: Tambah data
	function insert($table, $data)
	{
		$sql = "INSERT INTO $table" . insert_builder($data);
		$conn = database();
		$result = $conn->query($sql);
		return $conn->affected_rows;
	}

	// insert_id() berfungsi untuk menambah data ke tabel dengan return id
	// Query: INSERT INTO table_name (a1, a2, a3, ...) VALUES (x1, x2, x3, ...)
	// Keyword: Tambah data
	function insert_id($table, $data)
	{
		$sql = "INSERT INTO $table" . insert_builder($data);
		$conn = database();
		$result = $conn->query($sql);
		return $conn->insert_id;
	}

	// raw() berfungsi untuk eksekusi query yang memberikan data
	// Query: custom
	// Keyword: Kostum query dengan return data
	function raw($sql)
	{
		$result = database()->query($sql);
		return result_builder($result);
	}

	// execute() berfungsi untuk eksekusi query yang memberikan data
	// Query: custom
	// Keyword: Kostum query dengan return status
	function execute($sql)
	{
		$conn = database();
		$result = $conn->query($sql);
		return $conn->affected_rows;
	}


	// Builder
	// Builder untuk where
	function where_builder($rules)
	{
		$sql = "";
		$rules_length = 0;
		foreach ($rules as $key => $value) 
		{
			$rules_length++;
			$sql .= " `$key` = '$value'";
			$sql .= (count($rules) > $rules_length) ? " AND" : "";
		}
		return $sql;
	}

	// Builder untuk data yang akan diubah
	function data_builder($data)
	{
		$sql = "";
		$data_length = 0;
		foreach ($data as $key => $value) 
		{
			$data_length++;
			$sql .= " `$key` = '$value'";
			$sql .= (count($data) > $data_length) ? ", " : "";
		}
		return $sql;
	}

	// Builder untuk data yang dihasilkan
	function result_builder($result)
	{
		$response = array();
		while ($row = $result->fetch_assoc()) 
		{
			$response[] = $row; 
		}
		return $response;
	}

	// Builder untuk menambahkan data
	function insert_builder($data)
	{
		$sql = "";
		$data_length = 0;
		$sql .= "(";
		foreach ($data as $key => $value) 
		{
			$data_length++;
			$sql .= " `$key`";
			$sql .= (count($data) > $data_length) ? ", " : "";
		}
		$sql .= ")VALUES(";
		$data_length = 0;
		foreach ($data as $key => $value) 
		{
			$data_length++;
			$sql .= " '$value'";
			$sql .= (count($data) > $data_length) ? ", " : "";
		}
		$sql .= ")";
		return $sql;
	}

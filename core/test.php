<?php 
    include("Database.php");

    $array = [
        "Persons" => [
            "PersonID" => "int",
            "FirstName" => "varchar(255)",
            "LastName" => "varchar(255)",
        ]
    ];

    $db = new Database();
    // $db->select('users', ['first_name', 'last_name', 'id', 'username'], "1");
    // $db->insert('users', ['id', 'first_name', 'last_name', 'username', 'email', 'password', 'password_repeat'], ['15', 'bradley', 'newlon', 'newlon_bradley', 'newlon@bradley.com', 'password1', 'password1']);
    // $db->update('users', ['password', 'password_repeat'], ['password2', 'password2'], "`id` = 15");
    // $db->delete('users', "`id` = 15");
    // $db->createTable($array);
    // $db->dropTable("Persons");

?>
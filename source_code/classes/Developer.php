<?php

class Developer extends DB
{
    function getDeveloper()
    {
        $query = "SELECT * FROM developer";
        return $this->execute($query);
    }

    function getDeveloperById($id)
    {
        $query = "SELECT * FROM developer WHERE developer_id=$id";
        return $this->execute($query);
    }

    function addDeveloper($data)
    {
        $nama = $data['nama'];
        $query = "INSERT INTO developer VALUES('', '$nama')";
        return $this->executeAffected($query);
    }

    function updateDeveloper($id, $data)
    {
        // ...
    }

    function deleteDeveloper($id)
    {
        // ...
    }
}

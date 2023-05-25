<?php

class Publisher extends DB
{
    function getPublisher()
    {
        $query = "SELECT * FROM publisher";
        return $this->execute($query);
    }

    function getPublisherById($id)
    {
        $query = "SELECT * FROM publisher WHERE publisher_id=$id";
        return $this->execute($query);
    }

    function addPublisher($data)
    {
        // ...
    }

    function updatePublisher($id, $data)
    {
        // ...
    }

    function deletePublisher($id)
    {
        // ...
    }
}

<?php

class Game extends DB
{
    function getGameJoin($order = 'game.game_id')
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN publisher ON game.publisher_id=publisher.publisher_id ORDER BY $order";

        return $this->execute($query);
    }

    function getGame()
    {
        $query = "SELECT * FROM game";
        return $this->execute($query);
    }

    function getGameById($id)
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN publisher ON game.publisher_id=publisher.publisher_id WHERE game_id=$id";
        return $this->execute($query);
    }

    function searchgame($keyword, $order = 'game.game_id')
    {
        $query = "SELECT * FROM game JOIN developer ON game.developer_id=developer.developer_id JOIN publisher ON game.publisher_id=publisher.publisher_id WHERE game.game_nama LIKE '%$keyword%' ORDER BY $order";

        return $this->execute($query);
    }

    function addData($foto, $nama, $genre, $platform, $developer, $publisher)
    {
        $query = "INSERT INTO game VALUES('', '$foto', '$nama', '$genre', '$platform', '$developer', '$publisher')";
        return $this->executeAffected($query);
    }

    function updateData($id, $foto, $nama, $genre, $platform, $developer, $publisher)
    {
        $query = "UPDATE game SET game_foto='$foto', game_nama='$nama', game_genre='$genre', game_platform='$platform', developer_id='$developer', game_publisher='$publisher' WHERE game_id='$id'";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM game WHERE game_id='$id'";
        return $this->executeAffected($query);
    }
}

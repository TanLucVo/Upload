
<?php
    function login($username, $password, $conn) {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? and pass = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return  $row;
            }
        } else {
            return null;
        }
    }
    function addFile($link, $user,$conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO `file`(`link`, `user`) VALUES (?,?)");
        $stmt->bind_param('ss', $link, $user);
        $stmt->execute();

    }
    function delFile($link, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("DELETE FROM `file` WHERE link = ?");
        $stmt->bind_param('s', $link);
        $stmt->execute();
    }
    function idByLink($link, $conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT id FROM `file` WHERE link = ?");
        $stmt->bind_param('s', $link);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return  $row['id'];
            }
        } else {
            return null;
        }

    }
    function renameFile($link, $id, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE `file` SET `link`= ? WHERE id = ?");
        $stmt->bind_param('si', $link, $id);
        $stmt->execute();
    }

?>
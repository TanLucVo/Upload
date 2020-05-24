
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
    function deleteDir($path, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("DELETE FROM `file` WHERE link LIKE '?/%'");
        $stmt->bind_param('s', $path);
        $stmt->execute();
        exit();

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
    function register($username,$password,$name,$email, $conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO user(username,pass,name,email) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss', $username, $password, $name, $email);
        $stmt->execute();
    }
    function checkUser($username, $conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? ");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }
    function shareFile($path, $conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE `file` SET `public`=1 WHERE link = ?");
        

        
        $stmt->bind_param('s', $path);
        $stmt->execute();
    }

    function GetShareLinkByUser($user, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT link FROM `file` WHERE user = ? AND public = 1");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
        
    function addFileIntoTrash($link, $user, $conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO `trash`(`link`, `user`) VALUES (?,?)");
        $stmt->bind_param('ss', $link, $user);
        $stmt->execute();
    }
    function delFileIntoTrash($link, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("DELETE FROM `trash` WHERE link = ?");
        $stmt->bind_param('s', $link);
        $stmt->execute();
    }
    function getLimit($conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT * FROM `limitupload`");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return  array($row['data'], $row['numfile'], $row['filedata'], $row['typeNotAceppt']);
            }
        } else {
            return null;
        }
    }
    function addSettings($data, $numfile, $filedata, $typeNotAceppt, $conn)
    {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE `limitupload` SET `data`= ?,`numfile`=?,`filedata`=?,`typeNotAceppt`=? WHERE 1");
        $stmt->bind_param('iiis', $data, $numfile, $filedata, $typeNotAceppt);
        $stmt->execute();
    }
?>
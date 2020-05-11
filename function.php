
<?php
    function login($username, $password, $conn) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? and pass = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return  $row['name'];
            }
        } else {
            return null;
        }
    }
?>
<?php

    class Account {
        public $username;
        public $password;
        public $email;
        public $fullname;
        public $phone;
        public $type;

        /**
         * Account constructor.
         * @param $username
         * @param $password
         * @param $email
         * @param $fullname
         * @param $phone
         * @param $type
         */
        public function __construct($username, $password, $email, $fullname, $phone, $type)
        {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->fullname = $fullname;
            $this->phone = $phone;
            $this->type = $type;
        }

        public static function login($id, $password) {
            $sql = "select * from taikhoan where username = :user or email = :email";

            $db = DB::getDB();
            $stm = $db->prepare($sql);
            $stm->execute(array('user' => $id, 'email' => $id));
            $i = $stm->fetch(PDO::FETCH_ASSOC);
            if ($i) {
                $hashed = $i['password'];
                if (password_verify($password, $hashed)) {
                    return new Account($i['username'], $i['password'],
                        $i['email'], $i['fullname'],
                        $i['phoneNumber'],$i['MaLoai']);
                }
                else {
                    return null;
                }
            }
            else {
                return null;
            }
        }

    }

?>
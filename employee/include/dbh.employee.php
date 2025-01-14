<?php
session_start();
class dbHandler
{

    public $conn;

    function __construct()
    {

        $dbservername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "aevgbuildersdb";
        $this->conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function checkIfEmployeeEmailExist($email)
    {
        $sql = "SELECT id FROM employee WHERE email='$email'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function checkIfEmployeeUsernameExist($username)
    {
        $sql = "SELECT id FROM employee WHERE username='$username'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function checkIfEmployeeAccExist($key)
    {
        if ($this->checkIfEmployeeEmailExist($key) || $this->checkIfEmployeeUsernameExist($key)) {
            return true;
        } else {
            return false;
        }
    }

    function checkAccount($key, $password, $col)
    {
        $query = "SELECT * FROM $col WHERE (email = '$key' OR username = '$key')  AND  password ='$password'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                if ($row["status"] == "active") {
                    if ($this->updateAttempt($key, 3)) {
                        $_SESSION['id'] = $row["id"];
                        $_SESSION['email'] = $row["email"];
                        return true;
                    }
                }
            }
        } else {
            $total_count = $this->getAttempt($key, 'employee') - 1;
            $this->updateAttempt($key, $total_count);
            // echo "Email and Password not match. Remaining attempts: " . $total_count;
            return false;
        }
    }

    function getAttempt($key, $col)
    {
        $query = "SELECT attempt FROM $col WHERE email = '$key' OR username = '$key'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row['attempt'];
        } else {
            return 0;
        }
    }

    function updateAttempt($key, $attempt)
    {
        $query = "UPDATE employee SET attempt=$attempt WHERE email='$key' OR username='$key'";
        return mysqli_query($this->conn, $query);
    }

    function getFullname($id)
    {
        $sql = "SELECT CONCAT(firstName, ' ', lastName) AS fullName FROM employee WHERE id='$id'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row['fullName'];
        } else {
            return '';
        }
    }

    function updateProject($value)
    {
        $query = "UPDATE `projects` SET title='$value->title', category='$value->category', 
        image='$value->image',  description='$value->description' WHERE id='$value->id'";
        return mysqli_query($this->conn, $query);
    }

    function uploadProject($info)
    {
        $query = "INSERT INTO projects(title, image, category, description) 
        VALUES ('$info->title' ,'$info->image', '$info->category', '$info->description')";
        return mysqli_query($this->conn, $query);
    }

    function profileUpdate($value, $id)
    {
        $sql = "UPDATE `employee` SET firstName='$value->firstName', middleName='$value->middleName', lastName='$value->lastName', username='$value->username', email='$value->email',
         contactNo='$value->contactNo', houseNo='$value->houseNo', street='$value->street', barangay='$value->barangay', municipality='$value->municipality', 
         province='$value->province', profile_picture='$value->image' WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    function getSpecificInfo($id, $col)
    {
        $sql = "SELECT $col FROM employee WHERE id='$id'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row[$col];
        } else {
            return 0;
        }
    }

    function checkIfSomeAlrExist($key, $table, $col)
    {
        $sql = "SELECT id FROM $table WHERE $col='$key'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function deleteProject($id)
    {
        $sql = "DELETE FROM `projects` WHERE `id`=$id";
        return mysqli_query($this->conn, $sql);
    }


    function getAllProjects()
    {
        $query = "SELECT * FROM projects";
        $result = mysqli_query($this->conn, $query);
        $projects = array();
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = (object)[
                    "id" => $row["id"],
                    "title" => $row["title"],
                    "description" => $row["description"],
                    "category" => $row["category"],
                    "image" => explode(",", $row["image"]),
                ];
            }
        }
        return $projects;
    }



    function getValueByID($value, $id)
    {
        $sql = "SELECT `$value` FROM projects WHERE `id`=$id";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row[$value];
            }
        }
    }

    function getValueByProfileID($value, $id, $table = "employee")
    {
        $sql = "SELECT `$value` FROM $table WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row[$value];
                // return $sql;
            }
        }
    }

    //client getting info mysql

    function getApprovedClientData($id)
    {
        $sql = "SELECT *, CONCAT(lastName,', ', firstName) AS fullName,
        CONCAT(house_no, ' ', street, ' ', barangay, ' ', municipality, ' ', province) AS address
        FROM client INNER JOIN employee_client ON client.id=employee_client.client_id WHERE employee_client.employee_id = $id";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $user = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $user[] = (object) [
                    "id" => $row['id'],
                    "fullName" => $row['fullName'],
                    "email" => $row['email'],
                    "contact" => $row['contact_no'],
                    "address" => $row['address'],

                ];
            }
            return $user;
        }
    }

    function getAllUserClientData()
    {
        $sql = "SELECT *, CONCAT(lastName,', ', firstName) AS fullName,
        CONCAT(house_no, ' ', street, ' ', barangay, ' ', municipality, ' ', province) AS address
        FROM client WHERE NOT EXISTS (SELECT * FROM  employee_client WHERE employee_client.client_id = client.id)";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $user = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $user[] = (object) [
                    "id" => $row['id'],
                    "fullName" => $row['fullName'],
                    "email" => $row['email'],
                    "contact" => $row['contact_no'],
                    "address" => $row['address'],

                ];
            }
            return $user;
        }
    }


    function getAllUserData()
    {
        $sql = "SELECT *, CONCAT(lastName,', ', firstName) AS fullName,
        CONCAT(houseNo, ' ', street, ' ', barangay, ' ', municipality, ' ', province)
        FROM employee WHERE status='active' ORDER BY id DESC";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result)) {
            $user = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $user[] = (object) [
                    "id" => $row['id'],
                    "username" => $row['username'],
                    "fullName" => $row['fullName'],
                    "email" => $row['email'],
                    "contact" => $row['contactNo'],
                    "houseNo" => $row['houseNo'],
                    "street" => $row['street'],
                    "barangay" => $row['barangay'],
                    "municipality" => $row['municipality'],
                    "province" => $row['province'],
                    "profile_picture" => $row['profile_picture'],

                ];
            }
            return $user;
        }
    }

    function getAllClientInfoByID($id)
    {
        $query = "SELECT *, CONCAT(lastname, ', ', firstname) AS fullname, 
        CONCAT(house_no, ' ', street, ' ', barangay, ' ', municipality, ' ', province) AS address
        FROM client WHERE id=$id";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                $empName = "";

                $sql = "SELECT CONCAT(employee.lastName, ', ' , employee.firstName) as fullname FROM employee_client INNER JOIN employee ON employee.id = employee_client.employee_id WHERE employee_client.client_id = $id";
                $res = mysqli_query($this->conn, $sql);
                if (mysqli_num_rows($result)) {
                    if ($row2 = mysqli_fetch_assoc($res)) {
                        $empName = $row2['fullname'];
                    }
                }
                return (object)[
                    'id' => $row['id'],
                    'fullname' => $row['fullname'],
                    'contactNo' => $row['contact_no'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'address' => $row['address'],
                    'employeeName' => $empName
                ];
            }
        }
    }

    function assignEmployee($employeeID, $clientID)
    {
        $query = "INSERT INTO `employee_client`(`employee_id`, `client_id`, `status`) VALUES ('$employeeID','$clientID','ongoing')";
        return mysqli_query($this->conn, $query);
    }

    function isClientUserAccountExist($id, $username, $email)
    {
        $sql = "SELECT id FROM client WHERE (username='$username' OR email='$email') AND id!='$id'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }

    function updateUserInfo($value, $id)
    {
        $sql = "UPDATE `employee` SET username='$value->username', firstName='$value->firstName', middleName='$value->middleName',
             lastName='$value->lastName', email='$value->email', contact='$value->contact' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }
}

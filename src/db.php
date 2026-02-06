<?php
class db{
    var $con;

    function __construct()
    {
        try{
            $this->con = new PDO('mysql:host=localhost;dbname=UserData','root','Root@123');
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // Insert
    function insert($img,$name,$email,$mobile,$gender,$dob,$address,$status)
    {
        $qry = "INSERT INTO users(profile_img,name,email,mobile,gender,date_of_birth,address,status)
                VALUES(:img,:name,:email,:mobile,:gender,:dob,:address,:status)";
        $stmt = $this->con->prepare($qry);

        $stmt->bindParam(':img',$img);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':mobile',$mobile);
        $stmt->bindParam(':gender',$gender);
        $stmt->bindParam(':dob',$dob);
        $stmt->bindParam(':address',$address);
        $stmt->bindParam(':status',$status);

        return $stmt->execute();
    }

    // View
    function view()
    {
        $qry = "SELECT * FROM users WHERE is_deleted=0 ORDER BY id DESC";
        $stmt = $this->con->prepare($qry);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete
    function delete($id)
    {
        $qry = "UPDATE users SET is_deleted=1 WHERE id=:id";
        $stmt = $this->con->prepare($qry);

        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }

    // View by id
    function viewbyid($id)
    {
        $qry = "SELECT * FROM users WHERE id=:id";
        $stmt = $this->con->prepare($qry);

        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    function update($id,$img,$name,$email,$mobile,$gender,$dob,$address,$status)
    {
        if($img!=""){
            $qry = "UPDATE users SET profile_img=:img,name=:name,email=:email,mobile=:mobile,gender=:gender,date_of_birth=:dob,address=:address,status=:status WHERE id=:id";
        }
        else{
            $qry = "UPDATE users SET name=:name,email=:email,mobile=:mobile,gender=:gender,date_of_birth=:dob,address=:address,status=:status WHERE id=:id";
        }

        $stmt = $this->con->prepare($qry);

        if($img!="")
            $stmt->bindParam(':img',$img);

        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':mobile',$mobile);
        $stmt->bindParam(':gender',$gender);
        $stmt->bindParam(':dob',$dob);
        $stmt->bindParam(':address',$address);
        $stmt->bindParam(':status',$status);

        return $stmt->execute();
    }
}
?>

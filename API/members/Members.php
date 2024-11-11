<?php

class Members {
    private $conn;

    public function __construct($dbname) {
        $this->conn = $dbname;
    }
    public function getAllMembers() {
        $sql = "SELECT * FROM  agap_members";
        return $this->conn->query($sql);
    }
    public function getMemberById($id){
        $sql = "SELECT * FROM agap_members WHERE members_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();

    }
    public function createMember($data) {
        $sql = "INSERT INTO agap_members (members_name, members_address, members_birthdate, members_age, members_civil_status, members_gender, members_contact_number, members_work, members_household_income) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssss", $data['members_name'],  $data['members_address'],  $data['members_birthdate'],  $data['members_age'],  $data['members_civil_status'],  $data['members_gender'],  $data['members_contact_number'],  $data['members_work'],  $data['members_household_income']);
        return $stmt->execute();
    }
    public function updateMember($id, $data) {
        $sql = "UPDATE agap_members SET members_name = ?, members_address = ?, members_birthdate = ?, members_age = ?, members_civil_status = ?, members_gender = ?, members_contact_number = ?, members_work = ?, members_household_income =? WHERE  members_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $data['members_name'],  $data['members_address'],  $data['members_birthdate'],  $data['members_age'],  $data['members_civil_status'],  $data['members_gender'],  $data['members_contact_number'],  $data['members_work'],  $data['members_household_income'], $id);
        return $stmt->execute();
    }
    public function deleteMember($id) {
        $sql = "DELETE FROM agap_members WHERE members_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
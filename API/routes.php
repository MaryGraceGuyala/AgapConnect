<?php
require 'dbconnect.php';
require 'members/Members.php';

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$conn = getDBConnection();
$member = new Members($conn);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $member->getMemberById($id);
            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Member not found']);
            }
        } else {
            $result = $member->getAllMembers();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($data);
        }
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if ($member->createMember($input)) {
            http_response_code(201);
            echo json_encode(['message' => 'Member created']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Failed to create member']);
        }
        break;

    case 'PUT':
        $id = $_GET['id'];
        $input = json_decode(file_get_contents('php://input'), true);
        if ($member->updateMember($id, $input)) {
            http_response_code(200);
            echo json_encode(['message' => 'Member updated']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Failed to update member']);
        }
        break;

    case 'DELETE':
        $id = $_GET['id'];
        if ($member->deleteMember($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'Member deleted']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Failed to delete member']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
?>
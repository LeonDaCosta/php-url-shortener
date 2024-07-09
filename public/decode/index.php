<?php
    require __DIR__ . '/../../vendor/autoload.php';

    include_once '../../config/Database.php';

    use Hashids\Hashids;

    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');

    function validUrl($url) {
        switch($url) {
            case !is_string($url) : return false;
            case strcmp(substr($url, -16,9), 'short.est') !== 0 : return false;
        }

        return true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postData = array_merge($_POST, (array) json_decode(file_get_contents('php://input'), true));
           
		if(isset($postData['url'])) {
            // Validate url
			if(validUrl($postData['url'])) {
                // Create database
                $db = new Database();
                // Connect to database
                $db->connect();
                $hashId = substr($postData['url'], -6);
                $hashids = new Hashids('shorturl',6);
                $id = $hashids->decode($hashId)[0];
                $record = $db->getRecord($id);
                $db->closeConnection();
                if (array_key_exists('url', $record)) {
                    echo json_encode(array('original_url' => $record['url'], 'short_url' => $postData['url'], 'created_date' => $record['created_date']));
                } else {
                    header('HTTP/1.1 400 Bad Request', true, 400);
                    echo json_encode(array('message' => "Error: Bad Request, URL not found"));
                }
			} else {
                header('HTTP/1.1 400 Bad Request', true, 400);
                echo json_encode(array('message' => "Error: Bad Request, invalid URL"));
			}
		} else {
            header('HTTP/1.1 400 Bad Request', true, 400);
            echo json_encode(array('message' => "Error: Bad Request, URL is missing!"));
		}
	} else {
        header('HTTP/1.1 405 Method Not Allowed', true, 405);
		echo json_encode(array('message' => "Error: " . $_SERVER['REQUEST_METHOD'] . 'Method Not Allowed '));
	}

?>
<?php

$conn = new mysqli("localhost", "root", "zr!@#456");
if (!mysqli_connect_errno()) {
	$db_conn = mysqli_select_db($conn,"AssetDataCollection");
	
	
	$response['code'] ='error';
	$response['reason'] ='Parameters missing';

	$base = dirname(__FILE__); // now $base contains "app"

	include_once $base."/vendor/autoload.php";
	include_once "templates/base.php";
	include_once "templates/basicFn.php";

	if (!$oauth_credentials = getOAuthCredentialsFile()) {
		echo missingOAuth2CredentialsWarning();
		return;
	}

	$client = new Google_Client();
	$client->setAuthConfig($oauth_credentials);
	$client->setRedirectUri($redirect_uri);
	$client->addScope("https://www.googleapis.com/auth/drive");
	$client->setAccessType("offline");
	$client->setApprovalPrompt('force'); 

	if (file_exists($credentialsPath)) {
		$accessToken = json_decode(file_get_contents($credentialsPath), true);
	}

	$client->setAccessToken($accessToken);
	$_SESSION['upload_token'] = $accessToken;
	
	// Refresh the token if it's expired.
	if ($client->isAccessTokenExpired()) {
		$oldRefreshToken = $client->getRefreshToken();
		$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
		$arr = $client->getAccessToken();
		$arr['refresh_token'] = $oldRefreshToken;
		file_put_contents($credentialsPath, json_encode($arr));
	}

	$service = new Google_Service_Drive($client);
	try {
		
		
		$fileName = [];
			$eachFolderId = '1GBOXDExB3ZW8QPBMm4Hz57PxE3w22mJI'; 	// Folder Id for ISSAC -> ISSAC-INWARD
			$subFolderFiles = $service->files->listFiles([
				"q" => "'$eachFolderId' in parents"
			]);
			
			if(!empty($subFolderFiles)) {
				foreach ($subFolderFiles->getFiles() as $subFile) {
					$fileName[] = $subFile->name;
					
					if($subFile->mimeType == 'text/xml'){
						$fileId = $subFile->id;
						$content = $service->files->get($fileId, array("alt" => "media"));
						
						try {
							// Upload file to Folder
							$isFileAvail = mysqli_query($conn,"SELECT * FROM LGA_User_Inward_FileLog WHERE FileName='".$subFile->name."'");
							if(count(mysqli_fetch_assoc($isFileAvail)) == 0){
								$outHandle = fopen("./AssetCollections/ISAAC/".$subFile->name, "w+");
								// Until we have reached the EOF, read 1024 bytes at a time and write to the output file handle.
								while (!$content->getBody()->eof()) {
									fwrite($outHandle, $content->getBody()->read(1024));
								}
								fclose($outHandle);
								mysqli_query($conn,"INSERT INTO LGA_User_Inward_FileLog (Org_Code,FolderName,FileName,Status) VALUES ('ISAAC','".$eachFolderId."','".$subFile->name."','0')");
							}

							
						} catch (Exception $e) {
							print "Error in File: " . $e->getMessage();
						}
					}
				}
			}
			
		echo json_encode($fileName);
		echo json_encode($ccrcFileName);
	} catch (Exception $e) {
		print "Error in Fetching Google Drive Folder: " . $e->getMessage();
	}
	
	
	
	
	
	
} else {
	echo "Connection Failed";
}
  

exit;


	

?>
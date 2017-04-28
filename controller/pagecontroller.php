<?php
/**
 * ownCloud - seeker
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Daugieras <adau828@aucklanduni.ac.nz>
 * @copyright Daugieras 2017
 */

namespace OCA\Seeker\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\IUserSession;
use OCP\IConfig;
use OCP\Files\FileInfo;
use OCP\Files\Folder;
use OCP\Files\IRootFolder;
use OCP\Files\Node;

class PageController extends Controller {


	private $userId;
	private $userSession;
	private $config;

	public function __construct($AppName, IRequest $request, IUserSession $userSession, $UserId, IConfig $config){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->userSession = $userSession;
		$this->config = $config;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
		$params = ['user' => $this->userId];
		return new TemplateResponse('seeker', 'main', $params);  // templates/main.php
	}

	/**
	 * Simply method that posts back users who fit to the selected parameters .
	 * @NoAdminRequired
	 */

	public function getUser($gender,$location,$old,$english,$maori,$nzlive){

		$users =array();		

		if($gender === 'both')
		{
			$users = array_merge($this->config->getUsersForUserValue('background','gender','male'),$this->config->getUsersForUserValue('background','gender','female'));
		}
		else{$users = $this->config->getUsersForUserValue('background','gender',$gender);}

		$size = count($users);

		if($location !== 'All')
		{	
			for($i=0; $i<$size; $i++)
			{
			$addr = $this->config->getUserValue($users[($size-$i-1)],'background','addr');
			if($addr !== $location) {array_splice($users,$size-$i-1,1);}
			}
		}

		$size = count($users);

		if($old !== 'All')
		{	
			for($i=0; $i<$size; $i++)
			{
			$age = $this->config->getUserValue($users[($size-$i-1)],'background','age');
			if(($age<$old || $age>$old+9) && ($old !== '86')) {array_splice($users,$size-$i-1,1);}
			if($age<$old && $old === '86') {array_splice($users,$size-$i-1,1);}
			}
		}

		$size = count($users);

		if($english !== 'none')
		{
			for($i=0; $i<$size; $i++)
			{
				$en = $this->config->getUserValue($users[($size-$i-1)],'background','eprofil');
	
				if($english === 'both' && $en === 'other') {array_splice($users,$size-$i-1,1);}
				if($english === 'L2' && $en !== 'L2') {array_splice($users,$size-$i-1,1);}
				if(($english === 'L1(NZEnglish)' || $english === 'L1(All)') && $en !== 'L1') {array_splice($users,$size-$i-1,1);}
				if($english === 'L1(NZEnglish)' && $en === 'L1') 
				{
				$type = $this->config->getUserValue($users[($size-$i-1)],'background','etype');
					if($type !== 'English(NewZeland)'){array_splice($users,$size-$i-1,1);}
				}
			}
		}

		$size = count($users);

		if($maori !== 'none')
		{
			for($i=0; $i<$size; $i++)
			{
				$ma = $this->config->getUserValue($users[($size-$i-1)],'background','mprofil');
	
				if($maori === 'both' && $ma === 'other') {array_splice($users,$size-$i-1,1);}
				if($maori === 'L2' && $ma !== 'L2') {array_splice($users,$size-$i-1,1);}
				if($maori === 'L1' && $ma !== 'L1') {array_splice($users,$size-$i-1,1);}
	
			}
		}

		$size = count($users);

		if($nzlive !== 'All')
		{	
			for($i=0; $i<$size; $i++)
			{
			$nztime = $this->config->getUserValue($users[($size-$i-1)],'background','nztime');
			$test[$i]=$nztime;
			if(($nztime<$nzlive || $nztime>$nzlive+5) && ($nzlive === '0')) {array_splice($users,$size-$i-1,1);}
			if(($nztime<$nzlive || $nztime>$nzlive+4) && ($nzlive === '6')) {array_splice($users,$size-$i-1,1);}
			if(($nztime<$nzlive || $nztime>$nzlive+9) && ($nzlive === '11')) {array_splice($users,$size-$i-1,1);}
			if($nztime<$nzlive && $nzlive === '20') {array_splice($users,$size-$i-1,1);}
			}
		}
		
		return new DataResponse(['echo' => $users]);
	}


	/**
	 * Simply method that posts back files which belong to the folder selected and created by users selected 
	 * @NoAdminRequired
	 */
	public function getOwner($type,$users) {

		$file_array =array();
		$fileName = array();
		$fileId = array();
		$owner =array();
		$folderType = array();
		$folderChoice = array();
		$l =0;
		$folder = \OC::$server->getUserFolder($userId); //get the root folder of the user 
		$sizeusers = count($users);

		//search in the root folder each database folder and assign them to one specific index of folderChoice
		$folderType = $folder->search('DataBase VoNZ word');
		$folderChoice[0] = $folderType[0];
		$folderType = $folder->search('DataBase VoNZ list_word');
		$folderChoice[1] = $folderType[0];
		$folderType = $folder->search('DataBase VoNZ short_sentence');
		$folderChoice[2] = $folderType[0];
		$folderType = $folder->search('DataBase VoNZ sentence');
		$folderChoice[3] = $folderType[0];

		//for each database folder
		for($i=0; $i<4; $i++)
		{	
			//if the folder is selected in type
			if ($type[($i+1)]=== '1' || $type[0] === '1'){

				//take all the files in this folder
				$file_array = $folderChoice[$i]->getDirectoryListing();
				$sizefile = count($file_array);

				//for each file in the folder
				for($j=0; $j<$sizefile; $j++)
				{	
						//for each user selected
						for($k=0; $k<$sizeusers; $k++)
						{
							//look if the file was created by the user
							$owner[$j] = strtok($file_array[$j]->getName(),'_');
							if( $owner[$j] === $users[$k])
							{
								$fileName[$l] = $file_array[$j]->getName();	//if yes add the name file to the list of file : fileName
								$fileId[$l] = $file_array[$j]->getId();		//and the file id to the list :fileId
								$l++; //to have successive index in fileName 
							}		
						}
				}
			}
		}

		return new DataResponse(['echo' => $fileName, 'echo2' =>$fileId]); //send the list of files which match 
	}

	/**
	 * Simply method that download fileId in the folderName
	 * @NoAdminRequired
	 */
	public function download($fileId, $folderName) {

		$folder = \OC::$server->getUserFolder($userId); //get the root folder of the user 
		$size = count($fileId);
		$uid = $this->userSession->getUser()->getUID(); //collect the user ID
		
		if($folderName === ''){$folderName = 'Study_1';} //name by default = Study_1

		if($folder->nodeExists('/'.$folderName.'/') === false) {$folder->newFolder('/'.$folderName.'/');} //if the folder does not exist yet, create it 

		//For each file copy it on the folder selected
		for($i=0; $i<$size; $i++)
		{	
			$file = $folder->getById($fileId[$i]);
			$path = '/'.$uid.'/files/'.$folderName.'/'.$file[0]->getName();
			$file[0]->copy($path);			
		}
		


		return new DataResponse();
	}

}

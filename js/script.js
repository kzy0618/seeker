/**
 * ownCloud - seeker
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Daugieras <adau828@aucklanduni.ac.nz>
 * @copyright Daugieras 2017
 */

(function ($, OC) {

	$(document).ready(function () {

		var choice;
		var age;
		var nztime;
		var users;
		var fileName;
		var fileId;
		var fileToDownload;
		var nb =0;
		var k =0;
		var echo = document.getElementById('echo-result');

		//initialisation
		document.getElementById("All").checked = true;
		findFile();


		$('#find').click(function () {
			var url = OC.generateUrl('/apps/seeker/owner'); 
			RecordingType();
			var data = {
				users :users,
				type: choice
			};

			$.post(url, data).success(function (response) { //call fonction getOwner in pagecontroller.php
				fileName = response.echo;
				fileId = response.echo2;
				$('#tableau').remove(); //Delete old table before create a new one with new data
				Display();		//Create table with new data
				$('#echo-result').removeClass('hidden');
			});
		});

		$('#download').click(function () {
			var url = OC.generateUrl('/apps/seeker/download');
			FileChoice(); 		//update fileToDownload

			var data = {

				fileId: fileToDownload,
				folderName :document.getElementById('folder').value,
			};

			info.innerHTML = "In process";

			$.post(url, data)	//call fonction download in pagecontroller.php	 
			  .done(function() {
				  document.getElementById('info').style.color = 'green';
				  $(info).text("Success!");
			  })
			  .fail(function() {
				  document.getElementById('info').style.color = 'red';
				$(info).text("Error!");
			  })
			  .always(function() {
			  });
		});

		//function carry out each time that a parameter changed, initialize variables and update the list of users who fit the parameters
		function findFile (){ 
			var url = OC.generateUrl('/apps/seeker/user');
			AgeBand();
			NzLiveBand();

			var data = {
				gender:document.getElementById('gender').value,
				location: document.getElementById('addr').value,
				old :age,
				english: document.getElementById('eprofil').value,
				maori: document.getElementById('mprofil').value,
				nzlive:nztime
			};
				result.innerHTML = " users found !";
			$.post(url, data).success(function (response) { 	//call getUser download in pagecontroller.php	 
				users = response.echo;
				result.innerHTML = users.length+" users found !";

			});

			//initialialization again 
			$('#echo-result').addClass('hidden');
			document.getElementById('info').style.color = 'black';
			info.innerHTML = "";
		}


		function RecordingType (){
			choice = [0,0,0,0,0];

			if(document.getElementById('All').checked == true){
			choice[0] =1;
			}

			if(document.getElementById('Word').checked == true){
			choice[1] =1;
			}

			if(document.getElementById('ListOfWord').checked == true){
			choice[2] =1;
			}

			if(document.getElementById('ShortSentence').checked == true){
			choice[3] =1;
			}

			if(document.getElementById('Sentence').checked == true){
			choice[4] =1;
			}
		}

		function AgeBand () {
			switch (document.getElementById('age').value)
			{
			case 'All': age = 'All';	
					break;
			case '16-25': age = 16;	
					break;
			case '26-35': age = 26;	
					break;
			case '36-45': age = 36;	
					break;
			case '46-55': age = 46;	
					break;
			case '56-65': age = 56;	
					break;
			case '66-75': age = 66;	
					break;
			case '76-85': age = 76;	
					break;
			case '+85': age = 86;	
					break;
			}
		}
		
		function NzLiveBand () {
			switch (document.getElementById('nztime').value)
			{
			case 'All': nztime = 'All';	
					break;
			case '0-5': nztime = 0;	
					break;
			case '6-10': nztime = 6;	
					break;
			case '11-20': nztime = 11;	
					break;
			case '20+': nztime = 20;	
					break;
			}
		}

		function Display(){

			var tab = document.createElement('table');
			tab.id = 'tableau';
			nb =(fileName.length);

			//Fill the table only if fileName is not empty
			if(nb !== 0){ 
				fileName[nb]='All';

				for (row = 0; row < nb+1; row++){
					var tr = document.createElement('tr');
				   	
				      	td = document.createElement('td');
				      	td2 = document.createElement('td');

					var tn = document.createElement('input') ;
					tn.setAttribute('type','checkbox');
					tn.setAttribute('id','tr'+row);
					var tn2 = document.createTextNode(fileName[nb-row]); //use nb-row to have "All" first and so always with the id : tr0
	
				      	td.appendChild(tn);
				      	td2.appendChild(tn2);

					tr.appendChild(td);
					tr.appendChild(td2);

					tab.appendChild(tr);
				}
			}

			echo.appendChild(tab);
			$('#tableau').insertBefore('#part2'); //insert before download button 
		}
		
		//When checkbox 'All' is activate every other checkbox will be activate too
		function check(){
			if(document.getElementById('tr0').checked == true){
				for (i = 0; i < nb+1; i++){document.getElementById('tr'+i).checked = true;}
			}

		}
		

		function FileChoice(){

			fileToDownload = [];
			k=0;

			for (i = 1; i < nb+1; i++){
				if(document.getElementById('tr'+i).checked == true){
					fileToDownload[k] =fileId[nb-i]; //be careful of the index du to the inversion of index when filling the table (see Display function)
					k++;
				}
				
			}
		}
		
		var $activityNotifications = $('#seeker');
		//search files when users add informations from input or select
		$activityNotifications.find('select').change(findFile);
		$activityNotifications.find('#recordingtype').change(findFile);
		$activityNotifications.find('#echo-result').change(check);

	});

})(jQuery, OC);

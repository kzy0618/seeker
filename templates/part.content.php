<div id = seeker>
<br>
<br>
<a target="_blank">
	<img src="<?php print_unescaped(OCP\Util::imagePath('seeker', 'researcher.jpg')); ?>" style="height:150px"/>
</a>

<p>Welcome <?php p($_['user']) ?></p>
	<br>
<p>Choose your parameters :</p>
	<br>
<label>Gender</label>

	<select class="form-control" id="gender" name="gender">
		<option value="both" <?php if (($_['gender']) == 'both') echo ' selected="selected"'; ?>>both</option>
		<option value="male" <?php if (($_['gender']) == 'male') echo ' selected="selected"'; ?>>male</option>
		<option value="female" <?php if (($_['gender']) == 'female') echo ' selected="selected"'; ?>>female</option>
	</select>

<label>Location</label>

	<select class="form-control" id="addr" name="addr">
		<option value="All" <?php if (($_['addr']) == 'All') echo ' selected="selected"'; ?>>All</option>
		<option value="Northland" <?php if (($_['addr']) == 'Northland') echo ' selected="selected"'; ?>>Northland</option>
		<option value="Auckland" <?php if (($_['addr']) == 'Auckland') echo ' selected="selected"'; ?>>Auckland</option>
		<option value="Waikato" <?php if (($_['addr']) == 'Waikato') echo ' selected="selected"'; ?>>Waikato</option>
		<option value="BayOfPlenty" <?php if (($_['addr']) == 'BayOfPlenty') echo ' selected="selected"'; ?>>Bay of Plenty</option>
		<option value="Gisborne" <?php if (($_['addr']) == 'Gisborne') echo ' selected="selected"'; ?>>Gisborne</option>
		<option value="HawkeBay" <?php if (($_['addr']) == 'HawkeBay') echo ' selected="selected"'; ?>>Hawke Bay</option>
		<option value="Taranaki" <?php if (($_['addr']) == 'Taranaki') echo ' selected="selected"'; ?>>Taranaki</option>
		<option value="Manawatu-Wanganui" <?php if (($_['addr']) == 'Manawatu-Wanganui') echo ' selected="selected"'; ?>>Manawatu-Wanganui</option>
		<option value="Wellington" <?php if (($_['addr']) == 'Wellington') echo ' selected="selected"'; ?>>Wellington</option>
		<option value="Marlborough" <?php if (($_['addr']) == 'Marlborough') echo ' selected="selected"'; ?>>Marlborough</option>
		<option value="Tasman" <?php if (($_['addr']) == 'Tasman') echo ' selected="selected"'; ?>>Tasman</option>
		<option value="WestCoast" <?php if (($_['addr']) == 'WestCoast') echo ' selected="selected"'; ?>>West Coast</option>
		<option value="Canterbury" <?php if (($_['addr']) == 'Canterbury') echo ' selected="selected"'; ?>>Canterbury</option>
		<option value="Otago" <?php if (($_['addr']) == 'Otago') echo ' selected="selected"'; ?>>Otago</option>
		<option value="Southland" <?php if (($_['addr']) == 'Southland') echo ' selected="selected"'; ?>>Southland</option>
	</select>

<label>Age</label>

	<select class="form-control" id="age" name="age">
		<option value="All" <?php if (($_['age']) == 'All') echo ' selected="selected"'; ?>>All</option>
		<option value="16-25" <?php if (($_['age']) == '16-25') echo ' selected="selected"'; ?>>16-25</option>
		<option value="26-35" <?php if (($_['age']) == '26-35') echo ' selected="selected"'; ?>>26-35</option>
		<option value="36-45" <?php if (($_['age']) == '36-45') echo ' selected="selected"'; ?>>36-45</option>
		<option value="46-55" <?php if (($_['age']) == '46-55') echo ' selected="selected"'; ?>>46-55</option>
		<option value="56-65" <?php if (($_['age']) == '56-65') echo ' selected="selected"'; ?>>56-65</option>
		<option value="66-75" <?php if (($_['age']) == '66-75') echo ' selected="selected"'; ?>>66-75</option>
		<option value="76-85" <?php if (($_['age']) == '76-85') echo ' selected="selected"'; ?>>76-85</option>
		<option value="+85" <?php if (($_['age']) == '+85') echo ' selected="selected"'; ?>>+85</option>
	</select>

<label>English profile</label>

	<select class="form-control" id="eprofil" name="eprofil">
		<option value="none" <?php if (($_['eprofil']) == 'none') echo ' selected="selected"'; ?>>none</option>
		<option value="both" <?php if (($_['eprofil']) == 'both') echo ' selected="selected"'; ?>>both</option>
		<option value="L1(All)" <?php if (($_['eprofil']) == 'L1(All)') echo ' selected="selected"'; ?>>L1 (All)</option>
		<option value="L1(NZEnglish)" <?php if (($_['eprofil']) == 'L1(NZEnglish)') echo ' selected="selected"'; ?>>L1 (NZ English)</option>
		<option value="L2" <?php if (($_['eprofil']) == 'L2') echo ' selected="selected"'; ?>>L2</option>
	</select>

<label>Maori profile</label>

	<select class="form-control" id="mprofil" name="mprofil">
		<option value="none" <?php if (($_['mprofil']) == 'none') echo ' selected="selected"'; ?>>none</option>
		<option value="both" <?php if (($_['mprofil']) == 'both') echo ' selected="selected"'; ?>>both</option>
		<option value="L1" <?php if (($_['mprofil']) == 'L1') echo ' selected="selected"'; ?>>L1</option>
		<option value="L2" <?php if (($_['mprofil']) == 'L2') echo ' selected="selected"'; ?>>L2</option>
	</select>

<label>Nb years in NZ</label>

	<select class="form-control" id="nztime" name="nztime">
		<option value="All" <?php if (($_['nztime']) == 'All') echo ' selected="selected"'; ?>>All</option>
		<option value="0-5" <?php if (($_['nztime']) == '0-5') echo ' selected="selected"'; ?>>0-5</option>
		<option value="6-10" <?php if (($_['nztime']) == '6-10') echo ' selected="selected"'; ?>>6-10</option>
		<option value="11-20" <?php if (($_['nztime']) == '11-20') echo ' selected="selected"'; ?>>11-20</option>
		<option value="20+" <?php if (($_['nztime']) == '20+') echo ' selected="selected"'; ?>>20+</option>
	</select>
<br>
<br>
<p> Recording type : </p> 

<div id ='recordingtype'>	
	<input id = "All" type = checkbox> <label>All</label>
	<input id = "Word" type = checkbox> <label>Word</label>
	<input id = "ListOfWord" type = checkbox> <label>List of Word</label>
	<input id = "ShortSentence" type = checkbox> <label>Short Sentence</label>
	<input id = "Sentence" type = checkbox> <label>Sentence</label>
</div>
<br>
<br>
	<label id ="result" style ="color:red;"></label>
	<button id ="find">Show files</button>
<br>
<br>

<div id="echo-result">
	<div id ='part2'>
<br>
	<button id ="download">Download</button>
    	<label for="folder" class="col-sm-2 control-label">in</label>
	<input type="text" class="form-control update" id="folder" name="folder" placeholder="Study_1"/>
	<label id ="info"></label>
	</div>
</div>

<div style="text-align:center; margin-top:10vh;">
<br/>

<a href="https://activate.reviews" target="_blank">
    <img src="//activate.reviews/wp-content/uploads/2018/11/activate-reviews-RL-icon.png" style="border:none;">
</a>

<br/><h1>Configuration</h1>

<br/>

<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

    if (!empty($_POST)) {
        global $wpdb;
        $Table = Plugin_Name_Safe;
        $Data = array(
			'Id' => 1,
			'Name'      => $_POST['Name'],
            'Rating'    => $_POST['Rating'],
			'ColorA'    => $_POST['ColorA'],
			'ColorB'    => $_POST['ColorB']
        );
        $Format = array(
            '%d',
			'%s',
            '%s',
			'%s',
			'%s'
        );
		
		$Replace = $wpdb->replace( $Table, $Data, $Format );
		
		if($Replace){
			
		global $wpdb;
        $Table = Plugin_Name_Safe;
		$Query = $wpdb->prepare("SELECT * FROM $Table", "0");
    	$Results = $wpdb->get_results($Query);

		$Name = $Results[0]->Name;
		$Rating = $Results[0]->Rating;
		$ColorA = $Results[0]->ColorA;
		$ColorB = $Results[0]->ColorB;
			
		?>
        	
            <form method="post" class="ureview-settings-form" style="margin-left:auto;margin-right:auto;">
            
            <div class="field-col">
            	<label>Embed Path</label>
            	<input required="required" type="text" name="Name" id="ur_path" value="<?php echo $Name ?>" /><br />
            </div>
            
            <div class="field-col">
            	<label>Hide Aggregate Rating?</label>
            	<input style="margin-top:5px;" type="text" name="Rating" id="Ratur_hide_reviewsing" placeholder="'yes' or 'no'" value="<?php echo $Rating ?>">
            </div>
            
            <div class="field-col">
            	<label>Button Color</label>
            	<input name="ColorA" id="ur_buttoncolor" type="color" value="<?php echo $ColorA ?>" />
            </div>
            
            <div class="field-col">
            	<label>Star Background Color</label>
            	<input name="ColorB" id="ur_circlecolor" type="color" value="<?php echo $ColorB ?>" />
            </div>
            
            <input type="submit" name="Submit" id="submit" class="button button-primary" value="Save Changes">
        	
            </form>
        	<br />
            Your settings have been saved.
            
        <?php 
        }
    } else {
		
		global $wpdb;
        $Table = Plugin_Name_Safe;
		$Query = $wpdb->prepare("SELECT * FROM $Table", "0");
    	$Results = $wpdb->get_results($Query);
		
		$Name = $Results[0]->Name;
		$Rating = $Results[0]->Rating;
		$ColorA = $Results[0]->ColorA;
		$ColorB = $Results[0]->ColorB;
		
		
        ?>
        
        <form method="post" class="ureview-settings-form" style="margin-left:auto;margin-right:auto;">
        	
            <div class="field-col">
            	<label>Embed Path</label>
            	<input type="text" name="Name" id="ur_path" value="<?php echo $Name ?>" /><br />
            </div>
            
            <div class="field-col">
            	<label>Hide Aggregate Rating?</label>
            	<input style="margin-top:5px;" type="text" name="Rating" id="ur_hide_reviews" placeholder="'yes' or 'no'" value="<?php echo $Rating ?>">
            </div>
            
            <div class="field-col">
            	<label>Button Color</label>
            	<input required="required" name="ColorA" id="ur_buttoncolor" type="color" value="<?php echo $ColorA ?>" />
            </div>
            
            <div class="field-col">
            	<label>Star Background Color</label>
            	<input required="required" name="ColorB" id="ur_circlecolor" type="color" value="<?php echo $ColorB ?>" />
            </div>
            
            <input type="submit" name="Submit" id="submit" class="button button-primary" value="Save Changes">
        
        </form>
        
        <?php 
    } 
?>
</div>

<style>
#ur_buttoncolor, 
#ur_circlecolor {
    width: 26px;
    height: 24px;
    padding: 0px 2px !important;
    box-shadow: none;
}
.ureview-settings-form {
	width: 400px;
    padding: 20px;
    background: #fff;
    border: 1px solid #c4ceb3;
}
.ureview-settings-form .field-col {
	display: block;
    margin-bottom: 15px;
}
.ureview-settings-form .field-col label {
    margin-right: 7px;
    vertical-align: text-bottom;
}
.ureview-settings-form .field-col small { }
</style>
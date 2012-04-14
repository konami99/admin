<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
	<div class="top-bar">
		<a href="#" class="button">ADD NEW </a>
		<h1>Edit Article</h1>
                    
	</div>
	
	<?php echo form_open('article/update/' . $this->uri->segment(3)); ?>
	
	<p>
	
	<?php
		echo 'ArticleID:', $queryResult->row()->ArticleID, br();
		echo 'Title:', form_input(array('name'=>'title','value'=>$queryResult->row()->Title)), br();
		echo 'Namespace:', form_input(array('name'=>'namespace','value'=>$queryResult->row()->NameSpace)), br();
	?>
	
	Article type:
	<select name="articletype">
	<?php 
    	foreach($allArticleTypes->result() as $row)
    	{ 
         	$articletypeID = $row->ArticleTypeID;?>	
         	<option value="<?php echo $articletypeID ?>" <?php if($articletypeID==$queryResult->row()->ArticleTypeID){ ?>selected<?php } ?>><?php echo $row->Type ?></option>
    <?php	
       	} ?>
	</select><br>
    
	Author:
	<select name="author">
    <?php 
       	foreach($allAuthors->result() as $row)
       	{ 
       		$authorID = $row->AuthorID;?>	
       		<option value="<?php echo $authorID ?>" <?php if($authorID==$queryResult->row()->AuthorID){ ?>selected<?php } ?>><?php echo $row->FirstName . ' ' . $row->LastName ?></option>
    <?php	
       	} ?>
	</select><br>
    
	Category:
	<select name="category">
    <?php 
       	foreach($allCategories->result() as $row)
       	{
       		$categoryID = $row->CategoryID;?>		
       		<option value="<?php echo $categoryID ?>" <?php if($categoryID==$queryResult->row()->CategoryID){ ?>selected<?php } ?>><?php echo $row->Category ?></option>
    <?php	
       	} ?>
	</select><br>
	<?php
		if(strcmp($queryResult->row()->FeatureStartDate, "")==0){
           	$featureStartDate = "";
		}
		else{           
          	$featureStartDate = substr($queryResult->row()->FeatureStartDate, 5, 2) . '/' . substr($queryResult->row()->FeatureStartDate, 8, 2) . '/' . substr($queryResult->row()->FeatureStartDate, 0, 4);
		}
                
                
		if(strcmp($queryResult->row()->FeatureEndDate, "")==0){
           	$featureEndDate = "";
		}
		else{
          	$featureEndDate = substr($queryResult->row()->FeatureEndDate, 5, 2) . '/' . substr($queryResult->row()->FeatureEndDate, 8, 2) . '/' . substr($queryResult->row()->FeatureEndDate, 0, 4);
		}

		if(strcmp($queryResult->row()->SubFeatureStartDate, "")==0){
           	$subFeatureStartDate = "";
		}
		else{           
           	$subFeatureStartDate = substr($queryResult->row()->SubFeatureStartDate, 5, 2) . '/' . substr($queryResult->row()->SubFeatureStartDate, 8, 2) . '/' . substr($queryResult->row()->SubFeatureStartDate, 0, 4);
		}
                
		if(strcmp($queryResult->row()->SubFeatureEndDate, "")==0){
          	$subFeatureEndDate = "";
		}
		else{
          	$subFeatureEndDate = substr($queryResult->row()->SubFeatureEndDate, 5, 2) . '/' . substr($queryResult->row()->SubFeatureEndDate, 8, 2) . '/' . substr($queryResult->row()->SubFeatureEndDate, 0, 4);
		}
                
		echo 'Feature Start Date:', form_input(array('id'=>'featureStartDate','name'=>'featureStartDate','value'=>$featureStartDate)), br();
		echo 'Feature End Date:', form_input(array('id'=>'featureEndDate','name'=>'featureEndDate','value'=>$featureEndDate)), br();
		echo 'SubFeature Start Date:', form_input(array('id'=>'subFeatureStartDate','name'=>'subFeatureStartDate','value'=>$subFeatureStartDate)), br();
		echo 'SubFeature End Date:', form_input(array('id'=>'subFeatureEndDate','name'=>'subFeatureEndDate','value'=>$subFeatureEndDate)), br();
		echo 'Summary:', form_textarea(array('name'=>'summary','value'=>$queryResult->row()->Summary)), br();
		echo 'Content:', form_textarea(array('name'=>'content','value'=>$queryResult->row()->Content)), br();
	?>
	</p>
		<span class="item-text">
			<div id="previewblock" style="display: block; visibility: visible; width:600px;">
				<div id="imagepreview" style="height: 150px; overflow-x: scroll; overflow-y: scroll; ">
					<ul style="list-style: none; padding: 0; margin: 0;">
						<li id="thumb" style="float: left; margin: 3px;">
							<img src="http://download.mobile01.com/thumb/attach/201204/mobile01-859229f23f00cb1923b9d4b9bf56c953.jpg" border="0" alt="" onclick="addimg('http://attach.mobile01.com/attach/201204/mobile01-859229f23f00cb1923b9d4b9bf56c953.jpg');" style="cursor:pointer;">
						</li>
						<li id="thumb" style="float: left; margin: 3px;">
							<img src="http://download.mobile01.com/thumb/attach/201204/mobile01-1ccf05eb8f9a3439de9286532e8f5665.jpg" border="0" alt="" onclick="addimg('http://attach.mobile01.com/attach/201204/mobile01-1ccf05eb8f9a3439de9286532e8f5665.jpg');" style="cursor:pointer;">
						</li>
						<ul></ul>
					</ul>
				</div>
				
			</div>
		
		</span>
	<p>
	<?php
		echo  form_submit('updateButton', 'Save');
		
	?>
	</p>
	<?php 
		echo form_close();
	?>
</div>

<script type="text/javascript">
    $(function(){
    	$( "#featureStartDate" ).datepicker();
    	$( "#featureEndDate" ).datepicker();
    	$( "#subFeatureStartDate" ).datepicker();
    	$( "#subFeatureEndDate" ).datepicker();
    	CKEDITOR.replace( 'summary' );
    	CKEDITOR.replace( 'content' );
    });

</script>
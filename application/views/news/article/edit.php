<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>Edit Article</h1>
                    
                </div>
               <p>
                <?php echo form_open('article/update/' . $this->uri->segment(3)); ?>
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

                if(strcmp($queryResult->row()->StartDate, "")==0){
                	$startDate = "";
                }
                else{           
                	$startDate = substr($queryResult->row()->StartDate, 5, 2) . '/' . substr($queryResult->row()->StartDate, 8, 2) . '/' . substr($queryResult->row()->StartDate, 0, 4);
                }
                
                if(strcmp($queryResult->row()->EndDate, "")==0){
                	$endDate = "";
                }
                else{
                	$endDate = substr($queryResult->row()->EndDate, 5, 2) . '/' . substr($queryResult->row()->EndDate, 8, 2) . '/' . substr($queryResult->row()->EndDate, 0, 4);
                }
                
                echo 'Feature Start Date:', form_input(array('id'=>'featureStartDate','name'=>'featureStartDate','value'=>$featureStartDate)), br();
                echo 'Feature End Date:', form_input(array('id'=>'featureEndDate','name'=>'featureEndDate','value'=>$featureEndDate)), br();
                echo 'Start Date:', form_input(array('id'=>'startDate','name'=>'startDate','value'=>$startDate)), br();
                echo 'End Date:', form_input(array('id'=>'endDate','name'=>'endDate','value'=>$endDate)), br();
                echo 'Summary:', form_textarea(array('name'=>'summary','value'=>$queryResult->row()->Summary)), br();
                echo 'Content:', form_textarea(array('name'=>'content','value'=>$queryResult->row()->Content)), br();
             	?>


                <?php
                echo  form_submit('updateButton', 'Save');
                ?>
                <?php echo form_close(); ?>
                </p>
            </div>

<script type="text/javascript">
    $(function(){
    	$( "#featureStartDate" ).datepicker();
    	$( "#featureEndDate" ).datepicker();
    	$( "#startDate" ).datepicker();
    	$( "#endDate" ).datepicker();
    	CKEDITOR.replace( 'summary' );
    	CKEDITOR.replace( 'content' );
    });

</script>
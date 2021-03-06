<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>New Article</h1>
                    
                </div>
               <p>
                <?php echo form_open('article/create'); ?>
                <?php
                echo 'Title:', form_input(array('name'=>'title','value'=>'')), br();
                echo 'Namespace:', form_input(array('name'=>'namespace','value'=>'')), br();
                ?>
                Article type:
                <select name="articletype">
                	<?php 
                	foreach($allArticleTypes->result() as $row)
                	{ ?>	
                		<option value="<?php echo $row->ArticleTypeID ?>"><?php echo $row->Type ?></option>
                	<?php	
                	} ?>
                </select><br>
                Author:
                <select name="author">
                	<?php 
                	foreach($allAuthors->result() as $row)
                	{ ?>	
                		<option value="<?php echo $row->AuthorID ?>"><?php echo $row->FirstName . ' ' . $row->LastName ?></option>
                	<?php	
                	} ?>
                </select><br>
                Category:
                <select name="category">
                	<?php 
                	foreach($allCategories->result() as $row)
                	{ ?>	
                		<option value="<?php echo $row->CategoryID ?>"><?php echo $row->Category ?></option>
                	<?php	
                	} ?>
                </select><br>
                <?php
                echo 'IsHero:', form_checkbox(array('id'=>'isHero','name'=>'isHero','value'=>1,'checked'=>false)), br();
                echo 'Hero Start Date:', form_input(array('id'=>'heroStartDate','name'=>'heroStartDate','value'=>'')), br();
                echo 'Hero End Date:', form_input(array('id'=>'heroEndDate','name'=>'heroEndDate','value'=>'')), br();
                
				echo 'IsFeature:', form_checkbox(array('id'=>'isFeature','name'=>'isFeature','value'=>1,'checked'=>false)), br();
                echo 'Feature Start Date:', form_input(array('id'=>'featureStartDate','name'=>'featureStartDate','value'=>'')), br();
                echo 'Feature End Date:', form_input(array('id'=>'featureEndDate','name'=>'featureEndDate','value'=>'')), br();
                
                echo 'IsSubFeature:', form_checkbox(array('id'=>'isSubFeature','name'=>'isSubFeature','value'=>1,'checked'=>false)), br();
                echo 'SubFeature Start Date:', form_input(array('id'=>'subFeatureStartDate','name'=>'subFeatureStartDate','value'=>'')), br();
                echo 'SubFeature End Date:', form_input(array('id'=>'subFeatureEndDate','name'=>'subFeatureEndDate','value'=>'')), br();
                echo 'Summary:', form_textarea(array('name'=>'summary','value'=>'')), br();
                echo 'Content:', form_textarea(array('name'=>'content','value'=>'')), br();
             	?>


                <?php
                echo  form_submit('updateButton', 'Save');
                ?>
                <?php echo form_close(); ?>
                </p>
            </div>

<script type="text/javascript">
    $(function(){
    	$( "#heroStartDate" ).datepicker();
    	$( "#heroEndDate" ).datepicker();
    	$( "#featureStartDate" ).datepicker();
    	$( "#featureEndDate" ).datepicker();
    	$( "#subFeatureStartDate" ).datepicker();
    	$( "#subFeatureEndDate" ).datepicker();
    	CKEDITOR.replace( 'summary' );
    	CKEDITOR.replace( 'content' );
    });

</script>
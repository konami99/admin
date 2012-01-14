<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>Edit Category</h1>
                    
                </div>
               
                <?php echo form_open('category/update/' .  $this->uri->segment(3)); ?>
                <?php
                echo 'MemberID:', $queryResult->row()->CategoryID, br();
                echo 'Category:', form_input(array('name'=>'category','value'=>$queryResult->row()->Category)), br();
             	?>


                <?php
                echo  form_submit('updateButton', 'Save');
                ?>
                <?php echo form_close(); ?>
            </div>

<script type="text/javascript">
    $(function(){
        
    });

</script>
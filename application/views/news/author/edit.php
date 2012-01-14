<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>Edit Author</h1>
                    
                </div>
               
                <?php echo form_open('author/update/' .  $this->uri->segment(3)); ?>
                <?php
                echo 'AuthorID:', $queryResult->row()->AuthorID, br();
                echo 'Firstname:', form_input(array('name'=>'firstname','value'=>$queryResult->row()->FirstName)), br();
                echo 'Lastname:', form_input(array('name'=>'lastname','value'=>$queryResult->row()->LastName)), br();
                echo 'Email:', form_input(array('name'=>'email','value'=>$queryResult->row()->Email)), br();
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
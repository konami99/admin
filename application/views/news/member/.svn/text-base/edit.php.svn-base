<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>Edit Member</h1>
                    
                </div>
               
                <?php echo form_open('member/update/' .  $this->uri->segment(3)); ?>
                <?php
                echo 'MemberID:', $queryResult->row()->MemberID, br();
                echo 'Username:', form_input(array('name'=>'username','value'=>$queryResult->row()->Username)), br();
             	echo 'Email:', form_input(array('name'=>'email','value'=>$queryResult->row()->Email)), br();
             	echo 'Firstname:', form_input(array('name'=>'firstname','value'=>$queryResult->row()->FirstName)), br();
                echo 'Lastname:', form_input(array('name'=>'lastname','value'=>$queryResult->row()->LastName)), br();
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
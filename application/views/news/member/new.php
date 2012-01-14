<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW </a>
                    <h1>New Member</h1>
                    
                </div>
               
                <?php echo form_open('member/create'); ?>
                <?php
                echo 'Username:', form_input(array('name'=>'username','value'=>'')), br();
             	echo 'Password:', form_password(array('name'=>'password','value'=>'')), br();
                echo 'Email:', form_input(array('name'=>'email','value'=>'')), br();
                echo 'Firstname:', form_input(array('name'=>'firstname','value'=>'')), br();
             	echo 'Lastname:', form_input(array('name'=>'lastname','value'=>'')), br();
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
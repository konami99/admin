<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <?php echo anchor('member/newMember', 'ADD NEW', array('class'=>'button')) ?>
                    <h1>Members Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>MemberID</th>
                	<th>Username</th>
             		<th>Email</th>
                	<th>FirstName</th>
                	<th>LastName</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->MemberID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo $row->Username ?></td>
                		<td><?php echo $row->Email ?></td>
                		<td><?php echo $row->FirstName ?></td>
                		<td><?php echo $row->LastName ?></td>
                		<td><?php echo anchor('member/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('member/delete/'.$id, 'delete');
                			?>
                		
                		</td>
                	</tr>
                <?php 
                }
               	?>
                
                </table>
            </div>

<script type="text/javascript">
    $(function(){
        
    });

</script>
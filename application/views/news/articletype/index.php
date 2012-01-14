<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <?php echo anchor('articletype/newArticleType', 'ADD NEW', array('class'=>'button')) ?>
                    <h1>Article Types Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>ArticleTypeID</th>
                	<th>Type</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->ArticleTypeID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo $row->Type ?></td>
                		<td><?php echo anchor('articletype/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('articletype/delete/'.$id, 'delete');
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
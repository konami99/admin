<?php $this->load->helper('form'); ?>
<?php $this->load->helper('html'); ?>
<div id="center-column">
                <div class="top-bar">
                    <!--- <?php echo anchor('article/newArticle', 'ADD NEW', array('class'=>'button')) ?> --->
                    <h1>Articles Index</h1>
                    
                </div>
               <span><?php echo $this->session->flashdata('update_message') ?></span>
                <table>
                <tr>
                	<th>ArticleID</th>
                	<th>Title</th>
                	<th>Option</th>
                </tr>
                <?php 
                foreach($queryResult->result() as $row)
                {
                	$id = $row->ArticleID;
                ?>
                	
                	<tr>
                		<td><?php echo $id ?></td>
                		<td><?php echo substr($row->Title, 0, 70) ?></td>
                		<td><?php echo anchor('article/edit/'.$id, 'edit');?>
                				|
                			<?php 
									echo anchor('article/delete/'.$id, 'delete');
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
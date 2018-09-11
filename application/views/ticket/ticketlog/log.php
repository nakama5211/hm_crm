			<?php 
		    if(count($listticketlog) >0)
		    {
		    foreach ($listticketlog as $rows) {
		     ?>
			<div class="padding-left-right-10">
				<div class="comment-wrap">
					<div class="photo">
						<div class="avatar" style="background-image: url('<?php echo 'http://crm.tavicosoft.com/api/avatar/'.$rows['useraction'] ?>')"></div>
					</div>
					<div class="comment-block padding-5">
						<p class="comment-text" style="font-weight: 600"><?php echo $rows['custname'] ?></p>
						<p class="comment-text"><?php echo $rows['cmt']?></p>
						<p class="comment-text"><?php echo $rows['action']?></p>
						
						<?php 
							if(strlen($rows['srcrecord'])>5){
								?>
								<audio controls>
								  <source src="<?php echo $rows['srcrecord'] ?>" type="audio/ogg">
								  Your browser does not support the audio tag.
								</audio>
								<?php
							}
						?>
						
						<div class="bottom-comment">
							<div class="comment-date"><?php echo $rows['changelog']?></div>
						</div>
					</div>
				</div>
				<ul class="app-breadcrumb breadcrumb react-comment">
		    		<p class="margin-right-30"><?php echo date('d-m-Y H:i',strtotime($rows['createdat'])); ?></p>
		        </ul>
		    </div>
		    <?php }} ?>
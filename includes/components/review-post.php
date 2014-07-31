<?php
if(!function_exists("arsene_review_post")){
	function arsene_review_post(){
		global $post;
		$review_meta = get_post_meta(get_the_ID(), 'arsene_review_metabox', true);

		if( !empty($review_meta) ){        
			$review_text = $review_meta['review_text'];
			$review_summary = $review_meta['review_summary'];
	        $review_criteria =  json_decode( $review_meta['review_criteria'], 1);
	    } else {
	        $review_criteria =  '';
	        $review_summary = '';
	        $review_text = '';
	    }

		if(!empty($review_criteria)): 

			$total_criteria = count($review_criteria);
			$total_score = 0;
		?>
		<div class="post-review <?php echo strtolower(get_arsene_option('arsene_review_position')); ?>">
			<h3><i class="icon-tasks"></i> <?php _e('Review Overview','arsene'); ?></h3>
			<div class="review-container">
				<?php foreach($review_criteria as $criteria): $total_score += intval($criteria['arsene_criteria_score']); ?>
				<div class="review-item">
					<div class="review-detail">
						<span class="category"><?php echo $criteria['arsene_review_criteria']; ?></span>
						<span class="score"><?php echo $criteria['arsene_criteria_score']; ?></span>
					</div>
					<div class="progress review-bar">
					  	<div class="bar" style="width: <?php echo (intval($criteria['arsene_criteria_score']) * 10);?>%;"></div>
					</div>
				</div>
				<?php endforeach; 
				$overall_score = $total_score/$total_criteria;
				?>

				<div class="summary">
					<h3 class="overall-score clearfix"><span class="review-number"><?php _e('Overall:','arsene'); ?> <?php echo sprintf("%01.2f", $overall_score); ?></span><span class="review-text"><?php echo $review_text != "" ? " / ".$review_text : ""; ?></span></h3>
					<div class="review-summary">
						<?php echo $review_summary; ?>
					</div>
				</div>
			</div>
		</div>
<?php
		endif;
	}
}
?>
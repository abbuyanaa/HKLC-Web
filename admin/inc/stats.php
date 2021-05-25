<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
		<div class="visual">
			<i class="fa fa-comments"></i>
		</div>
		<div class="details">
			<div class="number">
				<span data-counter="counterup" data-value="<?php echo $book->getBookTotalRow(); ?>">0</span>
			</div>
			<div class="desc">Бүртгэлтэй ном</div>
		</div>
	</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<a class="dashboard-stat dashboard-stat-v2 red" href="#">
		<div class="visual">
			<i class="fa fa-bar-chart-o"></i>
		</div>
		<div class="details">
			<div class="number">
				<span data-counter="counterup" data-value="<?php echo $word->getTotalRow(); ?>">0</span>
			</div>
			<div class="desc">Нийт үгс</div>
		</div>
	</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<a class="dashboard-stat dashboard-stat-v2 green" href="#">
		<div class="visual">
			<i class="fa fa-shopping-cart"></i>
		</div>
		<div class="details">
			<div class="number">
				<span data-counter="counterup" data-value="<?php echo $user->getTotalRow(); ?>">0</span>
			</div>
			<div class="desc">Хэрэглэгчид</div>
		</div>
	</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<a class="dashboard-stat dashboard-stat-v2 purple" href="#">
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number"> +
				<span>0</span>% 
			</div>
			<div class="desc"> Brand Popularity </div>
		</div>
	</a>
</div>
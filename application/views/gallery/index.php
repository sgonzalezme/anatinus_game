<div class="row">
	<div class="col-md-9">
		<h4 class="page-header">Picture gallery</b></h4>
	</div>
</div>

<div class="col-md-12">
    <?php foreach ($pictures as $picture){ ?>
        <div class="col-md-3" style="border:1px lightgray dotted">
            <img class="col-md-12 picture" src="<?php echo $picture['url']?>" />
            <label class="col-md-12"><?php echo $picture['emotion']?></label>
        </div>

    <?php } ?>
</div>

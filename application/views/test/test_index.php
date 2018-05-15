<div class="row">
	<div class="col-lg-9">
		<h4 class="page-header">Test</h4>
	</div>
</div>

<div class="row col-md-12">
    <p><?php if(!empty($results) ){
        foreach ($results as $num => $emotion){
            echo "<h5> Cara número $num </h5>";
            echo "Result: $emotion";
        }
    }?></p>
</div>

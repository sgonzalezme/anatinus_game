<div class="row">
	<div class="col-md-9">
		<h4 class="page-header">Results from <b><?php echo $username ?></b></h4>
	</div>
</div>

<div class="col-md-12">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Emotion</th>
            <th scope="col">Right answers</th>
            <th scope="col">Total of questions</th>
            <th scope="col">Result (over 10)</th>
        </tr>
        </thead>
        <tbody>

    <?php foreach ($stats as $stat){ ?>
        <tr class="table-active">
            <td><?php echo $stat['emotion'] ?></td>
            <td><?php echo $stat['right_answers'] ?></td>
            <td><?php echo $stat['total'] ?></td>
            <td>
                <?php
                $result = ($stat['right_answers'] / $stat['total']) * 10;
                echo number_format($result, 2)
                ?>
            </td>
        </tr>
    <?php } ?>
        </tbody>
    </table>

    <div class="form-group">
        <div class="col-md-10 col-md-offset-10">
            <a class="btn btn-link" href="<?php echo site_url('/results/index')?>">Back</a>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-9">
		<h4 class="page-header">Results from <b><?php echo $username ?></b></h4>
	</div>
</div>

<div class="col-md-12">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Num. questions</th>
            <th scope="col">Right answers</th>
            <th scope="col">Wrong answers</th>
            <th scope="col">Result (over 10)</th>
            <th scope="col">Summary</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>

    <?php foreach ($games as $game){ ?>
        <tr class="table-active">
            <th scope="row"><?php echo $game['game_id'] ?></th>
            <td><?php echo $game['username'] ?></td>
            <td><?php echo $game['num_questions'] ?></td>
            <td><?php echo $game['right_answers'] ?></td>
            <td><?php echo $game['wrong_answers'] ?></td>
            <td><?php
                $result = ($game['right_answers'] / $game['num_questions']) * 10;
                echo number_format($result, 2)
                ?>
            </td>
            <td>
                <ul>
                <?php
                    $summary = explode(',', $game['summary']);
                    foreach ($summary as $answer){
                        $answer_and_result = explode('-', $answer);
                        if($answer_and_result[1]){
                            echo "<li> {$answer_and_result[0]} <i class=\"text-success fa fa-check\"></i> </li>";
                        } else{
                            echo "<li> {$answer_and_result[0]} <i class=\"text-danger fa fa-times\"></i> </li>";
                        }
                    }
                ?>
                </ul>
            </td>
            <td><?php echo $game['created_at'] ?></td>
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

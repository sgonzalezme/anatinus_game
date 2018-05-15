<h3>See your results here:</h3><hr/>
<h4> You obtained a score of: <?php echo $score ?> / <?php echo $total ?></h4>
<div>
    <div class="col-md-10 col-md-offset-2">
        <?php foreach ($options as $position => $option){?>
            <div class="col-md-12" style="padding: 30px">
                <img class="col-md-8 big-picture" src="<?php echo $option['image']['url'] ?>" />

                <div class="col-md-4" style="padding-top: 50px">
                    <?php
                        foreach ($option['answers'] as $answer){
                            $was_ok = $results[$position]['result'];
                            $was_answered = strcmp($results[$position]['answered'], $answer) == 0;
                            $is_right = strcmp($results[$position]['image'], $answer) == 0;
                            $class = '';
                            $symbol = 'times';
                            if($was_ok && $was_answered){
                                $class = ' alert-success ';
                                $symbol = 'check';
                            } else if(!$was_ok && $was_answered){
                                $class = ' alert-danger ';
                            } else if(!$was_ok && $is_right){
                                $class = ' text-success ';
                                $symbol = 'check';
                            }
                    ?>
                        <label class="col-md-12 form-check-label <?php echo $class ?>">
                            <i class="fa fa-<?php echo $symbol ?>"></i>
                            <?php echo $answer; ?>
                        </label>
                        <?php if($was_ok && $is_right){
                            echo " Congratulations! ";
                        } ?>
                        <br/><br/>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <br/><br/>
    <div class="form-group">
        <div class="col-md-10 col-md-offset-10">
            <a class="btn btn-primary" href="<?php echo site_url('/game/index')?>">Back</a>
        </div>
    </div>
</div>
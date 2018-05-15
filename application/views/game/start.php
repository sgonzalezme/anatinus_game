<h3>Please select the right answer</h3><hr/>

<div>
    <form action="<?php echo site_url('/game/resolve') ?>" method="post">
        <div class="col-md-10 col-md-offset-2">
            <?php foreach ($options as $position => $option){?>
                <div class="col-md-12" style="padding: 30px">
                    <img class="col-md-8 big-picture" src="<?php echo $option['image']['url'] ?>" />

                    <div class="col-md-4" style="padding-top: 50px">
                        <?php foreach ($option['answers'] as $answer){?>
                            <label class="form-check-label">
                                <input class="form-check-input"
                                       type="radio"
                                       name="answer_<?php echo $position?>"
                                       value="<?php echo $answer?>" required />
                                <?php echo $answer ?>
                            </label>
                            <br/><br/>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br/><br/>
        <div class="col-md-10 col-md-offset-8">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>
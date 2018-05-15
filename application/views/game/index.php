<h3>Select an option:</h3><hr/>

<div>
    <form action="<?php echo site_url('/game/start') ?>" method="post">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="number" value="5" required /> 5 questions
            </label>
            <br/><br/>
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="number" value="10" /> 10 questions
            </label>
            <br/><br/>
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="number" value="20" /> 20 questions
            </label>
        </div>
        <br/><br/>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
</div>
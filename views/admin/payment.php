<div class="container">
    <form method="post" role="form" class="form-horizontal" >
        <div class="form-group">
            <label for="inputCard" class="col-sm-2 control-label">Card No</label>
            <div class="col-sm-10">
                <input name="company" type="number" class="form-control" id="inputCard" placeholder="5555555555554444">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Expiry Date</label>
            <div class="col-sm-10 form-inline">
                <input name="month" type="number" class="form-control" id="inputMonth" placeholder="09">
                <input name="year" type="number" class="form-control" id="inputYear" placeholder="2018">
            </div>
        </div>
        <div class="form-group">
            <label for="inputCVV" class="col-sm-2 control-label">Security Code</label>
            <div class="col-sm-10 form-inline">
                <input name="cvv" type="number" class="form-control" id="inputCVV" placeholder="123">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label><input name="agree" type="checkbox"> I accept the payment agreement</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>
</div>
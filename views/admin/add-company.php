<div class="container marketing">
    <h2 class="featurette-heading">Become part of the 24Istanbul <br><span class="text-muted">Register your restaurant or cafe</span></h2>
        <p class="lead">Would you like 24Istanbul to find your restaurant or cafe? Then register using the form below. For just 10,- TL a month your restaurant or cafe can take part of 24Istanbul.</p>
</div>

<hr class="featurette-divider">

<div class="container">
    <form name="companyForm" method="post" role="form" class="form-horizontal" >
        <div class="form-group">
            <label for="inputCompany" class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-10">
                <input name="company" type="text" class="form-control" id="inputCompany" placeholder="Company Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="address"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Location</label>
            <div class="col-sm-10">
                <div id="map-canvas"></div>
                <input type="hidden" name="lng" value="">
                <input type="hidden" name="lat" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputTelephone" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
                <input name="telephone" type="tel" class="form-control" id="inputTelephone" placeholder="+90 212 356 4782">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Company Email</label>
            <div class="col-sm-10">
                <input name="email" type="email" class="form-control" id="inputEmail" placeholder="company@mail.com">
            </div>
        </div>
        <div class="form-group">
            <label for="inputWebsite" class="col-sm-2 control-label">Website</label>
            <div class="col-sm-10">
                <input name="website" type="url" class="form-control" id="inputWebsite" placeholder="http://company.com">
            </div>
        </div>
        <div class="form-group">
            <label for="tagSelect" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
                <select id="inputCategory" class="form-control">
                    <option value="">Select A Category</option>
                    <?php
                        $categories = getDatabase()->all('SELECT * FROM categories');
                        foreach ($categories as $category) {
                            echo '<option value="' . $category['ID'] . '">' . $category['Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="tagSelect" class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10">
                <select multiple name="tag[]" class="form-control" id="inputTag"></select>
                <div id="availableTags">
                    <?php
                        $tags = getDatabase()->all('SELECT * FROM tags');
                        foreach ($tags as $tag) {
                            echo '<option value="' . $tag['ID'] . '" data-cat="' . $tag['CategoryID'] . '">' . $tag['Name'] . '</option>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Next</button>
            </div>
        </div>
    </form>
</div>
<div class="categories-add categories-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Add new category</h1>
            <form class="col-8 edit-member-form" method="post" action="?do=insert">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control form-control-lg" id="description" name="description" placeholder="">
                </div>
                <div class="form-group">
                    <label for="ordering">Ordering</label>
                    <input type="text" class="form-control form-control-lg" id="ordering" name="ordering">
                </div>
                <div class="form-group">
                    <label>Visibility</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visibility" id="visibility-yes" value="1">
                        <label class="form-check-label" for="visibility-yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visibility" id="visibility-no" value="0">
                        <label class="form-check-label" for="visibility-no">
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Allow comments</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="comments" id="comments-yes" value="1">
                        <label class="form-check-label" for="comments-yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="comments" id="comments-no" value="0">
                        <label class="form-check-label" for="comments-no">
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Allow ads</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ads" id="ads-yes" value="1">
                        <label class="form-check-label" for="ads-yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ads" id="ads-no" value="0">
                        <label class="form-check-label" for="ads-no">
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Add category</button>
                </div>
            </form>
        </div>
    </div>
</div>
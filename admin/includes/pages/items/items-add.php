<div class="items-add items-inner-content">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-center">Add new item</h1>
            <form class="col-8 edit-item-form" method="post" action="?do=insert">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control form-control-lg" id="username" name="username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" autocomplete="new-password" placeholder="" required>
                    <i class="fas fa-eye show-password hidden"></i>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="full-name">Full name</label>
                    <input type="text" class="form-control form-control-lg" id="full-name" name="full-name" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-inline-block btn-lg">Add member</button>
                </div>
            </form>
        </div>
    </div>
</div>
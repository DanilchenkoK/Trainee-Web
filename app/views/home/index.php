<div class="container">
    <table id="user-list" class="table text-center">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as  $user) : ?>
                <tr user="<?= $user['id'] ?>">
                    <td scope="row"> <?= $user['id'] ?> </td>
                    <td> <?= $user['first_name'] ?> </td>
                    <td> <?= $user['last_name'] ?> </td>
                    <td> <?= $user['email'] ?> </td>
                    <td> <?= str_replace("T", " ", $user['create_date']) ?> </td>
                    <td> <?= str_replace("T", " ", $user['update_date']) ?> </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" required name="first_name" class="form-control" id="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" required name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="create_date">Created at</label>
                        <input type="datetime-local" id="create_date" name="create_date" class="form-control" id="create_date">
                    </div>
                    <div class="form-group">
                        <label for="update_date">Updated at</label>
                        <input type="datetime-local" name="update_date" id="update_date" class="form-control" id="update_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
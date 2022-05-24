<div id="add-provest-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="my-modal-title">Add Provest Estate</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="my-select">Estate</label>
                                <select id="my-select" class="form-control" name="estate_id">
                                    <option selected disabled>Select estate</option>

                                    <?php $result = readEstateR($conn);?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" id="" aria-describedby="helpId"
                                    name="location" value="" placeholder="Enter location name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" class="form-control" name="amount" value="" id=""
                                    aria-describedby="helpId" placeholder="Enter estate amount" required>
                            </div>
                        </div>
                    </div>
                    <hr>


                    <button type="submit" name="submit_add_provest" class="btn btn-success float-right">Create</button>

                </form>
            </div>

        </div>
    </div>
</div>
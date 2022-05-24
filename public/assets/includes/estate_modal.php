<div id="add-estate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="my-modal-title">Add An Estate</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
                                    value="" placeholder="Enter name" required    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" class="form-control" name="location" id="" aria-describedby="helpId"
                                    name="location" value="" placeholder="Enter location">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" class="form-control" name="amount" value="" id=""
                                    aria-describedby="helpId" placeholder="Enter amount">
                            </div>
                        </div>
                    </div>
                    <hr>


                    <button type="submit" name="submit_add_estate" class="btn btn-success float-right">Create</button>

                </form>
            </div>

        </div>
    </div>
</div>

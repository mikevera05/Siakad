<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#announcement">
        Post Announcement
    </button>
    <!-- <div class="">
        <?= $this->session->flashdata('message'); ?>
    </div> -->
    <br><br>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card">
                <h5 class="card-header">Announcement</h5>
                <div class="card-body">
                    <!-- <p class="tab-content" hidden><?= $announ['id']; ?></p> -->
                    <?php foreach ($announ as $b) : ?>
                        <p class="tab-content"><?= $b->isi; ?></p>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<!-- /.container-fluid -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header">Teacher Rating</h5>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Message</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1; ?>
                                    <?php foreach ($student as $stu) : ?>
                                    <tr>
                                        <th scope="row"><?= $a; ?></th>
                                        <td><?= $stu['student_name']; ?></td>
                                        <td><?= $stu['subject']; ?></td>
                                        <td class="text-center"><?= $stu['rate']; ?>/5</td>
                                        <td><?= $stu['message']; ?></td>
                                        <!-- <td>
                                            <a href="" class="badge badge-danger">Delete<a>
                                        </td> -->
                                    </tr>
                                    <?php $a++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="announcement" tabindex="-1" aria-labelledby="announcement" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcement">Post New Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/index/'); ?>" method="post">
                <div class="form-group">
                    <div class="modal-body">
                        <!-- <input type="hidden" name="id" value=""> -->
                        <textarea class="form-control" required id="isi" name="isi" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Posting</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
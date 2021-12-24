<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="card col-lg-12">
        <div class="card-body">
            <form method="post" action="<?= base_url('Admin/tambahstud/'); ?>">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Teacher</label>
                    <div class="col-sm-2">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $user['name']; ?>">
                        <input type="hidden" name="hidden" class="form-control-plaintext" value="<?= $user['name']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-4">
                        <select name="pon" class="form-control " required >
                        <option value="">--SELECT--</option>
                                            <?php
                                            if (!empty($drd)) {
                                              foreach ($drd as $data) {
                                                ?>
                                                <option value="<?php echo $data->id_subject; ?>">
                                                  <?php echo $data->subject;?>
                                                </option>
                                                <?php }
                                              } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Student</label>
                    <div class="col-sm-4">
                        <select name="murid" class="form-control " required>
                        <option value="">--SELECT--</option>
                            <?php
                                if (!empty($murid)) {
                                foreach ($murid as $data) {
                            ?>
                        <option value="<?php echo $data->id; ?>">
                            <?php 
                                echo $data->name;
                            ?>
                        </option>
                        <?php }
                        } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Score</label>
                    <div class="col-sm-4">
                        <input type="number" min="0" name="score" class="form-control" required id="inputPassword">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                    <textarea type="text" name="noted" class="form-control" required id="exampleFormControlTextarea1"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-info">Save</button>
                <button type="reset" class="btn btn-outline-dark" value="Reset">Reset</button>
            </form>
            <br><br>
            <br>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Subjects</th>
                        <th scope="col">Score</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    <?php foreach ($student as $stu) : ?>
                        <tr>
                            <th scope="row"><?= $a; ?></th>
                            <td><?= $stu['id_user']; ?></td>
                            <td><?= $stu['nama']; ?></td>
                            <td><?= $stu['mata_kuliah']; ?></td>
                            <td><?= $stu['nilai']; ?></td>
                            <td><?= $stu['noted']; ?></td>
                            <td>
                            <a href="" data-toggle="modal" data-target="#updateSubject<?php echo $stu['id_penilaian']; ?>" class="badge badge-success">Edit</a>
                            <a href="" data-toggle="modal" data-target="#deleteSubject<?php echo $stu['id_penilaian']; ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $a++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Modal -->
<?php $a = 0;
foreach ($student as $s) : $a++; ?>
    <div class="modal fade" id="updateSubject<?= $s['id_penilaian']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateSubject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubjectModalLabel">Update Score</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/updatePenilaian/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Student ID</label>
                                    <input type="text" class="form-control" id="subject" readonly placeholder="Subject" value="<?= $s['id_user']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="hidden" placeholder="id_subject" value="<?= $s['id_penilaian']; ?>">
                                    <label class="control-label col-xs-3" >Name</label>
                                    <input type="text" class="form-control" id="subject" readonly placeholder="Subject" value="<?= $s['nama']; ?>">
                                    <small class="form-text text-danger">
                                        <?= form_error('subject'); ?>
                                    </small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label class="control-label col-xs-3" >Subject</label>
                                    <input type="text" class="form-control" id="subject" readonly placeholder="Subject" value="<?= $s['mata_kuliah']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label class="control-label col-xs-3" >Score</label>
                                    <input type="text" class="form-control" id="subject" name="nilai" placeholder="Score" value="<?= $s['nilai']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                    <label class="control-label col-xs-3" >Note</label>
                                    <input type="text" class="form-control" id="subject" name="noted" placeholder="Note" value="<?= $s['noted']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php $a = 0;
foreach ($student as $s) : $a++; ?>
    <div class="modal fade" id="deleteSubject<?= $s['id_penilaian']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateSubject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubjectModalLabel">Delete Score</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/deletePenilaian/'); ?>" method="post">
                <input type="hidden" class="form-control" name="hidden" placeholder="id_subject" value="<?= $s['id_penilaian']; ?>">
                                    
                    <div class="modal-body">
                        <font size="3">Are you sure want to delete?</font>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
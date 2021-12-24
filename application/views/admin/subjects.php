<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubjectModal">Add New Subject</a>
    <div class="card col-lg-8">
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <?= $this->session->flashdata('message'); ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 1; ?> 
                            
                            <?php foreach ($subjects as $s) : ?>
                                <tr>
                                    <th scope="row"><?= $a; ?></th>
                                    <td><?= $s['subject']; ?></td>
                                    <td><?= $s['name']; ?></td>
                                    <td>
                                        <!-- <a href="<?= base_url('admin/updateSubject/'); ?><?= $s['id_subject']; ?>" data-toggle="modal" data-target="#updateSubject<?= $s['id_subject']; ?>" class="badge badge-success">Edit</a> -->
                                        <a href="<?= base_url('admin/deleteSubject/'); ?><?= $s['id_subject']; ?>" onclick="return confirm('Yakin Menghapus subject <?= $s['subject']; ?>?');" class="badge badge-danger">Delete</a>
                                    </td>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="newSubjectModal" tabindex="-1" role="dialog" aria-labelledby="newSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/subjects/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                        <small class="form-text text-danger">
                            <?= form_error('title'); ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <select name="id_teacher" id="id_teacher" class="form-control">
                            <option value="">Select Teacher</option>
                            <?php foreach ($sub as $su) : ?>
                                <option value="<?= $su->id; ?>"><?= $su->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $a = 0;
foreach ($subjects as $s) : $a++; ?>
    <div class="modal fade" id="updateSubject<?= $s['id_subject']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateSubject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubjectModalLabel">Update Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/updateSubject/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_subject" placeholder="id_subject" value="<?= $s['id_subject']; ?>">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="<?= $s['subject']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('subject'); ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <select name="id_teacher" id="id_teacher" class="form-control">
                                <option value="">Select Teacher</option>
                                <?php foreach ($subjects as $su) : ?>
                                    <option value="<?= $su['id']; ?>"><?= $su['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
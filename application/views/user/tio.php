<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
        
    <?= $this->session->flashdata('message'); ?>
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Teacher Name</th>
                            <th scope="col">Subjects</th>
                            <th scope="col">Score</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $a = 1; ?>
                        <?php foreach ($penilaian as $stu) : ?>
                            <tr>
                                <th scope="row"><?= $a; ?></th>
                                <td><?= $stu['id_user']; ?></td>
                                <td><?= $stu['teacher_name']; ?></td>
                                <td><?= $stu['mata_kuliah']; ?></td>
                                <td><?= $stu['nilai']; ?></td>
                                <td><?= $stu['noted']; ?></td>
                            </tr>
                            <?php $a++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <a href="" data-toggle="modal" data-target="#updateSubject" class="btn btn-md btn-info">Write Satisfaction Score</a>
    </div>
</div>

    <div class="modal fade" id="updateSubject" tabindex="-1" role="dialog" aria-labelledby="updateSubject" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubjectModalLabel">Student Satisfaction Score</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/sendPenilaianGuru/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   
                                    <select name="pon" class="form-control " required >
                                            <option value="">--Choose a Course--</option>
                                            <?php
                                            if (!empty($drd)) 
                                            {
                                              foreach ($drd as $data) 
                                              {
                                                ?>
                                                <option value="<?php echo $data->mata_kuliah; ?>">
                                                  <?php echo $data->mata_kuliah;?>
                                                </option>
                                                <?php 
                                              }
                                            } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-xs-1" >Rating :</label>&nbsp;
                                    <label><input type="radio" name="rating" value="1" required> 1 (very bad)</label>
                                    <p><input type="radio" name="rating" value="2" required> 2 (bad)</p>
                                    <p><input type="radio" name="rating" value="3" required> 3 (neutral)</p>
                                    <p><input type="radio" name="rating" value="4" required> 4 (good)</p>
                                    <p><input type="radio" name="rating" value="5" required> 5 (very good)</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-xs-1" >Message (Optional) :</label>
                                <textarea name="pesan" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- /.container-fluid -->
<!-- End of Main Content -->
<!-- Modal -->

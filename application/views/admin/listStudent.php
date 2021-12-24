<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card col-lg">
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    <?php foreach ($student as $stu) : ?>
                        <tr>
                            <th scope="row"><?= $a; ?></th>
                            <td><?= $stu['student_id']; ?></td>
                            <td><?= $stu['name']; ?></td>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
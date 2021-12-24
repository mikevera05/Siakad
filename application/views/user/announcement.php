<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-8">
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
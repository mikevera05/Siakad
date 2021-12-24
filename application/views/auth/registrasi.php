<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" method="post" action="<?= base_url('auth/registrasi'); ?>">
                            <div class="form-group">
                                <!-- set_values -> biar user ga input dari awal kalo salah -->
                                <input type="text" class="form-control form-control-user" required id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>" autofocus>
                                <!-- pl-3 = padding left -->
                                <!-- <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?> -->
                            </div>
                            <!-- <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio1" value="1" method="get">
                                    <label class="form-check-label" for="inlineRadio1">Teacher</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio2" value="0" method="get">
                                    <label class="form-check-label" for="inlineRadio2">Student</label>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['radioButton']) == 1) {
                                echo "hore";
                            } else {
                                echo "error";
                            }
                            ?> -->
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" required id="id" name="id" placeholder="ID <?= (empty($type)) ? "" : $type; ?>" value="<?= set_value('id'); ?>">
                             <?= form_error('Student_id', '<small class="text-danger pl-3">', '</small>'); ?> 
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" required id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" required id="pass1" name="Pass1" placeholder="Password">
                                   <?= form_error('Pass1', '<small class="text-danger pl-3">', '</small>'); ?> 
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" required id="pass2" name="Pass2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="role" class="form-control select2" required >
                                    <option value=""><font size="">As :</font></option>
                                    <option value="2">Student</option>
                                    <option value="1">Teacher</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/forgotPasw'); ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
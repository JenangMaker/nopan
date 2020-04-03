<?= $this->extend('main\index') ?>

<?= $this->section('content') ?>
    <?= $this->include('partial\navbar') ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Input Jadwal
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('/jadwal');?>" method="post">
                            <label for="exampleInputEmail1">Pilih jangka waktu yang diinginkan</label>
                            <input type="text" name="daterange" value="" />
                            <div id="apaan">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
<?= $this->extend('main\index') ?>

<?= $this->section('content') ?>
    <?= $this->include('partial\navbar') ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Jadwal
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="<?php echo base_url('jadwal/new')?>" role="button">Input Jadwal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
<div class="container" style="margin-top:20px;">
    <?php if (session()->getFlashdata('success') !== NULL) : ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('success'); ?>
        </div>

    <?php endif; ?>

    

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <h1>Hola, <?= session()->get('nombre') ?></h1>

                <h3><a href="<?= site_url('logout') ?>">Salir</a></h3>

            </div>

        </div>

    </div>



    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <?php if (isset($validation)) : ?>

                    <div class="col-12">

                        <div class="alert alert-danger" role="alert">

                            <?= $validation->listErrors() ?>

                        </div>

                    </div>

                <?php endif; ?>

                <form class="" action="/login" method="post">

                <?= csrf_field()?>

                    <div class="form-group">

                        <label for="email">Email</label>

                        <input type="email" class="form-control" name="email" id="email">

                    </div>

                    <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" class="form-control" name="password" id="password">

                    </div>

                    <button type="submit" class="btn btn-success">Entrar</button>

                </form>

            </div>

        </div>

    </div>

</div>
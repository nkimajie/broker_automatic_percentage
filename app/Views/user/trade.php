<?= $this->extend('user/layouts/default'); ?>

<?= $this->section('content') ?>


<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Live Trade</h4>
            
        </div>
        <div class="card-body">
            <div class="card-block card-dashboard">
                <p>Study the market in real time</p>
                <div class="table-responsive">
                    <script type="text/javascript" async="" src="https://widgets.cryptocompare.com/serve/v3/coin/chart?fsym=BTC&amp;tsyms=USD,EUR,CNY,GBP&amp;app=localhost"></script>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
if(!empty(Yii::$app->user->identity)){
$user_type = Yii::$app->user->identity->TYPE;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            (!Yii::$app->user->isGuest && $user_type == 'Admin') ? ['label' => 'Users', 'url' => ['/user']] : '',
            (!Yii::$app->user->isGuest && $user_type == 'Admin') ? ['label' => 'Manage Coach', 'url' => ['/mastercoach']] : '',
            (!Yii::$app->user->isGuest && $user_type == 'Admin') ? ['label' => 'Manage Seats', 'url' => ['/masterseat']] : '',
            (!Yii::$app->user->isGuest && $user_type == 'Admin') ? ['label' => 'User Bookings', 'url' => ['/booking']] : '',
            (!Yii::$app->user->isGuest && $user_type == 'User') ? ['label' => 'My Booking', 'url' => ['/booking']] : '',
           Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $(function(){
        $("#userbookings-journey_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    });
    $('#userbookings-no_of_persons').on('change','',function() {
        $('#booking-details').hide();
        $('#user_details').html('');
        var i;
        var no_of_persons = $(this).val();
        if(no_of_persons <= 7){
            var html = '';
            for(i=1; i <= no_of_persons; i++){
                html += '<div class="add_user_details"><div class="col-md-3"><input type="text" id="UserBookingsDetails-full_name" class="form-control" required placeholder="Enter full name" name="UserBookingsDetails[full_name][]" maxlength="255" aria-required="true"></div><div class="col-md-3"><input type="number" required placeholder="Enter Age" id="UserBookingsDetails-age" class="form-control" name="UserBookingsDetails[age][]" maxlength="255" aria-required="true"></div><div class="col-md-3"><select id="UserBookingsDetails-proof_type" required class="form-control" name="UserBookingsDetails[proof_type][]"><option value="VOTER_CARD">Voter Id</option><option value="AADHAR_CARD">Aadhar Card</option><option value="PAN_CARD">Pan Card</option></select></div><div class="col-md-3"><input required placeholder="Enter Proof" type="text" id="UserBookingsDetails-identityfication_number" class="form-control" name="UserBookingsDetails[identityfication_number][]" maxlength="255" aria-required="true"></div></div><div class="clearfix line_spacing"></div>';
            }           
        }else{
            html += "<p class='alert-danger alert'>No of persons should nopt exceed than 7.</p>";
        }
        $('#user_details').append(html);
        $('#booking-details').show();
    });
</script>
</body>
</html>
<?php $this->endPage() ?>

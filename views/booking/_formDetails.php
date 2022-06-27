<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserBookings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-bookings-form">
    <?php $form = ActiveForm::begin(); ?>
   
    <div id="booking-details">
        <h3>Add User details</h3>
        <div id="user_details">
            <?php foreach ($bookingDetails as $key => $value) { ?>
                <div class="add_user_details">
                    <div class="col-md-2"><input type="hidden" value = "<?= $value->id?>" id="UserBookingsDetails-id" class="form-control" required="" placeholder="Enter full name" name="UserBookingsDetails[id][]" maxlength="255" aria-required="true"><input value = "<?= $value->full_name?>" disabled type="text" id="UserBookingsDetails-full_name" class="form-control" required="" placeholder="Enter full name" name="UserBookingsDetails[full_name][]" maxlength="255" aria-required="true"></div>
                    <div class="col-md-2"><input value = "<?= $value->age?>" disabled type="number" required="" placeholder="Enter Age" id="UserBookingsDetails-age" class="form-control" name="UserBookingsDetails[age][]" maxlength="255" aria-required="true"></div>
                    <div class="col-md-2">
                        <select disabled id="UserBookingsDetails-proof_type" required="" class="form-control" name="UserBookingsDetails[proof_type][]">
                            <option <?= ($value->proof_type == 'VOTER_CARD') ? 'selected' : '' ?> value="VOTER_CARD">Voter Id</option>
                            <option <?= ($value->proof_type == 'AADHAR_CARD') ? 'selected' : '' ?> value="AADHAR_CARD">Aadhar Card</option>
                            <option <?= ($value->proof_type == 'PAN_CARD') ? 'selected' : '' ?> value="PAN_CARD">Pan Card</option>
                        </select>
                    </div>
                    <div class="col-md-2"><input value = "<?= $value->identityfication_number?>" disabled required="" placeholder="Enter Proof" type="text" id="UserBookingsDetails-identityfication_number" class="form-control" name="UserBookingsDetails[identityfication_number][]" maxlength="255" aria-required="true"></div>
                    <div class="col-md-4">
                        <select id="UserBookingsDetails-alloted_seat_no" required class="form-control" name="UserBookingsDetails[alloted_seat_no][]">
                            <option>Select Compartment/Seat No</option>
                            <?php foreach ($availableSeats as $seats => $val) {?>
                              <option value="<?= $val['seat_id']?> "><?= $val['coach_name'].'('.$val['seat_number'].')'?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="clearfix line_spacing"></div>
            <?php }?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

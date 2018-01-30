<div class="row outer-container shipping-address">
    <div class="col-md-9 order-panel">
        <h3><?= Yii::t('app', 'Shipping Address')?></h3>
        <div class="row first-row email_row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Email')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'email')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row first-row">
            <div class="col-md-4">
                Mobile
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'mobile_no')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Phone')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'phone_no')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'District')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'district')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Province')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'province')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Address')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'address')->textInput()->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Yii::t('app', 'Country')?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'country')->textInput()->label(false) ?>
            </div>
        </div>
    </div>
</div>
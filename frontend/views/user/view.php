<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    

   
<div class="container">
    <div class="row">
        
        <div class="col-md-7">
            <div class="other-details">
            <h3><strong><?php echo $model->first_name .'&nbsp;'. $model->last_name; ?></strong></h3>
            <ul class="profile_detail">
                <li><i class="fa fa-envelope"></i><?php echo $model->email; ?></li>
                <li><i class="fa fa-phone"></i> <?php echo $model->phone_no; ?></li>
                <li><i class="fa fa-globe"></i> <?php echo $model->link; ?></li>
                <li><i class="fa fa-level-up"></i> <?php echo $model->user_level_id; ?></li>
                <li><i class="fa fa-home"></i> <?php echo $model->city; ?></li>
                <li><i class="fa fa-flag-o"></i> <?php echo $model->country; ?></li>
                <li><i class="fa fa-map-marker"></i> <?php echo $model->address; ?></li>
                <li><i class="fa fa-external-link" aria-hidden="true"></i><?= Yii::$app->homeUrl; ?>/order/create?id=<?= $model->id ?></li>
            </ul>
        </div>
    </div>
    <div class="col-md-5">

            <div class="profile2">
                <center><img src="<?= Yii::$app->homeUrl; ?>images/avatar-1.png" class="img-circle img-inline add-border" height="200"></center><br/>

                <div class="username"><strong>@ <?php echo $model->username; ?></strong><br/>
                    Member Since  <?php echo $model->created_at; ?>
                </div>
            </div>
      
    </div>
</div>
</div>
   <div class="row">
    <div class="col-md-7 col-btn">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
</div>

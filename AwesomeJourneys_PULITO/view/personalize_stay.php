<?php $user = unserialize($_SESSION['utente']); ?>
<?php 
include_once 'partials/_login.php';
include_once 'partials/_personalmenu.php' 
?>

<a href="index.php?op=searchActivities&idStay=<?php echo $this->model->getId(); ?>">Cerca altre attivit&agrave;</a>
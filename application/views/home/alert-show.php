<div id="content">
    <?php if (isset($alertSuccess)) : ?>
        <div class="alert alert-success"><?php echo $alertSuccess; ?></div>
    <?php endif; ?>
    <?php if (isset($alertInfo)) : ?>
        <div class="alert alert-info"><?php echo $alertInfo; ?></div>
    <?php endif; ?>
    <?php if (isset($alertWarning)) : ?>
        <div class="alert alert-warning"><?php echo $alertWarning; ?></div>
    <?php endif; ?>
    <?php if (isset($alertDanger)) : ?>
        <div class="alert alert-danger"><?php echo $alertDanger; ?></div>
    <?php endif; ?>
</div>
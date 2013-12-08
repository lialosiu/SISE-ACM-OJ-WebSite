<div id="content" class="container">
    <h2 class="text-center">常用软件下载</h2>
    <hr/>
    <div>
        <?php if (isset($SoftwareNameList)) : ?>
            <ul>
                <?php foreach ($SoftwareNameList as $thisSoftwareName): ?>
                    <li>
                        <a href="<?php echo base_url('public/software/' . $thisSoftwareName); ?>"><?php echo $thisSoftwareName; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
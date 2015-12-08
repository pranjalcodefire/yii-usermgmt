<?php $this->title = "Loaded Actions"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4><?php echo $this->title; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach ($allFunctionList as $key => $value) {
                echo '<h5>' . $value['name'] . '</h5>';
            }
            ?>
        </div>
    </div>

</div>
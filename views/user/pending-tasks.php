<style>
.edit_pro_h{ margin-bottom:0px;}
.r_padding_topp22{ min-width:350px; overflow:auto;}
</style>

<?php $notEditableFields = unserialize(NOT_EDITABLE_FIELDS); ?>
<div class="container">
    <div class="radius_box pending_boxspace">
        <div class="row">       
            <div class="col-md-6 scrollTbl">
                <?php echo $this->render("@frontend/views/shared/tiles/pending-lender-approvals", ['results' => $pendingLenderApprovals]);?>
            </div>
            <div class="col-md-6 scrollTbl">
                <?php echo $this->render("@frontend/views/shared/tiles/pending-borrower-approvals", ['results' => $pendingBorrowerApprovals]);?>
            </div>
        </div>
        <div class="row">       
            <div class="col-md-6 scrollTbl">
                <?php echo $this->render("@frontend/views/shared/tiles/pending-loan-approvals", ['results' => $pendingLoanApprovals]);?>
            </div>
        </div>
    </div>
</div>

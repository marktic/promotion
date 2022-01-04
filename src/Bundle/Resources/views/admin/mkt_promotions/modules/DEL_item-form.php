<?php

$form = $this->form;
$renderer = $form->getRenderer();
?>

<?php echo $renderer->openTag(); ?>
<?php echo $renderer->renderHidden(); ?>

<?php echo $renderer->renderMessages(); ?>
<?php echo $renderer->renderRow($form->name); ?>
<?php echo $form->hasElement('code') ? $renderer->renderRow($form->code) : ''; ?>

<?php echo $renderer->renderRow($form->quantity); ?>
<?php echo $form->hasElement('uses') ? $renderer->renderRow($form->uses) : ''; ?>
<?php echo $renderer->renderRow($form->type); ?>
<?php echo $renderer->renderRow($form->cumulative); ?>

    <div class="form-group row row-amount">
        <label class="col-form-label col-sm-3">
            <?php echo translator()->trans('amount'); ?>
        </label>
        <div class="col-sm-9">
            <div class="row">
                <?php foreach ($this->currencies as $currency) { ?>
                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            <?php
                            $amountBase = 'amounts[' . $currency->code . ']'; ?>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <?php echo $currency->code; ?>:
                                </span>
                            </div>
                            <?php
                            echo $form->getElement($amountBase)
                                ->addClass('form-control form-control-sm')
                                ->getRenderer()->renderElement(); ?>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>

    <div class="form-group row row-entries_start">
        <label class="col-form-label col-sm-3">
            <?php
            echo translator()->trans('date_start'); ?>
        </label>
        <div class="col-sm-3">
            <?php
            echo $renderer->renderElement($form->date_start); ?>
        </div>
        <label class="col-form-label col-sm-3">
            <?php
            echo translator()->trans('date_end'); ?>
        </label>
        <div class="col-sm-3">
            <?php
            echo $renderer->renderElement($form->date_end); ?>
        </div>
    </div>

<?php
if ($form->hasElement('min_group')) { ?>
    <div class="form-group row row-entries_start">
        <label class="col-form-label col-sm-3">
            <?php echo translator()->trans('min_group'); ?>
        </label>
        <div class="col-sm-3">
            <?php echo $renderer->renderElement($form->min_group); ?>
        </div>
        <label class="control-label col-sm-3">
            <?php echo translator()->trans('max_group'); ?>
        </label>
        <div class="col-sm-3">
            <?php echo $renderer->renderElement($form->max_group); ?>
        </div>
    </div>
<?php } ?>

<?php echo $renderer->renderButtons(); ?>
<?php echo $renderer->closeTag(); ?>
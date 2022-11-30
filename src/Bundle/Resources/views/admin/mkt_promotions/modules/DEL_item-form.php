<?php declare(strict_types=1);

use Nip\Form\AbstractForm;
use Nip\View\View;

/* @var View $this */
/* @var AbstractForm $form */
$form = $this->get('form');
$renderer = $form->getRenderer();
$currencies = $this->get('currencies');
?>

<?= $renderer->openTag(); ?>
<?= $renderer->renderHidden(); ?>

<?= $renderer->renderMessages(); ?>
<?= $renderer->renderRow($form->name); ?>
<?= $form->hasElement('code') ? $renderer->renderRow($form->code) : ''; ?>

<?= $renderer->renderRow($form->quantity); ?>
<?= $form->hasElement('uses') ? $renderer->renderRow($form->uses) : ''; ?>
<?= $renderer->renderRow($form->type); ?>
<?= $renderer->renderRow($form->cumulative); ?>

    <div class="form-group row row-amount">
        <label class="col-form-label col-sm-3">
            <?= translator()->trans('amount'); ?>
        </label>
        <div class="col-sm-9">
            <div class="row">
                <?php foreach ($currencies as $currency) { ?>
                    <div class="col-sm-3">
                        <div class="input-group input-group-sm">
                            <?php
                            $amountBase = 'amounts[' . $currency->code . ']'; ?>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <?= $currency->code; ?>:
                                </span>
                            </div>
                            <?= $form->getElement($amountBase)
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
            <?= translator()->trans('date_start'); ?>
        </label>
        <div class="col-sm-3">
            <?= $renderer->renderElement($form->date_start); ?>
        </div>
        <label class="col-form-label col-sm-3">
            <?= translator()->trans('date_end'); ?>
        </label>
        <div class="col-sm-3">
            <?= $renderer->renderElement($form->date_end); ?>
        </div>
    </div>

<?php
if ($form->hasElement('min_group')) { ?>
    <div class="form-group row row-entries_start">
        <label class="col-form-label col-sm-3">
            <?= translator()->trans('min_group'); ?>
        </label>
        <div class="col-sm-3">
            <?= $renderer->renderElement($form->min_group); ?>
        </div>
        <label class="control-label col-sm-3">
            <?= translator()->trans('max_group'); ?>
        </label>
        <div class="col-sm-3">
            <?= $renderer->renderElement($form->max_group); ?>
        </div>
    </div>
<?php } ?>

<?= $renderer->renderButtons(); ?>
<?= $renderer->closeTag(); ?>
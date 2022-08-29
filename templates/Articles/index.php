<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
$this->Html->script('bootstrapModal', ['block' => true]);
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>

<?php $this->Html->setTemplates([
    'confirmJs' => 'return false;'
]); ?>

<li><?= $this->Html->link(
        __('Confirm Link'),
        ['action' => 'index', uniqid('link')],
        [
            'confirm' => 'Do you want to go to this page again?',
            'class' => 'nav-link',
            'data-bs-toggle' => "modal",
            'data-bs-target' => "#bootstrapModal"
        ]
    ) ?></li>

<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id], ['title' => __('View'), 'class' => 'btn btn-secondary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id], ['title' => __('Edit'), 'class' => 'btn btn-secondary']) ?>

                    <?php $this->Form->setTemplates([
                        'confirmJs' => 'addToModal("{{formName}}"); return false;'
                    ]); ?>

                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $article->id],
                        [
                            'confirm' => __('Are you sure you want to delete title "{0}"?', $article->title),
                            'title' => __('Delete'),
                            'class' => 'btn btn-danger',
                            'data-bs-toggle' => "modal",
                            'data-bs-target' => "#bootstrapModal"
                        ]
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
        <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>

<div class="modal" id="bootstrapModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="ok">OK</button>
            </div>
        </div>
    </div>
</div>
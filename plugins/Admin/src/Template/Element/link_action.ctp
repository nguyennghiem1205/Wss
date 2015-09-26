<?php
if (!isset($view) || $view) {
    echo $this->Html->link('<i class="fa fa-eye"></i> ', ['action' => 'view', $item->id], ['title' => __('view'),'escape' => false, 'class' => 'btn btn-sm btn-default'] );
}
if (!isset($edit) || $edit) {
    echo '&nbsp;'.$this->Html->link('<i class="fa fa-edit"></i> ', ['action' => 'add', $item->id], ['title' => __('edit'),'escape' => false, 'class' => 'btn btn-sm btn-default'] );
}
echo '&nbsp;'.$this->Form->postLink('<i class="fa fa-trash-o"></i> ', ['action' => 'delete', $item->id], ['title' => __('delete'), 'data-action' => 'deleteLin', 'data-delete-msg' => __('are you sure you want to delete # {0}', $item->id), 'class' => 'btn btn-sm btn-default deleteLin', 'escape' => false]);

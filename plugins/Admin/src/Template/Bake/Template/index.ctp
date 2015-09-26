<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(7);
%>
<?php $this->Html->addCrumb(__('<%= $pluralHumanName %>')); ?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('<%= $singularHumanName %>');?>
            <span>&gt;
                <?= __('List of <%= $singularHumanName %>')?>
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-editbutton="true">
            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2><?= __('List of <%= $singularHumanName %>')?></h2>
            </header>
            <!-- widget div-->
            <div>
                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                    <% foreach ($fields as $field): %>
                        <th class="hasinput"><input type="text" class="form-control" placeholder="Filter <%= $field %>" /></th>
                    <% endforeach; %>
                        <th class="hasinput" ></th>
                        </tr>
                        <tr>
                    <% foreach ($fields as $field): %>
                        <th><?= __('<%= $field %>') ?></th>
                    <% endforeach; %>
                        <th width="13%"><?php echo __('actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                            <tr>
<%                            foreach ($fields as $field) {
                                $isKey = false;
                                    if (!empty($associations['BelongsTo'])) {
                                        foreach ($associations['BelongsTo'] as $alias => $details) {
                                            if ($field === $details['foreignKey']) {
                                                $isKey = true;
%>
                                <td>
                                    <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
                                </td>
<%
                                            break;
                                        }
                                    }
                                }
                                if ($isKey !== true) {
                                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
%>
                                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                                    } else {
%>
                                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                                    }
                                }
                            }

                            $pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
                                <td>
                                    <?= $this->Html->link('<i class="fa fa-eye"></i> ', array('action' => 'view', <%= $pk %>), array('title' => __('view'),'escape' => false, 'class' => 'btn btn-sm btn-default') );?>
                                    <?= $this->Html->link('<i class="fa fa-edit"></i> ', array('action' => 'edit', <%= $pk %>), array('title' => __('edit'),'escape' => false, 'class' => 'btn btn-sm btn-default') ); ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i> ', ['action' => 'delete', <%= $pk %>], ['data-action' => 'deleteLin', 'data-delete-msg' => __('are you sure you want to delete # {0}', <%= $pk %>), 'class' => 'btn btn-sm btn-default deleteLin', 'escape' => false]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
    </article>
    <!-- WIDGET END -->
</div>
<script>
    $(document).ready(function(){
        $('.onoffswitch-checkbox').click(function(){
            $(this).parents('form').submit();
        })
    })
</script>

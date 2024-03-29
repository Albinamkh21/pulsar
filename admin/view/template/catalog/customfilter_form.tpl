<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-customfilter" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customfilter" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <?php foreach ($languages as $language) { ?>
              <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                <input type="text" name="customfilter_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($customfilter_description[$language['language_id']]) ? $customfilter_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" class="form-control" />
              </div>
              <?php if (isset($error_name[$language['language_id']])) { ?>
              <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-attribute-group"><?php echo $entry_filter_group; ?></label>
            <div class="col-sm-10">
              <select name="customfilter_group_id" id="input-attribute-group" class="form-control">
                <?php foreach ($customfilter_groups as $customfilter_group) { ?>
                <?php if ($customfilter_group['customfilter_group_id'] == $customfilter_group_id) { ?>
                <option value="<?php echo $customfilter_group['customfilter_group_id']; ?>" selected="selected"><?php echo $customfilter_group['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $customfilter_group['customfilter_group_id']; ?>"><?php echo $customfilter_group['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <?php if ($error_customfilter_group) { ?>
              <div class="text-danger"><?php echo $error_customfilter_group; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_type; ?></label>
            <div class="col-sm-10">
              <select name="type" id="input-type" class="form-control">
                <optgroup label="<?php echo $text_choose; ?>">
                <?php if ($type == 'select') { ?>
                <option value="select" selected="selected"><?php echo $text_select; ?></option>
                <?php } else { ?>
                <option value="select"><?php echo $text_select; ?></option>
                <?php } ?>
                <?php if ($type == 'radio') { ?>
                <option value="radio" selected="selected"><?php echo $text_radio; ?></option>
                <?php } else { ?>
                <option value="radio"><?php echo $text_radio; ?></option>
                <?php } ?>
                <?php if ($type == 'checkbox') { ?>
                <option value="checkbox" selected="selected"><?php echo $text_checkbox; ?></option>
                <?php } else { ?>
                <option value="checkbox"><?php echo $text_checkbox; ?></option>
                <?php } ?>
                <?php if ($type == 'image') { ?>
                <option value="image" selected="selected"><?php echo $text_image; ?></option>
                <?php } else { ?>
                <option value="image"><?php echo $text_image; ?></option>
                <?php } ?>
                </optgroup>
                <optgroup label="<?php echo $text_input; ?>">
                <?php if ($type == 'text') { ?>
                <option value="text" selected="selected"><?php echo $text_text; ?></option>
                <?php } else { ?>
                <option value="text"><?php echo $text_text; ?></option>
                <?php } ?>
                <?php if ($type == 'textarea') { ?>
                <option value="textarea" selected="selected"><?php echo $text_textarea; ?></option>
                <?php } else { ?>
                <option value="textarea"><?php echo $text_textarea; ?></option>
                <?php } ?>
                </optgroup>
                <optgroup label="<?php echo $text_file; ?>">
                <?php if ($type == 'file') { ?>
                <option value="file" selected="selected"><?php echo $text_file; ?></option>
                <?php } else { ?>
                <option value="file"><?php echo $text_file; ?></option>
                <?php } ?>
                </optgroup>
                <optgroup label="<?php echo $text_date; ?>">
                <?php if ($type == 'date') { ?>
                <option value="date" selected="selected"><?php echo $text_date; ?></option>
                <?php } else { ?>
                <option value="date"><?php echo $text_date; ?></option>
                <?php } ?>
                <?php if ($type == 'time') { ?>
                <option value="time" selected="selected"><?php echo $text_time; ?></option>
                <?php } else { ?>
                <option value="time"><?php echo $text_time; ?></option>
                <?php } ?>
                <?php if ($type == 'datetime') { ?>
                <option value="datetime" selected="selected"><?php echo $text_datetime; ?></option>
                <?php } else { ?>
                <option value="datetime"><?php echo $text_datetime; ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_compare_with; ?></label>
            <div class="col-sm-10">
              <select name="compare_id" id="input-type" class="form-control">
                <optgroup label="<?php echo $text_choose; ?>">
                  <?php foreach($compares as $compare) { ?>
                    <?php if ($customfilter_description[$language['language_id']]['compare_id'] == $compare['compare_id']) { ?>
                    <option value="<?=$compare['compare_id'] ?>" selected="selected"><?php echo $compare['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?=$compare['compare_id'] ?>" ><?php echo $compare['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </optgroup>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-type"><?php echo $entry_compare_method; ?></label>
            <div class="col-sm-10">
              <select name="compare_method" id="input-type" class="form-control">
                <optgroup label="<?php echo $text_choose; ?>">
                  <?php if ($customfilter_description[$language['language_id']]['compare_method'] == 'text') { ?>
                  <option value="text" selected="selected"><?php echo $compare_method_text; ?></option>
                  <?php } else { ?>
                  <option value="text"><?php echo $compare_method_text; ?></option>
                  <?php } ?>
                  <?php if ($customfilter_description[$language['language_id']]['compare_method'] == 'int') { ?>
                  <option value="int" selected="selected"><?php echo $compare_method_int; ?></option>
                  <?php } else { ?>
                  <option value="int"><?php echo $compare_method_int; ?></option>
                  <?php } ?>
                  <?php if ($customfilter_description[$language['language_id']]['compare_method'] == 'select') { ?>
                  <option value="select" selected="selected"><?php echo $compare_method_select; ?></option>
                  <?php } else { ?>
                  <option value="select"><?php echo $compare_method_select; ?></option>
                  <?php } ?>
                </optgroup>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
          <table id="customfilter-value" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left required"><?php echo $entry_customfilter_value; ?></td>
                <td class="text-left"><?php echo $entry_image; ?></td>
                <td class="text-right"><?php echo $entry_sort_order; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $customfilter_value_row = 0; ?>
              <?php foreach ($customfilter_values as $customfilter_value) { ?>
              <tr id="customfilter-value-row<?php echo $customfilter_value_row; ?>">
                <td class="text-left"><input type="hidden" name="customfilter_value[<?php echo $customfilter_value_row; ?>][customfilter_value_id]" value="<?php echo $customfilter_value['customfilter_value_id']; ?>" />
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="customfilter_value[<?php echo $customfilter_value_row; ?>][customfilter_value_description][<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($customfilter_value['customfilter_value_description'][$language['language_id']]) ? $customfilter_value['customfilter_value_description'][$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_customfilter_value; ?>" class="form-control" />
                  </div>
                  <?php if (isset($error_customfilter_value[$customfilter_value_row][$language['language_id']])) { ?>
                  <div class="text-danger"><?php echo $error_customfilter_value[$customfilter_value_row][$language['language_id']]; ?></div>
                  <?php } ?>
                  <?php } ?></td>
                <td class="text-left"><a href="" id="thumb-image<?php echo $customfilter_value_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $customfilter_value['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="customfilter_value[<?php echo $customfilter_value_row; ?>][image]" value="<?php echo $customfilter_value['image']; ?>" id="input-image<?php echo $customfilter_value_row; ?>" /></td>
                <td class="text-right"><input type="text" name="customfilter_value[<?php echo $customfilter_value_row; ?>][sort_order]" value="<?php echo $customfilter_value['sort_order']; ?>" class="form-control" /></td>
                <td class="text-left"><button type="button" onclick="$('#customfilter-value-row<?php echo $customfilter_value_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $customfilter_value_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td class="text-left"><button type="button" onclick="addCustomFilterValue();" data-toggle="tooltip" title="<?php echo $button_customfilter_value_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('select[name=\'type\']').on('change', function() {
	if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox' || this.value == 'image') {
		$('#customfilter-value').hide();
	} else {
		$('#customfilter-value').hide();
	}
});

$('select[name=\'type\']').trigger('change');

var customfilter_value_row = <?php echo $customfilter_value_row; ?>;

function addCustomFilterValue() {
	html  = '<tr id="customfilter-value-row' + customfilter_value_row + '">';
    html += '  <td class="text-left"><input type="hidden" name="customfilter_value[' + customfilter_value_row + '][customfilter_value_id]" value="" />';
	<?php foreach ($languages as $language) { ?>
	html += '    <div class="input-group">';
	html += '      <span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span><input type="text" name="customfilter_value[' + customfilter_value_row + '][customfilter_value_description][<?php echo $language['language_id']; ?>][name]" value="" placeholder="<?php echo $entry_customfilter_value; ?>" class="form-control" />';
    html += '    </div>';
	<?php } ?>
	html += '  </td>';
    html += '  <td class="text-left"><a href="" id="thumb-image' + customfilter_value_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="customfilter_value[' + customfilter_value_row + '][image]" value="" id="input-image' + customfilter_value_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="customfilter_value[' + customfilter_value_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#customfilter-value-row' + customfilter_value_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';	
	
	$('#customfilter-value tbody').append(html);
	
	customfilter_value_row++;
}
//--></script></div>
<?php echo $footer; ?>
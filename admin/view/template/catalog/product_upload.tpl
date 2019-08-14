<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-download" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form  action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-download" class="form-horizontal">
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-filename"><span data-toggle="tooltip" title="<?php echo $help_filename; ?>"><?php echo $entry_filename; ?></span></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" name="filename" value="<?php echo $filename; ?>" placeholder="<?php echo $entry_filename; ?>" id="input-filename" class="form-control" />

                                <span class="input-group-btn">
                <button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                </span> </div>
                            <?php if ($error_filename) { ?>
                            <div class="text-danger"><?php echo $error_filename; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <button type="button"  id="btn-upload"?> Загрузить</button>

                </form>

            </div>
        </div>
    </div>
    <script type="text/javascript"><!--
        $('#button-upload').on('click', function() {
           $('#form-upload').remove();
           $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

            $('#form-upload input[name=\'file\']').trigger('click');



            /*if (typeof timer != 'undefined') {
                clearInterval(timer);
            }
*/

        });
       // $('#button-upload').on('click', function() {
        $('#btn-upload').on('click', function() {

            console.log($('#form-upload input[name=\'file\']').val());
            console.log($('#form-upload')[0]);
            if ($('#form-upload input[name=\'file\']').val() != '') {
                //  clearInterval(timer);
              $.ajax({
                    url: 'index.php?route=catalog/product/upload&token=<?php echo $token; ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#button-upload').button('loading');
                    },
                    complete: function() {
                        $('#button-upload').button('reset');
                    },
                    success: function(json) {
                        console.log(json);
                        if (json['error']) {
                            alert(json['error']);
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $('input[name=\'filename\']').val(json['filename']);
                            $('input[name=\'mask\']').val(json['mask']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }

        });
        //--></script></div>
<?php echo $footer; ?>

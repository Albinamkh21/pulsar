<div class="side-bar col-md-3">
    <a href="#" id ="showFilterLink" class="show-filter__link" data-show = 1 >Показать фильтры</a>

    <div id="product_filter" class="product-filter "  >
        <?php if ($filters) { ?>
        <?php foreach ($filters as $filter) { ?>
        <?php if ($filter['type'] == 'select') { ?>
        <div class="brand-select">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <select name="<?php echo $filter['filter_id']; ?>" id="<?php echo $filter['filter_id']; ?>" class="selectpicker" data-live-search="true">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($filter['values'] as $filter_value) { ?>
                <option value="<?php echo $filter_value['filter_value_id']; ?>"><?php echo $filter_value['name']; ?> </option>
                <?php } ?>
            </select>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'radio') { ?>
        <div class="form-group">
             <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div id="<?=$filter['filter_id'] ?>">
                <?php foreach ($filter['values'] as $filter_value) { ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="<?=$filter['filter_id']; ?>" value="<?php echo $filter_value['filter_value_id']; ?>"  id="<?php echo $filter['filter_id']; ?>" />
                        <?php echo $filter_value['name']; ?>

                    </label>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'checkbox') { ?>
        <div class="form-group">
             <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div id="input-option<?php echo $filter['filter_id']; ?>">
                <?php foreach ($filter['values'] as $filter_value) { ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="<?php echo $filter['filter_id']; ?>[]" value="<?php echo $filter_value['filter_value_id']; ?>"  id="<?php echo $filter['filter_id']; ?>"/>
                        <?php echo $filter_value['name']; ?>

                    </label>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'image') { ?>
        <div class="form-group">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div id="input-option<?php echo $filter['filter_id']; ?>">
                <?php foreach ($filter['values'] as $filter_value) { ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="option[<?php echo $filter['filter_id']; ?>]" value="<?php echo $filter_value['filter_value_id']; ?>" />
                        <img src="<?php echo $filter_value['image']; ?>" alt="<?php echo $filter_value['name'] . ($filter_value['price'] ? ' ' . $filter_value['price_prefix'] . $filter_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $filter_value['name']; ?>
                        <?php if ($filter_value['price']) { ?>
                        (<?php echo $filter_value['price_prefix']; ?><?php echo $filter_value['price']; ?>)
                        <?php } ?>
                    </label>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'text') { ?>
            <?php if ($filter['compare_method'] == 'int') { ?>
                <div class="search-hotel">
                    <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
                    <input class ="number" type="text" name="<?=$filter['filter_id'] ?>_min" id="<?=$filter['filter_id']; ?>" value="<?php echo $filter['value']; ?>" data-direction = "min" placeholder ="от"  />
                    <input class ="number" type="text" name="<?=$filter['filter_id']; ?>_max" id="<?=$filter['filter_id']; ?>" value="<?php echo $filter['value']; ?>"  data-direction = "max" placeholder ="до"  />
                </div>
            <?php } else { ?>
                <div class="search-hotel">
                    <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
                    <input class = "text" type="text" name="<?=$filter['filter_id']; ?>" id="<?=$filter['filter_id']; ?>" value="" placeholder ="<?=$filter['name']; ?>"  />
                </div>
            <?php } ?>
        <?php } ?>
        <?php if ($filter['type'] == 'textarea') { ?>
        <div class="form-group">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <textarea name="option[<?php echo $filter['filter_id']; ?>]" rows="5" placeholder="<?php echo $filter['name']; ?>" id="<?php echo $filter['filter_id']; ?>" class="form-control"><?php echo $filter['value']; ?></textarea>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'file') { ?>
        <div class="form-group">
             <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <button type="button" id="button-upload<?php echo $filter['filter_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
            <input type="hidden" name="option[<?php echo $filter['filter_id']; ?>]" value="" id="<?php echo $filter['filter_id']; ?>" />
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'date') { ?>
        <div class="form-group">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div class="input-group date">
                <input type="text" name="<?php echo $filter['filter_id']; ?>" value="<?=date('Y-m-d')?>" data-date-format="YYYY-MM-DD" id="<?php echo $filter['filter_id']; ?>" class="form-control"   placeholder="<?php echo $entry_date_value; ?>" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'datetime') { ?>
        <div class="form-group">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div class="input-group datetime">
                <input type="text" name="option[<?php echo $filter['filter_id']; ?>]" value="<?=date('Y-m-d H:i:s')?>" data-date-format="YYYY-MM-DD HH:mm" id="<?php echo $filter['filter_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        </div>
        <?php } ?>
        <?php if ($filter['type'] == 'time') { ?>
        <div class="form-group">
            <h5 class="sear-head"><?php echo $filter['name']; ?></h5>
            <div class="input-group time">
                <input type="text" name="option[<?php echo $filter['filter_id']; ?>]" value="<?=date('H:i')?>" data-date-format="HH:mm" id="<?php echo $filter['filter_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
        </div>
        <?php } ?>
        <?php } ?>

            <div>
                <div>
                    <button onclick="product_filter.filter();" class="product-filter_find">Найти</button>
                </div>
                <div>
                    <button onclick="product_filter.clearFilter();" class="product-filter_find">Сбросить фильтры</button>
                </div>

            </div>
        <?php } ?>

    </div>


    <script type='text/javascript'>
        /*    var el_price_min = document.getElementById('price_min');
            var el_price_max = document.getElementById('price_max');
            var filters ={};
           filters.price_min =   el_price_min.value;
           filters.price_max =   el_price_max.value;
           /*el_price_min.addEventListener('change', function (e) {

               product_filter.commit(filters);
           });

           el_price_max.addEventListener('change', function (e) {

               product_filter.commit(filters);
           });

            //<![CDATA[
           /* $(window).load(function(){
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: 20000,
                    values: [ 1000, 11000 ],
                    slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                     var filters ={};
                     filters.price_min =   ui.values[0];
                     filters.price_max =   ui.values[1];
                     product_filter.commit(filters);
                    }
                });
                $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

            });//]]>
        */
    </script>


<!--
    <div class="featured-ads">
        <h2 class="sear-head fer">Featured Ads</h2>
        <div class="featured-ad">
            <a href="single.html">
                <div class="featured-ad-left">
                    <img src="images/f1.jpg" title="ad image" alt="" />
                </div>
                <div class="featured-ad-right">
                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                    <p>$ 450</p>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="featured-ad">
            <a href="single.html">
                <div class="featured-ad-left">
                    <img src="images/f2.jpg" title="ad image" alt="" />
                </div>
                <div class="featured-ad-right">
                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                    <p>$ 380</p>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="featured-ad">
            <a href="single.html">
                <div class="featured-ad-left">
                    <img src="images/f3.jpg" title="ad image" alt="" />
                </div>
                <div class="featured-ad-right">
                    <h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
                    <p>$ 560</p>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
-->
</div>
<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickDate: true,
        pickTime: false
    });

    $('.time').datetimepicker({
        pickDate: false,
        pickTime: true
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });


    $(document).ready(function () {
        var mySelect = $('#first-disabled2');

        $('#special').on('click', function () {
            mySelect.find('option:selected').prop('disabled', true);
            mySelect.selectpicker('refresh');
        });

        $('#special2').on('click', function () {
            mySelect.find('option:disabled').prop('disabled', false);
            mySelect.selectpicker('refresh');
        });

        $('#basic2').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
    });

//--></script>
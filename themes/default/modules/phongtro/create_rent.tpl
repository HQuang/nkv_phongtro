<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
	<div class="panel panel-primary">
		<div class="panel-heading text-uppercase">{LANG.ttcb}</div>
		<div class="panel-body">
			<p class="bg-alert" style="background: #D9534F; color: #fff; padding: 10px; font-size: 16px;">{LANG.info_tt}</p>
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<div class="col-sm-24 col-md-24">
					<label class="control-label"><strong>{LANG.title}</strong> <span class="red">(*)</span></label> <input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" placeholder="{LANG.plc_title}" />
				</div>
			</div>
			<!-- 			<div class="form-group"> -->
			<!-- 				<label class="control-label"><strong>{LANG.alias}</strong></label> -->
			<!-- 								<div class="col-sm-12 col-md-12"> -->
			<!-- 					<div class="input-group"> -->
			<!-- 						<input class="form-control" type="text" "alias" value="{ROW.alias}" id="id_alias" /> <span class="input-group-btn"> -->
			<!-- 							<button class="btn btn-default" type="button"> -->
			<!-- 								<i class="fa fa-refresh fa-lg" onclick="nv_get_alias('id_alias');">&nbsp;</i> -->
			<!-- 							</button> -->
			<!-- 						</span> -->
			<!-- 					</div> -->
			<!-- 				</div> -->
			<!-- 			</div> -->
			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.landlord}</strong> <span class="red">(*)</span></label> <input class="form-control" type="text" name="landlord" value="{ROW.landlord}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label> <input class="form-control" type="text" name="phone" value="{ROW.phone}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.cat_id}</strong> </label> <select class="form-control" name="cat_id">
						<!-- BEGIN: select_cat_id -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_cat_id -->
					</select>
				</div>
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.area}</strong> <span class="red">(*)</span></label> <input class="form-control" type="number" name="area" value="{ROW.area}" pattern="^[0-9]*$" oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" required="required" placeholder="{LANG.plc_area}" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.price}</strong> <span class="red">(*)</span></label> <input class="form-control" type="number" name="price" value="{ROW.price}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" placeholder="{LANG.plc_price}" />
				</div>
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.object_id}</strong></label> <select class="form-control" name="object_id">
						<!-- BEGIN: select_object_id -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_object_id -->
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading text-uppercase">{LANG.address}</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.province_id}</strong> <span class="red">(*)</span></label> <select class="form-control" name="province_id" id="province_id">
						<option value="">--- {LANG.choose_province} ---</option>
						<!-- BEGIN: select_province_id -->
						<option value="{OPTION.key}"{OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_province_id -->
					</select>
				</div>
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.district_id}</strong> <span class="red">(*)</span></label> <select class="form-control" name="district_id" id="district_id">
						<option value="">--- {LANG.choose_district} ---</option>
						
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.ward_id}</strong> <span class="red">(*)</span></label> <select class="form-control" name="ward_id" id="ward_id">
						<option value="">--- {LANG.choose_ward} ---</option>
						
					</select>
				</div>
				<div class="col-sm-12 col-md-12">
					<label class="control-label"><strong>{LANG.address}</strong> <span class="red">(*)</span></label> <input class="form-control" type="text" name="address" value="{ROW.address}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" placeholder="{LANG.plc_add}" />
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading text-uppercase">{LANG.ttmt}</div>
		<div class="panel-body">
			<div class="form-group">
				<p class="bg-success" style="padding: 10px; font-size: 14px;">{LANG.plc_note}</p>
				<div class="col-sm-24 col-md-24">
					<label class="control-label"><strong>{LANG.note}</strong> <span class="red">(*)</span></label>
					<textarea class="form-control" style="height: 100px;" cols="75" rows="5" name="note">{ROW.note}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading text-uppercase">{LANG.img}</div>
		<div class="panel-body">
			<p class="bg-success" style="padding: 10px; font-size: 14px;">{LANG.plc_img}</p>
			<div class="form-group">
				<div class="col-sm-24 col-md-24">
					<label class="control-label"><strong>{LANG.img}</strong></label>
					<div class="input-group">
						<input type="file" name="upload_fileupload" id="upload_fileupload" style="display: none" /> <input type="text" class="form-control" id="file_name" disabled> <span class="input-group-btn">
							<button class="btn btn-default" onclick="$('#upload_fileupload').click();" type="button">
								<em class="fa fa-folder-open-o fa-fix">&nbsp;</em> {LANG.file_selectfile}
							</button>
						</span>
					</div>
				</div>
				<div class="col-sm-24 col-md-24">
					<label class="control-label"><strong>{LANG.img_alt}</strong></label> <input class="form-control" type="text" name="img_alt" value="{ROW.img_alt}" />
				</div>
			</div>
		</div>
	</div>
	<div class="form-group text-center">
		<input class="btn btn-success" name="submit" type="submit" value="{LANG.save}" />
	</div>
</form>
<script src="http://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
<script type="text/javascript">
	//<![CDATA[
	webshims.setOptions('forms-ext', {
		replaceUI : 'auto',
		types : 'number'
	});
	webshims.polyfill('forms forms-ext');

	function nv_get_alias(id) {
		var title = strip_tags($("[name='title']").val());
		if (title != '') {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name
					+ '&' + nv_fc_variable + '=main&nocache='
					+ new Date().getTime(), 'get_alias_title='
					+ encodeURIComponent(title), function(res) {
				$("#" + id).val(strip_tags(res));
			});
		}
		return false;
	}

	$(".selectfile").click(function() {
		var area = "id_img";
		var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
		var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
		var type = "image";
		nv_open_browse(script_name + "?" + nv_name_variable
			+ "=upload&popup=1&area=" + area + "&path="
			+ path + "&type=" + type + "&currentpath="
			+ currentpath, "NVImg", 850, 420,
			"resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
	
	
	$(document).ready(function() {
		$('#province_id').change(function(){
			var province_id = $('#province_id').val();
			load_district(province_id);
		});
		
		$('#district_id').change(function() {
            var district_id = $('#district_id').val();
            load_ward(district_id);
        });
	});
	
	
	function load_district(province_id){		
		$.ajax({
			type : 'POST',
			url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=create_rent&nocache=' + new Date().getTime(),
			data : 'load_district=1&province_id=' + $('#province_id').val(),
			success : function(json) {
				$select = $('#district_id');
				$select.html('');
    			$.each(json, function(key, val){
 					$select.append('<option value="' + val.districtid + '">' + val.title + '</option>');
 				});    			
			}
		});	
		return !1;
	}
	function load_ward(district_id){		
		$.ajax({
			type : 'POST',
			url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=create_rent&nocache=' + new Date().getTime(),
			data : 'load_ward=1&district_id=' + $('#district_id').val(),
			success : function(json) {
				$select = $('#ward_id');
				$select.html('');
    			$.each(json, function(key, val){
 					$select.append('<option value="' + val.wardid + '">' + val.title + '</option>');
 				});    			
			}
		});	
		return !1;
	}
	

	//]]>
</script>
<!-- BEGIN: auto_get_alias -->
<script type="text/javascript">
	//<![CDATA[
	$("[name='title']").change(function() {
		nv_get_alias('id_alias');
	});
	//]]>
</script>
<!-- END: auto_get_alias -->
<!-- END: main -->
<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
<div class="panel panel-default">
<div class="panel-body">
	<input type="hidden" name="id" value="{ROW.id}" />
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="title" value="{ROW.title}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.alias}</strong></label>
		<div class="col-sm-19 col-md-20">
			<div class="input-group">
						<input class="form-control" type="text" "alias" value="{ROW.alias}" id="id_alias" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<i class="fa fa-refresh fa-lg" onclick="nv_get_alias('id_alias');">&nbsp;</i>
							</button> </span></div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cat_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="cat_id" value="{ROW.cat_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="phone" value="{ROW.phone}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="price" value="{ROW.price}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="unit_id" value="{ROW.unit_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.area}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="area" value="{ROW.area}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.object_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="object_id" value="{ROW.object_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.country_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="country_id" value="{ROW.country_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.province_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="province_id" value="{ROW.province_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.district_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="district_id" value="{ROW.district_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.ward_id}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="ward_id" value="{ROW.ward_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="address" value="{ROW.address}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
		<div class="col-sm-19 col-md-20">
			<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="note">{ROW.note}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.img}</strong></label>
		<div class="col-sm-19 col-md-20">
			<div class="input-group">
			<input class="form-control" type="text" name="img" value="{ROW.img}" id="id_img" />
			<span class="input-group-btn">
				<button class="btn btn-default selectfile" type="button" >
				<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
			</button>
			</span>
		</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.active}</strong></label>
		<div class="col-sm-19 col-md-20">
			<input class="form-control" type="text" name="active" value="{ROW.active}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</div></div>
</form>

<script type="text/javascript">
//<![CDATA[
	function nv_get_alias(id) {
		var title = strip_tags( $("[name='title']").val() );
		if (title != '') {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
				$("#"+id).val( strip_tags( res ) );
			});
		}
		return false;
	}
	$(".selectfile").click(function() {
		var area = "id_img";
		var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
		var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
		var type = "image";
		nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});

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
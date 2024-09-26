<!-- Basic Validation -->
<div class="modal-header">
    <h4 class="modal-title" id="defaultModalLabel">Edit Menu Type</h4>
</div>
<div class="modal-body">
    @csrf
    {{ method_field('PUT') }}
    <input type="hidden" class="id" value="{{$menuType->id}}">
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
            <label>Name <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input type="text" class="form-control" value="{{$menuType->menu_type}}" name="menu_name" placeholder="Enter your Menu Type">
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
            <label>Image</label>
        </div>
        <div class="col-lg-6 col-md-5 col-sm-4 col-xs-3">
            <div class="form-group">
                <div class="form-line">
                    <input type="hidden" class="form-control" name="old_img" value="{{$menuType->image}}" />
                    <input type="file" class="form-control" name="img"  placeholder="Enter your Image" onChange="readURL(this);">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 text-center">
            @if($menuType->image != "")
            <img id="image" src="{{asset('public/menu_type/'.$menuType->image)}}" alt="" width="80px" height="80px">
            @else
            <img id="image" src="{{asset('public/menu_type/default.png')}}" alt="" width="80px" height="80px">
            @endif
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
            <label>Status <span class="text-danger">*</span></label>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <select class="form-control" name="status" required>
                        <option value-="" disabled>-- Select Status --</option>
                        <option value="1" {{ ($menuType->status == "1" ? "selected":"") }}>Active</option>
                        <option value="0" {{ ($menuType->status == "0" ? "selected":"") }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
    <div class="modal-footer">
        <button class="btn bg-red waves-effect" type="submit">UPDATE</button>
    </div>
</div>


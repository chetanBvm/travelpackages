<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    @if($packageType->id != $subcategory->id )
        <option value="{{$subcategory->id}}" @if($packageType->parent_id == $subcategory->id ) selected @endif >
        	{{$dash}}{{$subcategory->name}}
        </option>
    @endif
    @if(count($subcategory->subpackage))
        @include('admin.package-type.sub-package-list-option-for-update',['subcategories' => $subcategory->subpackage])
    @endif
@endforeach
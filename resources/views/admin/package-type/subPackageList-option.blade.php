<?php $dash.='--'; ?>
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}">{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subpackage))
        @include('admin.package-type.subPackageList-option',['subcategories' => $subcategory->subpackage])
    @endif
@endforeach
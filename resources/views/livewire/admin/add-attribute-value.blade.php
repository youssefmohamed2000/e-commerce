<div>
    <div class="form-group">
        <label>Product Attribute</label>
        <select class="form-control" multiple name="attribute_id[]" wire:model="attribute_id">
            <option value="" disabled>Choose Attribute</option>
            @foreach ($attributes as $attribute)
                <option
                    value="{{ $attribute->id }}">{{ $attribute->name }}</option>
            @endforeach
        </select>
    </div>
    @include('partials._session')
    @if(!empty($attribute_id))
        @foreach($attribute_id as $id)
            <div class="form-group">
                <label>{{$attributes->where('id', $id)->first()->name}}</label>
                <input type="text" class="col-6" wire:model="values.{{$id}}">
                <button type="button" class="btn btn-danger" wire:click.prevent="deleteAttribute({{$id}})"><i
                        class="fa fa-trash"></i></button>
            </div>
        @endforeach
        <div class="form-group">
            <button type="button" class="form-control btn btn-info" wire:click.prevent="storeAttribute">Add Attributes
            </button>
        </div>
    @endif
    {{--@if($selected_attribute !== null)
        @foreach($selected_attribute as $key => $attribute)
            <div class="form-group">
                <label>{{$attribute}}</label>
                <input type="text" class="form-control" wire:model="values.{{$attribute}}">
            </div>
        @endforeach
    @endif--}}

</div>

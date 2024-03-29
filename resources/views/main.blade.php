<x-main-layout>
    <form action="{{ url('/')}}" method="POST" id="calc_form">
        @csrf
        <div class="calc_wrap flex justify-between ">
            <div class="sel_wrap m-4">
                <label for="country" class="block text-left">Country:</label>
                <select name="country" id="country" class="
                            ml-1
                            block
                            mt-1
                            rounded-md
                            bg-gray-200
                            border-transparent
                            focus:border-gray-500 focus:ring-0">
                    @foreach ($countries as $country)
                        @if ((Request::old('country') == $country->id) || (isset($cur_country) && $country->id == $cur_country->id))
                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                        @else
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="sel_wrap m-4">
                <label for="country">Service type:</label>
                <select name="service_type" id="service_type" class="
                        ml-1
                        block
                        mt-1
                        rounded-md
                        bg-gray-200
                        border-transparent
                        focus:border-gray-500 focus:ring-0">
                    @foreach ($service_types as $service_type)
                        @if ((Request::old('service_type') == $service_type->id) || (isset($cur_service_type) && $service_type->id == $cur_service_type->id))
                            <option value="{{ $service_type->id }}" selected>{{ $service_type->name }}</option>
                        @else
                            <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5">
            <div class="m-4">
                <label for="weight" class="block text-left">Weight(kg):</label>
                <input id="weight" value="{{isset($cur_weight) ? $cur_weight : old('weight')}}" min="0.5" max="70" name="weight" type="number" step="0.1" class="block w-24 form-input px-4 py-3 rounded-md border-transparent bg-gray-200 focus:border-gray-500">
            </div>
            <div class="m-4">
                <label for="length" class="block text-left">Length(cm):</label>
                <input id="length" value="{{isset($cur_length) ? $cur_length : old('length')}}" min="0" max="120" name="length" type="number" class="block w-24 form-input px-4 py-3 rounded-md border-transparent bg-gray-200 focus:border-gray-500">
            </div>
            <div class="m-4">
                <label for="width" class="block text-left">Width(cm):</label>
                <input id="width" value="{{isset($cur_width) ? $cur_width : old('width')}}" min="0" max="80" name="width" type="number" class="block w-24 form-input px-4 py-3 rounded-md border-transparent bg-gray-200 focus:border-gray-500">
            </div>
            <div class="m-4">
                <label for="height" class="block text-left">Height(cm):</label>
                <input id="height" value="{{isset($cur_height) ? $cur_height : old('height')}}" min="0" max="69" name="height" type="number" class="block w-24 form-input px-4 py-3 rounded-md border-transparent bg-gray-200 focus:border-gray-500">
            </div>
            <div class="m-4">
                <label for="calc_weight" class="block text-left">Calc Weight(kg):</label>
                <input id="calc_weight" disabled type="number" class="block w-24 form-input px-4 py-3 rounded-md border-transparent bg-gray-400">
            </div>
        </div>
        <div class="flex justify-between">
            <div class="m-4">
                @if(isset($cur_country))
                    @if (isset($price))
                        {{$price}} UAH
                    @else
                        Price not found
                    @endif
                @endif
            </div>
            <input type="submit" value="Calculate" class="m-4 cursor-pointer p-4 bg-green-400 hover:bg-green-300 text-white">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
    <div class="debugging">
        @if(isset($cur_length) && isset($cur_width) && isset($cur_height))
            <div><span class="text-red-500">Volume: </span>{{ $cur_length }} x {{ $cur_width }} x {{ $cur_height }} =  {{ $cur_lwh }}</div>
            <div><span class="text-red-500">Calculated Weight: </span>{{ $cur_lwh }} / 5000 = {{ $cur_lwh / 5000 }}</div>
            <div><span class="text-red-500">Weight vs. Calculated Weight: </span>
                {{$cur_weight}}
                @if($cur_weight > ($cur_lwh / 5000) )
                >
                @else
                <
                @endif
                {{ $cur_lwh / 5000 }}
            </div>
            <div><span class="text-red-500">Weight Group: </span>{{ $weight }}</div>
            <div><span class="text-red-500">Counrty Shipping Zone: </span>{{ $cur_country->name }} <span class="text-red-500">zone: </span>{{$area->id}}</div>
            <div><span class="text-red-500">Price per Weight-Zone table: </span>{{$start_price}}</div>
            @if(isset($debug)) <span class="text-red-500">Special Conditions: </span>
                @if($debug == 1)
                    <div>(weight >=32 AND $weight < 40) +180</div>
                @endif
                @if($debug == 2)
                    <div>(length > 100 OR width > 76 ) AND $weight < 40) +180</div>
                @endif
                @if($debug == 3)
                    <div>(weight >= 40 AND weight <= 70) +1560</div>
                @endif
            @endif
            @if(isset($debug))
                @if($debug == 1)
                    <div><span class="text-red-500">Total cost: </span>{{$start_price}} + 180 = {{$price}}</div>
                @endif
                @if($debug == 2)
                    <div><span class="text-red-500">Total cost: </span>{{$start_price}} + 180 = {{$price}}</div>
                @endif
                @if($debug == 3)
                    <div><span class="text-red-500">Total cost: </span>{{$start_price}} + 1560 = {{$price}}</div>
                @endif
            @else
                <div><span class="text-red-500">Total cost: </span>{{$price}}</div>
            @endif
        @endif
    </div>
</x-main-layout>

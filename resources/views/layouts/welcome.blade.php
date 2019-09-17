@extends('layouts.mainlayout')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="POST" class="form-pacient needs-validation" action="{{route('accounts.new')}}" novalidate>
                {{ csrf_field() }}
                <!-- product -->
                <div class="d-none form-medicine">
                    <h1><i class="far fa-newspaper"></i>Producto</h1>
                    @forelse($products as $product)
                        <div class="form-group">
                            @if($product->mandatory)
                                @if($product->type->name == 'string')
                                    @if($product->name == 'potentialname')
                                        <div class="form-group">
                                            <label for="{{ $product->name }}">{{ html_entity_decode($product->label) }}</label>
                                            <select class="form-control medicine" name="{{ $product->name }}" id="{{ $product->name }}">
                                                <option value="" selected>{{ html_entity_decode($product->label) }}</option>
                                                @foreach($medicines as $medicine)
                                                    <option value="{{ $medicine->potentialname }}">{{ $medicine->potentialname }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccione un producto
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        </div>
                    @empty
                        No hay productos
                    @endforelse
                    <hr/>
                </div>
                <!-- end product -->
                <h1><i class="far fa-newspaper"></i>Pacientes</h1>
                <div class="form-row">
                    @forelse($accounts as $account)
                        <div class="col-md-12 mb-3">
                            @if($account->type->name == 'boolean')
                                <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                    <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                    <option value="true">Si</option>
                                    <option value="false">No</option>
                                </select>
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name == 'picklist')
                                @if($account->name =='cf_2007')
                                    <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                    <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                        <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                        @foreach($account->type->picklistValues as $option)
                                            @if($option->label == 'COLOMBIA')
                                                <option value="{{ $option->value }}">{{ $option->label }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($account->mandatory == 1)
                                        <div class="invalid-feedback">
                                            Por favor indique un {{ html_entity_decode($account->label) }} valido
                                        </div>
                                    @endif
                                @elseif($account->name == 'cf_2009')
                                    <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                    <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                        <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                        @foreach($account->type->picklistValues as $option)
                                            @if(strpos($option->label, 'NO APLICA') === false)
                                                <option value="{{ $option->value }}">{{ $option->label }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($account->mandatory == 1)
                                        <div class="invalid-feedback">
                                            Por favor indique un {{ html_entity_decode($account->label) }} valido
                                        </div>
                                    @endif
                                @elseif($account->name == 'cf_2011')
                                    <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                    <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                        <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                        @foreach($account->type->picklistValues as $option)
                                            @if(in_array($option->label, $cities))
                                                <option value="{{ $option->value }}">{{ $option->label }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($account->mandatory == 1)
                                        <div class="invalid-feedback">
                                            Por favor indique un {{ html_entity_decode($account->label) }} valido
                                        </div>
                                    @endif
                                @else
                                    <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                    <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                        <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                        @foreach($account->type->picklistValues as $option)
                                            <option value="{{ $option->value }}">{{ $option->label }}</option>
                                        @endforeach
                                    </select>
                                    @if($account->mandatory == 1)
                                        <div class="invalid-feedback">
                                            Por favor indique un {{ html_entity_decode($account->label) }} valido
                                        </div>
                                    @endif
                                @endif
                            @elseif($account->type->name == 'reference')
                                <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                    <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name=='autogenerated')
                                <input type="hidden" id="{{ $account->name }}" name="{{ $account->name }}">
                            @elseif($account->type->name == 'string')
                                <input {{ ($account->mandatory) ? 'required': '' }} type="text" class="form-control" id="{{ $account->name }}" name="{{ $account->name }}" placeholder="{{ html_entity_decode($account->label) }}">
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name == 'currency')
                                <input {{ ($account->mandatory) ? 'required': '' }} type="numeric" class="form-control" id="{{ $account->name }}" name="{{ $account->name }}" placeholder="{{ html_entity_decode($account->label) }}">
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name == 'owner')
                                <label for="{{ $account->name }}">{{ html_entity_decode($account->label) }}</label>
                                <select {{ ($account->mandatory) ? 'required': '' }} class="form-control" id="{{ $account->name }}" name="{{ $account->name }}">
                                    <option value="" selected>{{ html_entity_decode($account->label) }}</option>
                                    @foreach($account->type->ownerValues as $option)
                                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                                    @endforeach
                                </select>
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name == 'url')
                                <label for="exampleFormControlFile1">{{ html_entity_decode($account->label) }}</label>
                                <input type="file" {{ ($account->mandatory) ? 'required': '' }} class="form-control-file" id="{{ $account->name }}">
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @elseif($account->type->name == 'datetime')
                                <label for="{{ $account->name }}" class="col-2 col-form-label">{{ html_entity_decode($account->label) }}</label>
                                <input {{ ($account->mandatory) ? 'required': '' }} class="form-control" type="date" value="{{ $currentTime }}" id="{{ $account->name }}">
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @else
                                <input type="{{ $account->type->name }}"
                                       name="{{ $account->name }}" class="form-control" id="{{ $account->name }}"
                                       aria-describedby="{{ $account->name }}" placeholder="{{ html_entity_decode($account->label) }}"
                                    {{ ($account->mandatory) ? 'required': '' }}>
                                @if($account->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($account->label) }} valido
                                    </div>
                                @endif
                            @endif
                        </div>
                    @empty
                        <div class="col-md-12">
                            No Accounts forms
                        </div>
                    @endforelse
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
@endsection

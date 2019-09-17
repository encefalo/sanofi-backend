@extends('layouts.mainlayout')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <h1><i class="far fa-newspaper"></i>Casos</h1>
            <form method="POST" action="{{route('help.new')}}" class="needs-validation" novalidate>
                <div class="form-row">
                @forelse($helps as $help)
                    <div class="col-md-12 mb-3">
                        @if($help->type->name == 'boolean')
                            <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                            <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                <option value="true">Si</option>
                                <option value="false">No</option>
                            </select>
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name == 'picklist')
                            @if($help->name =='cf_2007')
                                <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                                <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                    <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                    @foreach($help->type->picklistValues as $option)
                                        @if($option->label == 'COLOMBIA')
                                            <option value="{{ $option->value }}">{{ $option->label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($help->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($help->label) }} valido
                                    </div>
                                @endif
                            @elseif($help->name == 'cf_2009')
                                <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                                <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                    <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                    @foreach($help->type->picklistValues as $option)
                                        @if(strpos($option->label, 'NO APLICA') === false)
                                            <option value="{{ $option->value }}">{{ $option->label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($help->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($help->label) }} valido
                                    </div>
                                @endif
                            @elseif($help->name == 'cf_2011')
                                <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                                <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                    <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                    @foreach($help->type->picklistValues as $option)
                                        @if(in_array($option->label, $cities))
                                            <option value="{{ $option->value }}">{{ $option->label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($help->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($help->label) }} valido
                                    </div>
                                @endif
                            @else
                                <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                                <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                    <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                    @foreach($help->type->picklistValues as $option)
                                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                                    @endforeach
                                </select>
                                @if($help->mandatory == 1)
                                    <div class="invalid-feedback">
                                        Por favor indique un {{ html_entity_decode($help->label) }} valido
                                    </div>
                                @endif
                            @endif
                        @elseif($help->type->name == 'reference')
                            <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                            <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name=='autogenerated')
                            <input type="hidden" id="{{ $help->name }}" name="{{ $help->name }}">
                        @elseif($help->type->name == 'string')
                            <input {{ ($help->mandatory) ? 'required': '' }} type="text" class="form-control" id="{{ $help->name }}" name="{{ $help->name }}" placeholder="{{ html_entity_decode($help->label) }}">
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name == 'currency')
                            <input {{ ($help->mandatory) ? 'required': '' }} type="numeric" class="form-control" id="{{ $help->name }}" name="{{ $help->name }}" placeholder="{{ html_entity_decode($help->label) }}">
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name == 'owner')
                            <label for="{{ $help->name }}">{{ html_entity_decode($help->label) }}</label>
                            <select {{ ($help->mandatory) ? 'required': '' }} class="form-control" id="{{ $help->name }}" name="{{ $help->name }}">
                                <option value="" selected>{{ html_entity_decode($help->label) }}</option>
                                @foreach($help->type->ownerValues as $option)
                                    <option value="{{ $option->value }}">{{ $option->label }}</option>
                                @endforeach
                            </select>
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name == 'url')
                            <label for="exampleFormControlFile1">{{ html_entity_decode($help->label) }}</label>
                            <input type="file" {{ ($help->mandatory) ? 'required': '' }} class="form-control-file" id="{{ $help->name }}">
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @elseif($help->type->name == 'datetime')
                            <label for="{{ $help->name }}" class="col-2 col-form-label">{{ html_entity_decode($help->label) }}</label>
                            <input {{ ($help->mandatory) ? 'required': '' }} class="form-control" type="date" value="{{ $currentTime }}" id="{{ $help->name }}">
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @else
                            <input type="{{ $help->type->name }}"
                                   name="{{ $help->name }}" class="form-control" id="{{ $help->name }}"
                                   aria-describedby="{{ $help->name }}" placeholder="{{ html_entity_decode($help->label) }}"
                                {{ ($help->mandatory) ? 'required': '' }}>
                            @if($help->mandatory == 1)
                                <div class="invalid-feedback">
                                    Por favor indique un {{ html_entity_decode($help->label) }} valido
                                </div>
                            @endif
                        @endif
                    </div>
                @empty
                    <div class="col-md-12">
                        No Accounts forms
                    </div>
                @endforelse
                <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
